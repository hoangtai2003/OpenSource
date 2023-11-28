<?php 
	session_start();
	require_once("../connect.php");
	if (!isset($_POST["txtSearch"])){
		$search = "";
	} else {
        $_SESSION["txtSearch"] = $_POST["txtSearch"];
	}
	if(!isset($_POST["slCid"])){
		$cid = 0;
	}else{
		$_SESSION["slCid"] = $_POST["slCid"];
	}

	$sql = "Select * from categories";
	$result = $conn->query($sql);
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
			<h1 align=center>Search Product</h1>
			<form name=f method=POST>
				<center>
				Select Category:
				<select name="slCid">
                    <option value="0"></option>
						<?php
						while( $row = $result->fetch_assoc() ){
							$selected = ($_SESSION["slCid"] == $row["cid"]) ? "selected" : "";
        					echo "<option value='" . $row["cid"] . "' " . $selected . ">" . $row["cname"] . "</option>";
						}
					?>
				</select>
				<br>
				Enter text to find:
				<input type=text name=txtSearch value="<?php echo isset($_SESSION['txtSearch']) ? $_SESSION['txtSearch'] : '';?>" size=50>
				<input type=submit value="Search" name=cmd>
				</center>
			</form>
			<?php
					require_once("../connect.php");
                    $search = !isset($_SESSION["txtSearch"]) ? '' : $_SESSION["txtSearch"];
                    $cid = !isset($_SESSION["slCid"]) ? 0 : $_SESSION["slCid"];
                    if (!isset($_REQUEST["page"])){
                        $page=1;
                    } else { 
                        $page = $_REQUEST["page"];
                    }
                    $num_row=3;
					$sql = "select 0203466_product_18.*, categories.cname from 0203466_product_18
							join categories on 0203466_product_18.cid = categories.cid
							where (pname like '%".$search."%')
							and (categories.cid = $cid)";
					// echo $sql;
					$result = $conn->query($sql) or die($conn->error);
                    if($result->num_rows > 0){
                        $num_of_page = ceil($result->num_rows/$num_row);
                        if ($page<1) {
                            $page = 1;
                        } 
                        if ($page>$num_of_page){
                            $page = $num_of_page;
                        }
						$offset = $num_row * ($page-1);
                        $sql1 = "select 0203466_product_18.*, categories.cname from 0203466_product_18
                                join categories on 0203466_product_18.cid = categories.cid
                                where (pname like '%".$search."%')
                                and (categories.cid = $cid) limit " .$num_row." offset ".$offset." ";
                        $result1 = $conn->query($sql1) or die($conn->error);
				?>
				<table border=1 width=100% align=center>
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th>Description</th>
						<th>Image</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Category Name</th>
					</tr>
					<?php 
						if ($result1->num_rows==0){
							echo "<tr><td style='font-color:red' colspan=9>No result!</td></tr>";
						} else {
							while ($row1=$result1->fetch_assoc()){
								?>
								<tr>
									<td><?php echo $row1["pid"];?></td>
									<td><?php echo $row1["pname"];?></td>
									<td><?php echo $row1["pdesc"];?></td>
									<td><img src="images/<?php echo $row1["pimage"];?>" width=200></td>
									<td><?php echo $row1["pprice"];?></td>
									<td><?php echo $row1["pquantity"];?></td>
									<td><?php echo $row1["cname"];?></td>
								</tr>
								<?php 
							}
						}
					
					?>
				</table>
                <center>
                    <?php 
                        for($i=1;$i<=$num_of_page;$i++){
                            if ($i == $page){
                                echo " ".$i." ";
                            } else {
                                echo " <a href=product_search_page.php?page=".$i.">".$i."</a> ";
                            }
                            
                        }
                    ?>
                </center>
				<?php 
                    }
                    else{
                        echo "<center>No result!</center>";
                    }
			?>
	</body>
</html>
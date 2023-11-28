<?php 
	session_start();
	if (!isset($_POST["txtSearch"])){
		$search = "";
	} else {
		$search = $_POST["txtSearch"];
	}

?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
			<h1 align=center>Search Product</h1>
			<form name=f method=POST>
				<center>
				Enter text to find:
				<input type=text name=txtSearch value="<?php echo $search;?>" size=50>
				<input type=submit value="Search" name=cmd>
				</center>
			</form>
			<?php
				if (isset($_POST["cmd"])){
					require_once("../connect.php");
					$sql = "select 0203466_product_18.*, categories.cname
							from 0203466_product_18, categories
							where 0203466_product_18.cid = categories.cid
							and (pname like '%".$search."%'
							or pdesc like '%".$search."%')";
					$result = $conn->query($sql) or die($conn->error);
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
						if ($result->num_rows==0){
							echo "<tr><td style='font-color:red' colspan=7>No result!</td></tr>";
						} else {
							while ($row=$result->fetch_assoc()){
								?>
								<tr>
									<td><?php echo $row["pid"];?></td>
									<td><?php echo $row["pname"];?></td>
									<td><?php echo $row["pdesc"];?></td>
									<td><img src="images/<?php echo $row["pimage"];?>" width=200></td>
									<td><?php echo $row["pprice"];?></td>
									<td><?php echo $row["pquantity"];?></td>
									<td><?php echo $row["cname"];?></td>
									
								</tr>
								<?php 
							}
						}
					
					?>
				</table>
				<?php 
				}
			?>
	</body>
</html>
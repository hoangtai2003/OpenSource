<?php 
	session_start();
	require_once("../connect.php");
	if (!isset($_REQUEST["page"])){
		$page=1;
	} else { 
		$page = $_REQUEST["page"];
	}
	$num_row=3;
	$sql = "select a.*, b.cname from 0203466_Product_18 a, Categories b where a.cid = b.cid";
	$result = $conn->query($sql) or die($conn->error);
	$totalRecord = mysqli_num_rows($result);
	$num_of_page=ceil($totalRecord/ $num_row);
	if ($page<1) {
		$page = 1;
	} 
	if ($page>$num_of_page){
		$page = $num_of_page;
	}
	$offset = ($page - 1) * $num_row;
	$sql = "select a.*, b.cname from 0203466_Product_18 a, Categories b where a.cid = b.cid limit ".$num_row." offset ".$offset." " ;
	//echo $num_of_page;
	$result = $conn->query($sql) or die($conn->error);
	
?>


<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
			<h1 align=center>List of Product</h1>
			<table border=1 width=100%>
				<tr>
					<th>Code</th>
					<th>Name</th>
					<th>Image</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Category</th>
					<th>Detail</th>
				</tr>
				<?php 
					if ($result->num_rows == 0){
						echo "<tr><td colspan = 7>No result!</td></tr>";
					} else {
						while ($row=$result->fetch_assoc()){
				?>
					<tr>
						<td><?= $row["pid"];?></td>
						<td><?= $row["pname"];?></td>
						<td><img src="images/<?= $row["pimage"];?>" width=160px></td>
						<td><?= $row["pprice"];?></td>
						<td><?= $row["pquantity"];?></td>
						<td><?= $row["cname"];?></td>
						<td><a href="product_detail_action.php?pid=<?= $row["pid"];?>">Detail</a></td>
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
							echo " <a href=product_view_page.php?page=".$i.">".$i."</a> ";
						}
						
					}
				?>
			</center>
	</body>
</html>
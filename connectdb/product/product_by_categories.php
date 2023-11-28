<?php 
	session_start();
	require_once("../connect.php");
	if (!isset($_POST["slCid"])){
		$cid = 0;
	} else {	
		$cid = $_POST["slCid"];
	}
	$sql = "select * from categories";
	$result = $conn->query($sql) or die($conn->error);
	
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
			<h1 align=center>All Products by Categories</h1>
			<form method=POST action="" name=f>
				<center>
					<select name=slCid onChange="f.submit();">
						<option value=0></option>
						<?php 
							while ($row=$result->fetch_assoc()){
								echo "<option value=".$row["cid"];
								if ($row["cid"] == $cid) {
									echo " selected ";
								}
								echo ">".$row["cname"]."</option>";
							}
						?>
					</select>
				</center>
			</form>
			<table border=1 width=100% align=center>
				<tr>
					<th>Product code</th>
					<th>Product name</th>
					<th>Product description</th>
					<th>Product image</th>
					<th>Product price</th>
					<th>Product quantity</th>
				</tr>
				<?php 
					$sql1 = "select * from 0203466_product_18 where cid=".$cid;
					$result1 = $conn->query($sql1) or die($conn->error);
					if ($result1->num_rows==0){
						echo "<tr><td colspan=6>No result!</td></tr>";
					} else {
						
						while ($row1=$result1->fetch_assoc()){
						?>	
							<tr>
								<td><?php echo $row1["pid"];?></td>
								<td><?php echo $row1["pname"];?></td>
								<td><?php echo $row1["pdesc"];?></td>
								<td><img src="images/<?php echo $row1["pimage"];?>" width=150></td>
								<td><?php echo $row1["pprice"];?></td>
								<td><?php echo $row1["pquantity"];?></td>
							</tr>
						<?php	
						}
						 
					}
				?>
			</table>
			
	</body>
</html>
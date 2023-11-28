<?php 
	session_start();
	require("../connect.php");
	if (!isset($_SESSION["product_edit_error"])){
		$_SESSION["product_edit_error"]="";
	}
	$pid =$_REQUEST["pid"];
    $sql1 = "select * from categories";
	$sql2 = "select * from 0203466_supplier_18";
	$sql3 = "select * from color";
	$sql = "SELECT 0203466_product_18.* from 0203466_product_18 inner join categories on 0203466_product_18.cid= categories.cid INNER JOIN color on 0203466_product_18.colorid = color.colorid INNER JOIN 0203466_supplier_18 on 0203466_product_18.sid = 0203466_supplier_18.sid where pid = ".$pid;
    $result1 = $conn->query($sql1) or die($conn->error);
	$result2 = $conn->query($sql2) or die($conn->error);
	$result3 = $conn->query($sql3) or die($conn->error);
	$result = $conn->query($sql) or die($conn->error);
	if ($result->num_rows==0){
		$_SESSION["product_error"]="Data not exist!";
		header("Location:product.php");
	} else {
        $row = $result->fetch_assoc();
        
?>
<html>
	<head>
		<meta charset="utf-8">
		<style type="text/css">
			.width{
				width:250px;
			}
		</style>
	</head>
	<body>
		<h1 align=center>Chi tiết sản phẩm</h1>
		<center>
			<font color=red><?php echo $_SESSION["product_edit_error"];?></font>
		</center>
			<table border=0 align=center cellspacing=10 class="table table-hover">
				<tr>
					<td align=right>Product Name:</td>
					<td><label><?php echo $row["pname"]?></label></td>
				<tr>
				<tr>
					<td align=right valign=top>Product Description:</td>
					<td><label><?php echo $row["pdesc"];?></label></td>
				</tr>
				<tr>
					<td align=right valign=top>Product Image:</td>
					<td>
						<img src="images/<?php echo $row["pimage"];?>" class=width>
					</td>
				</tr>
				<tr>
					<td align=right>Product Order:</td>
					<td><label><?php echo $row["porder"];?></label></td>
				</tr>
                <tr>
					<td align=right>Product Price:</td>
					<td><label><?php echo $row["pprice"];?></label></td>
				</tr>
                <tr>
					<td align=right>Product Quantiy:</td>
					<td><label><?php echo $row["pquantity"];?></label></td>
				</tr>
                <tr>
					<td align=right>Tên danh mục:</td>
					<td>
						<?php 
						while($row1 = $result1->fetch_assoc()){
							if($row1["cid"] == $row["cid"]){ 
						?>
							<label><?php echo $row1["cname"] ?></label>
						<?php
							}
							}
						?>
                    </td>
				</tr>
				<tr>
					<td align=right>Tên nhà cung cấp:</td>
					<td>
						<?php 
						while($row2 = $result2->fetch_assoc()){
							if($row2["sid"] == $row["sid"]){ 
						?>
							<label><?php echo $row2["sname"] ?></label>
						<?php
							}
							}
						?>
                    </td>
				</tr>
				<tr>
					<td align=right>Màu sắc:</td>
					<td>
					<?php 
						while($row3 = $result3->fetch_assoc()){
							if($row3["colorid"] == $row["colorid"]){ 
						?>
							<label><?php echo $row3["colorname"] ?></label>
						<?php
							}
							}
						?>
                    </td>
				</tr>
                <tr>
					<td align=right>Số lượt xem sản phẩm:</td>
					<td>
                        <label><?= $row["pview"]?></label>
					</td>
				</tr>
				<tr>
					<td><button><a href="product_view.php">Quay lại</a></button></td>
				</tr>
			</table>
	</body>
</html>
<?php 
    }
	$conn->close();
	unset($_SESSION["product_edit_error"]);
?>
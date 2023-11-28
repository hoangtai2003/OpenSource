<?php 
	session_start();
	require_once("../connect.php");
	if (!isset($_SESSION["product_error"])){
		$_SESSION["product_error"]="";
	}

?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1 align=center>List of Product</h1>
        <center>
		    <a href="product_add.php" align=center>Add new Product</a>
		</center>
		<table border=1 align=center width=100%>
		<tr>
			<th>Product Id</th>
			<th>Product name</th>
			<th>Product desc</th>
			<th>Product image</th>
            <th>Product order</th>
            <th>Proudct price</th>
            <th>Product quantity</th>
			<th>Category name</th>
			<th>Supplier name</th>			
			<th>Size name</th>
            <th>Product status</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
		<?php 
				$sql = "select 0203466_product_18.*, categories.cname, 0203466_supplier_18.sname, 0203466_size_18.sizename from 
				0203466_product_18, categories, 0203466_supplier_18, 0203466_size_18 where 0203466_product_18.cid = categories.cid
				and 0203466_product_18.sid = 0203466_supplier_18.sid and 0203466_product_18.sizeid =0203466_size_18.sizeid";
				$result = $conn->query($sql) or die("Can't get recordset");
				if ($result->num_rows>0) {
					while($row = $result->fetch_assoc()){
						?>
							<tr>
								<td><?php echo $row["pid"];?></td>
								<td><?php echo $row["pname"];?></td>
								<td><?php echo $row["pdesc"];?></td>
								<td><img width=300 src="images/<?php echo $row["pimage"];?>"></td>
                                <td><?php echo $row["porder"];?></td>
                                <td><?php echo $row["pprice"];?></td>
                                <td><?php echo $row["pquantity"];?></td>
								<td><?php echo $row["cname"];?></td>
								<td><?php echo $row["sname"];?></td>
								<td><?php echo $row["sizename"];?></td>
								<td><?php echo $row["pstatus"];?></td>
								<td><a href="product_edit.php?pid=<?php echo $row["pid"];?>">Sửa</a></td>
								<td><a href="product_delete.php?pid=<?php echo $row["pid"];?>">Xóa</a></td>
							</tr>
						<?php 
						}
				} else {
					echo "<tr><td colspan=15>Tập kết quả rỗng</td></tr>";
				}
				

				$conn->close();
		
		?>
		</table>
		
	</body>
</html>


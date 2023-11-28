<?php 
	session_start();
    include("../connect.php");
	if (!isset($_SESSION["product_add_error"])){
		$_SESSION["product_add_error"]="";
	}
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
		<h1 align=center>Add new product</h1>
		<center><font color=red><?php echo $_SESSION["product_add_error"]?></font></center>
		<form method=POST action="product_add_action.php">
			<table align=center border=0>
				<tr>
					<td align=right>Product Name:</td>
					<td><input type=text name=txtPname class=width></td>
				</tr>
				<tr>
					<td valign=top align=right>Product Description:</td>
					<td>
						<textarea class=width cols=20 rows=7 name=taPdesc></textarea>
					</td>
				</tr>
				<tr></tr>
					<td align=right>Product Image:</td>
					<td>
						<input type=text name=txtPimage class=width>
					</td>
				</tr>
				<tr>
					<td align=right>Product Order:</td>
					<td><input type=text name=txtPorder class=width></td>
				</tr>
				<tr>
					<td align=right>Product Price:</td>
					<td><input type=text name=txtPprice class=width></td>
				</tr>
				<tr>
					<td align=right>Product Quantity:</td>
					<td><input type=text name=txtPquantity class=width></td>
				</tr>
				<tr>
					<td align=right>Nhóm sản phẩm:</td>
					<td>
						<select name="slcid">
							<option value="0"></option>
							<?php
								$sql = "select * from categories";
								$result = mysqli_query($conn, $sql);
								if(mysqli_num_rows($result) > 0){
									while ($row = mysqli_fetch_assoc($result)){
										?>
											<option value="<?=$row['cid']?>"><?=$row['cname']?></option>
										<?php
									}
								} 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align=right>Nhà cung cấp:</td>
					<td>
						<select name="slsid">
							<option value="0"></option>
							<?php
								$sql = "select * from 0203466_supplier_18";
								$result = mysqli_query($conn, $sql);
								if(mysqli_num_rows($result) > 0){
									while ($row = mysqli_fetch_assoc($result)){
										?>
											<option value="<?=$row['sid']?>"><?=$row['sname']?></option>
										<?php
									}
								} 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align=right>Size:</td>
					<td>
						<select name="slsizeid">
							<option value="0"></option>
							<?php
								$sql = "select * from 0203466_size_18";
								$result = mysqli_query($conn, $sql);
								if(mysqli_num_rows($result) > 0){
									while ($row = mysqli_fetch_assoc($result)){
										?>
											<option value="<?=$row['sizeid']?>"><?=$row['sizename']?></option>
										<?php
									}
								} 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align=right>Product Status:</td>
					<td>
						<input type=radio checked name=rdPstatus value=1>Active
						<input type=radio name=rdPstatus value=0>Inactive
					</td>
				</tr>
				<tr>
					<td align=right><input type=submit value="Add new" name="add_btn"></td>
					<td><input type=reset></td>
				</tr>
			</table>
		</form>
	</body>
</html>
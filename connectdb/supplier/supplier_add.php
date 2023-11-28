<?php 
	session_start();
if (!isset($_SESSION["supplier_add_error"])){
		$_SESSION["supplier_add_error"]="";
	
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Add new Supplier</h1>
		<center><font color=red><?php echo $_SESSION["supplier_add_error"];?></font></center>
		<form method=POST action="supplier_add_action.php">
			<table border=0 align=center width=400>
				<tr>
					<td>Supplier Name:</td>
					<td><input style="width:180px" type=text name=txtSname></td>
				</tr>
				<tr>
					<td>Supplier Address:</td>
					<td><input style="width:180px" type=text name=txtSaddress></td>
				</tr>
				<tr>
					<td>Supplier Phone:</td>
					<td><input type=text  style="width:180px" name=txtSphone></td>
				</tr>
				<tr>
					<td>Supplier Tax:</td>
					<td><input type=text style="width:180px" name=txtStax></td>
				</tr>
				<tr>
					<td>Supplier Status:</td>
					<td><input type=radio checked name=rdSstatus value=1>Hoạt động
						<input type=radio name=rdSstatus value=0>Ngừng Hoạt động
					</td>
				</tr>
				<tr>
					<td align=right><input type=submit value="Add new"></td>
					<td><input type=reset value="Reset">
				</tr>
			</table>
		</form>
	</body>
</html>
<?php 
	$_SESSION["supplier_add_error"]="";
?>
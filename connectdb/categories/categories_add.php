<?php 
	session_start();
if (!isset($_SESSION["categories_add_error"])){
		$_SESSION["categories_add_error"]="";
	
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Add new category</h1>
		<center><font color=red><?php echo $_SESSION["categories_add_error"];?></font></center>
		<form method=POST action="categories_add_action.php">
			<table border=0 align=center width=400>
				<tr>
					<td>Category Name:</td>
					<td><input style="width:180px" type=text name=txtCname></td>
				</tr>
				<tr>
					<td>Category Description:</td>
					<td><textarea cols=20 style="width:180px" rows=6 name=taCdesc></textarea></td>
				</tr>
				<tr>
					<td>Category Image:</td>
					<td><input type=text  style="width:180px" name=txtCimage></td>
				</tr>
				<tr>
					<td>Category Order:</td>
					<td><input type=text style="width:180px" name=txtCorder></td>
				</tr>
				<tr>
					<td>Category Status:</td>
					<td><input type=radio checked name=rdCstatus value=1>Hoạt động
						<input type=radio name=rdCstatus value=0>Ngừng Hoạt động
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
	$_SESSION["categories_add_error"]="";
?>
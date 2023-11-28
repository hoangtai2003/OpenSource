<?php 
	session_start();
    if (!isset($_SESSION["size_add_error"])){
        $_SESSION["size_add_error"]="";
    }
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Add new size</h1>
		<center><font color=red><?php echo $_SESSION["size_add_error"];?></font></center>
		<form method=POST action="size_add_action.php">
			<table border=0 align=center width=400>
				<tr>
					<td>Size Name:</td>
					<td><input style="width:180px" type=text name=txtSizename></td>
				</tr>
				<tr>
					<td>Size Status:</td>
					<td><input type=radio checked name=rdSizestatus value=1>Hoạt động
						<input type=radio name=rdSizestatus value=0>Ngừng Hoạt động
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
	$_SESSION["size_add_error"]="";
?>
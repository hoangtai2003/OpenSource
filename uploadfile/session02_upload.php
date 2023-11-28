<?php session_start();
	if (!isset($_SESSION["error_upload"])) {
		$_SESSION["error_upload"]="";
	}
?>
<html>
	<title>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</title>
	<body>
		<form enctype="multipart/form-data" method=POST action="session02_upload_action.php">
			<center>
				<h1>Chọn tệp cần đẩy lên</h1>
				<font color=red><?php echo $_SESSION["error_upload"];?></font><br>
				<input type=file name=fanh>
				<input type=submit value="Tải lên">
			</center>
		</form>
	</body>
</html>
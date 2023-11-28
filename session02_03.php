<?php 
	session_start();
	if (!isset($_SESSION["views"])) {
		$_SESSION["views"] = 0;
	}
	$_SESSION["views"]+=1;
?>

<html>
	<title>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</title>
	<body>
		<?php 
			echo "Số lần Refresh trang: ".$_SESSION["views"];
		?>
	</body>
</html>
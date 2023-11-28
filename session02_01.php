<?php 
setcookie("user","PHTRUNG",time()-3600);
?>
<html>
	<title>
		<meta charset="utf-8">
	</title>
	<body>
		<?php 
			echo date("d/m/Y");
			echo "<br>".date("d.m.y");
			echo "<br>".date("d-m-Y h:i:s A");
			echo "<br>".date("j, n, Y");
			include("session02_02.php");
			test();
			include_once("session02_02.php");
			//tạo cookie tồn tại trong 1h
			
			if (isset($_COOKIE["user"])){
				echo "<br>Chào bạn: ".$_COOKIE["user"];
			} else {
				echo "<br>Chào mừng khách!";
			}
			//hủy cookie
			//setcookie("user","",time()-3600);
			if (isset($_COOKIE["user"])){
				echo "<br>Chào bạn: ".$_COOKIE["user"];
			} else {
				echo "<br>Chào mừng khách!";
			}
		?>
	</body>
</html>	
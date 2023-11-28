<html>
	<title>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</title>
	<body>
		<form method=POST action="session02_04.php">
			Nhập a: <input type=text name=txtA><br>
			Nhập b: <input type=text name=txtB><br>
			Nhập c: <input type=text name=txtC><br>
			<input type=submit name=cmd value="Giải pt bậc 1">
		</form>
		<?php 
			if (isset($_POST["cmd"])){ 
			if ($_POST["cmd"]!=""){
				//ax + b = c 
				$a = $_POST["txtA"];
				$b = $_POST["txtB"];
				$c = $_POST["txtC"];
				if ($a==0)
					if ($b==$c) {
						echo "PT có vô số nghiệm!";
					} else {
						echo "PT vô nghiệm";
					}
				else {
					$x = ($c - $b)/$a;
					echo "PT có nghiệm x = ". $x;
				}
			}
			}
		?>
	</body>
</html>
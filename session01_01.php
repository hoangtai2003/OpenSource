<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Ví dụ thẻ H1</h1>
		<?php
			echo "<h2>Ví dụ thẻ H2 in từ PHP</h2>";
			$v = "test";
			$V = "TEST";
			echo "<br>$v , $V";
			//$4site = "http://www.google.com";
			$_4site = "http://www.huce.edu.vn";
			echo "<br>$_4site";
			/*
				nhiều dòng
				
			*/
			$foo =	"Trung";
			$bar = &$foo;
			echo "<br>".$foo;
			$bar = "Phan Hữu $bar";
			echo "<br>".$bar;
			echo "<br>".$foo;
			$bar.=" DHXD HN";
			echo "<br>".$bar;
			/*$d = date("D, d/M/Y");
			echo "<br>".$d;
			*/
			$d = date("D"); //Thu
			if ($d == "Sat") {
				echo "<br>Hôm nay là ngày nghỉ";
				echo "<br><h1>Đi chơi thôi!";
			} else if ($d=="Sun"){
				echo "<br>Sắp phải đi học rồi!";
			} else {
				echo "<br>Học tập vì tương lai!";
				
			}
			$d = date("m");
			//echo $d;
			switch ($d){
				case 1:
				case 3:
				case 5:
				case 7:
				case 8:
				case 10:
				case 12:
					echo "<br>Tháng này có 31 ngày!";
					break;
				case 2: 
					if (date("Y")%4 == 0)
						echo "<br>Tháng này có 29 ngày!";
					else
						echo "<br>Tháng này có 28 ngày!";
					break;
				default:
					echo "<br>Tháng này có 30 ngày!";
					
			}
			$i = 1;
			while ($i<7){
				echo "<h$i>Ví dụ thẻ heading $i</h$i>";
				$i++;
			}
			$i = 0;
			do {
				echo "<h$i>Ví dụ thẻ heading $i</h$i>";
				$i++;
			} while ($i==1);
			for ($i=1;$i<=5;$i++){
				echo "<br>Hello world!";
			}
			$a = array("Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6", "Thứ 7","Chủ Nhật");
			foreach ($a as $value){
				echo "<br>".$value;
			}
			foreach ($a as $key=>$value){
				echo "<br>Phần tử thứ $key có giá trị $value";
			}
			
		?>
	</body>
</html>
<?php 

?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<?php 
			$dir = "images/";
			// Open a directory, and read its contents
			if (is_dir($dir)){
			  if ($dh = opendir($dir)){
				  $i=1;
				while (($file = readdir($dh)) !== false){
				  if (($file!='.') && ($file!='..')){
				  echo "<a href='' onClick='window.close();'><img width=200 border=0 
				  src='images/" . $file . "'></a> ";
				  $i++;
				  if ($i==4){
					  $i=1; echo "<p>";
				  }
				  }
				}
				closedir($dh);
			  }
			}
		?>
	</body>
</html>
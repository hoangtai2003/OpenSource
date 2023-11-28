<?php
	session_start();
	$name = $_FILES["fanh"]["name"];
	$target = "images/".date("Ymd").$name;
	$tmp_name = $_FILES["fanh"]["tmp_name"];
	$type = $_FILES["fanh"]["type"];
	$size = $_FILES["fanh"]["size"]; 
	//echo $name."<br>".$tmp_name."<br>".$type."<br>".$size;
	if ((($type!="image/png")&&($type!="image/jpeg")&&($type!="image/gif"))||($size>1000000)){
		$_SESSION["error_upload"]="Chỉ cho phép upload ảnh và dung lượng dưới 5M";
	} else if (move_uploaded_file($tmp_name,$target)){
		$_SESSION["error_upload"]="Tải tệp thành công!";
	}else {
		$_SESSION["error_upload"]="Tải tệp không thành công!";
	}
	header("Location:session02_upload.php");
	
?>
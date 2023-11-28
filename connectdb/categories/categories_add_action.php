<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$cname=$_POST["txtCname"];
	$cdesc=$_POST["taCdesc"];
	$cimage=$_POST["txtCimage"];
	$corder=$_POST["txtCorder"];
	$cstatus=$_POST["rdCstatus"];
	$sql = "select * from categories where cname like '$cname'";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["categories_add_error"]="$cname adready exist!";
		header("Location:categories_add.php");
	} else {
			$sql ="insert into Categories(cname,cdesc,cimage,corder,cstatus) values ('$cname','$cdesc','$cimage',$corder,$cstatus)";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["categories_error"] = "Update Successful!";
				header("Location:categories_view.php");
			} else {
				$_SESSION["categories_add_error"]="Error insert data!";
				header("Location:categories_add.php");
			}
	}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
	
	</body>
</html>
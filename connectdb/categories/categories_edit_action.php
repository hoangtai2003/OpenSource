<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$cid = $_GET["cid"];
	$cname=$_POST["txtCname"];
	$cdesc=$_POST["taCdesc"];
	$cimage=$_POST["txtCimage"];
	$corder=$_POST["txtCorder"];
	$cstatus=$_POST["rdCstatus"];
	$sql = "select * from categories where cname like '$cname' and cid<>$cid";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["categories_edit_error"]="$cname adready exist!";
		header("Location:categories_edit.php");
	} else {
			$sql ="update categories set
				 cname='$cname',
				 cdesc='$cdesc',
				 cimage='$cimage',
				 corder=$corder,
				 cstatus=$cstatus
			where cid=$cid";
			
			$conn->query($sql) or die($conn->error);
			$conn->close();
			if ($conn->error==""){
				$_SESSION["categories_error"] = "Update Successful!";
				header("Location:categories_view.php");
			} else {
				$_SESSION["categories_edit_error"]="Error update data!";
				header("Location:categories_edit.php");
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
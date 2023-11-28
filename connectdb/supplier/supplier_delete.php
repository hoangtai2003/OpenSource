<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$sid = $_GET["sid"];
	$sql = "delete from supplier where sid=$sid";
	$conn->query($sql) or die($conn->error);
	if ($conn->error==""){
		$_SESSION["supplier_error"]="Delete successful!";
	} else {
		$_SESSION["supplier_error"]="Delete fail!";
	}
    $conn->close();
	header("Location:supplier.php");
?>
<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$colorid = $_GET["colorid"];
	$sql = "delete from color where colorid=$colorid";
	$conn->query($sql) or die($conn->error);
	if ($conn->error==""){
		$_SESSION["color_error"]="Delete successful!";
	} else {
		$_SESSION["color_error"]="Delete fail!";
	}
    $conn->close();
	header("Location:color.php");
?>
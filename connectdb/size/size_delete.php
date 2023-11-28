<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$sizeid = $_GET["sizeid"];
	$sql = "delete from 0203466_size_18 where sizeid=$sizeid";
	$conn->query($sql) or die($conn->error);
	if ($conn->error==""){
		$_SESSION["size_error"]="Delete successful!";
	} else {
		$_SESSION["size_error"]="Delete fail!";
	}
    $conn->close();
	header("Location:size_view.php");
?>
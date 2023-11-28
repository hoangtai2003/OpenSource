<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$sizename=$_POST["txtSizename"];
	$sizestatus=$_POST["rdSizestatus"];
	$sql = "select * from 0203466_size_18 where sizename like '$sizename'";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["size_add_error"]="$sizename adready exist!";
		header("Location:size_add.php");
        exit(0);
	} else {
			$sql ="insert into 0203466_size_18(sizename,sizestatus) values ('$sizename',$sizestatus)";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["size_error"] = "Update Successful!";
				header("Location:size_view.php");
			} else {
				$_SESSION["size_add_error"]="Error insert data!";
				header("Location:size_add.php");
			}
	}

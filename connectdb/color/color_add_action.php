<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$colorname=$_POST["txtColorname"];
	$colorstatus=$_POST["rdColorstatus"];
	$sql = "select * from color where colorname like '$colorname'";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["color_add_error"]="$colorname adready exist!";
		header("Location:color_add.php");
        exit(0);
	} else {
			$sql ="insert into color(colorname,colorstatus) values ('$colorname',$colorstatus)";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["color_error"] = "Update Successful!";
				header("Location:color.php");
			} else {
				$_SESSION["color_add_error"]="Error insert data!";
				header("Location:color_add.php");
			}
	}

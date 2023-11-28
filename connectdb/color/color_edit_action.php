<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$colorid = $_GET["colorid"];
	$colorname=$_POST["txtColorname"];
	$colorstatus=$_POST["rdColorstatus"];
	$sql = "select * from color where colorname like '$colorname' and colorid<>$colorid";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["color_edit_error"]="$colorname adready exist!";
		header("Location:color_edit.php");
	} else {
        $sql ="update color set
                colorname='$colorname',
                colorstatus=$colorstatus
        where colorid=$colorid";
        $conn->query($sql) or die($conn->error);
        if ($conn->error==""){
            $_SESSION["color_error"] = "Update Successful!";
            header("Location:color.php");
        } else {
            $_SESSION["color_edit_error"]="Error update data!";
            header("Location:color_edit.php");
        }
        $conn->close();
	}
?>
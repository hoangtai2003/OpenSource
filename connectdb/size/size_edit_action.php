<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$sizeid = $_GET["sizeid"];
	$sizename=$_POST["txtSizename"];
	$sizestatus=$_POST["rdSizestatus"];
	$sql = "select * from 0203466_size_18 where sizename like '$sizename' and sizeid<>$sizeid";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["size_edit_error"]="$sizename adready exist!";
		header("Location:size_edit.php");
	} else {
        $sql ="update 0203466_size_18 set
                sizename='$sizename',
                sizestatus=$sizestatus
        where sizeid=$sizeid";
        $conn->query($sql) or die($conn->error);
        if ($conn->error==""){
            $_SESSION["size_error"] = "Update Successful!";
            header("Location:size_view.php");
        } else {
            $_SESSION["size_edit_error"]="Error update data!";
            header("Location:size_edit.php");
        }
        $conn->close();
	}
?>
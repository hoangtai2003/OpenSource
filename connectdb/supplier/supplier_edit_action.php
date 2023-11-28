<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$sid = $_GET["sid"];
	$sname=$_POST["txtSname"];
	$saddress=$_POST["txtSaddress"];
	$sphone=$_POST["txtSphone"];
	$stax=$_POST["txtStax"];
	$sstatus=$_POST["rdSstatus"];
	$sql = "select * from supplier where sname like '$sname' and sid<>$sid";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["supplier_edit_error"]="$sname adready exist!";
		header("Location:supplier_edit.php");
	} else {
        $sql ="update supplier set
                sname='$sname',
                saddress='$saddress',
                sphone='$sphone',
                stax=$stax,
                sstatus=$sstatus
        where sid=$sid";
        $conn->query($sql) or die($conn->error);
        if ($conn->error==""){
            $_SESSION["supplier_error"] = "Update Successful!";
            header("Location:supplier.php");
        } else {
            $_SESSION["supplier_edit_error"]="Error update data!";
            header("Location:supplier_edit.php");
        }
        $conn->close();
	}
?>
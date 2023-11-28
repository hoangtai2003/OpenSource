<?php
	session_start();
	require_once("../connect.php"); //kết nối CSDL
	$sname=$_POST["txtSname"];
	$saddress=$_POST["txtSaddress"];
	$sphone=$_POST["txtSphone"];
	$stax=$_POST["txtStax"];
	$sstatus=$_POST["rdSstatus"];
	$sql = "select * from supplier where sname like '$sname'";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		$_SESSION["supplier_add_error"]="$sname adready exist!";
		header("Location:supplier_add.php");
        exit(0);
	} else {
			$sql ="insert into supplier(sname,saddress,sphone,stax,sstatus) values ('$sname','$saddress','$sphone',$stax,$sstatus)";
			$conn->query($sql) or die($conn->error);
			if ($conn->error==""){
				$_SESSION["supplier_error"] = "Update Successful!";
				header("Location:supplier.php");
			} else {
				$_SESSION["supplier_add_error"]="Error insert data!";
				header("Location:supplier_add.php");
			}
	}

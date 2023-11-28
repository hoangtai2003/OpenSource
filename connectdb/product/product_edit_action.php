<?php 
	session_start();
	require("../connect.php");
	$pid = $_REQUEST["pid"];
	$pname = $_POST["txtPname"];
	$pdesc = $_POST["taPdesc"];
	$pimage = $_POST["txtPimage"];
	$porder = $_POST["txtPorder"];
	$pprice = $_POST["txtPprice"];
	$pquantity = $_POST["txtPquantity"];
	$cid = $_POST["slCid"];
	$pstatus = $_POST["rdPstatus"];
	$sql = "select * from 0203466_product_18 where pname='".$pname."' and pid<>$pid";
	$result = $conn->query($sql) or die($conn->error);
	if ($result->num_rows>0){
		$_SESSION["product_edit_error"]="$pname exist!";
		header("Location:product_edit.php?pid=$pid");
	} else {
		$sql_update="update 0203466_product_18 set 
						pname='$pname',
						pdesc='$pdesc',
						pimage='$pimage',
						porder = $porder,
                        pprice = $pprice,
                        pquantity = $pquantity,
                        cid = $cid,
						pstatus= $pstatus
						where pid=$pid";
		$conn->query($sql_update) or die($conn->error);
		$conn->close();
		$_SESSION["product_error"]="Update success!";
		header("Location:product_view.php");
	}
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	</body>
</html>
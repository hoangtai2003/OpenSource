<?php 
	session_start();
	require_once("../connect.php");
    if (!isset($_SESSION["supplier_edit_error"])){
		$_SESSION["supplier_edit_error"]="";
    }
	$sid = $_GET["sid"];
	$sql = "select * from supplier where sid=$sid";
	$result = $conn->query($sql);
	if ($result->num_rows==0){
		$_SESSION["supplier_error"]="Data not exist!";
		header("Location:supplier.php");
	} else {
		$row = $result->fetch_assoc();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Edit supplier</h1>
		<center><font color=red><?php echo $_SESSION["supplier_edit_error"];?></font></center>
		<form method=POST action="supplier_edit_action.php?sid=<?php echo $sid;?>">
			<table border=0 align=center width=400>
                <tr>
                    <input type="hidden" name="sid" value="<?php echo $row["sid"];?>">
                </tr>
				<tr>
					<td>Supplier Name:</td>
	                <td><input style="width:180px" type=text value="<?php echo $row["sname"];?>" name=txtSname></td>
				</tr>
				<tr>
					<td>Supplier Address:</td>
					<td><input style="width:180px" type=text value="<?php echo $row["saddress"];?>" name=txtSaddress></td>
				</tr>
				<tr>
					<td>Supplier Phone:</td>
					<td><input type=text  style="width:180px" value="<?php echo $row["sphone"];?>" name=txtSphone></td>
				</tr>
				<tr>
					<td>Supplier Tax:</td>
					<td><input type=text style="width:180px" name=txtStax  value="<?php echo $row["stax"];?>"></td>
				</tr>
				<tr>
					<td>Supplier Status:</td>
					<td><input type=radio
						<?php 
							if ($row["sstatus"]==1) echo " checked";
						?> name=rdSstatus value=1>Active
						<input type=radio <?php 
							if ($row["sstatus"]==0) echo " checked";
						?> name=rdSstatus value=0>Inactive
					</td>
				</tr>
				<tr>
					<td align=right><input type=submit value="Update"></td>
					<td><input type=reset value="Reset">
				</tr>
			</table>
		</form>
	</body>
</html>
<?php 
	}
	$conn->close();
	$_SESSION["supplier_edit_error"]="";
?>
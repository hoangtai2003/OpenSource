<?php 
	session_start();
	if (!isset($_SESSION["supplier_error"])){
		$_SESSION["supplier_error"]="";
	}
	require_once("../connect.php");
	$result=$conn->query("select * from supplier");
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1 align=center>Supplier List</h1>
		<center><font color=red><?php echo $_SESSION["supplier_error"];?></font>
		<br>
			<a href="supplier_add.php">Add new supplier</a>
		</center>
		<table border=1 align=center width=100% cellspacing=5>
			<tr>
				<th>Supplier ID</th>
				<th>Supplier Name</th>
				<th>Supplier Address</th>
				<th>Supplier Phone</th>
				<th>Supplier Tax</th>
				<th>Supplier Status</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php 
				while ($row = $result->fetch_assoc()){
					?>
			<tr>
				<td><?php echo $row["sid"];?></td>
				<td><?php echo $row["sname"];?></td>
				<td><?php echo $row["saddress"];?></td>
				<td><?php echo $row["sphone"];?></td>
                <td><?php echo $row["stax"];?></td>
				<td><?php if ($row["sstatus"]==1) echo "Active";
							else echo "Inactive";?></td>
				<td>
					<a href="supplier_edit.php?sid=<?php echo $row["sid"];?>">Edit
					
					</a>
				</td>
				<td>
					<a onclick="return confirm('Are you sure to delete <?php echo $row['sname'];?>?');" href="supplier_delete.php?sid=<?php echo $row["sid"];?>">delete
					</a>
				</td>
				
			</tr>
			<?php 
				}
				$conn->close();
			?>
			
		</table>
		<?php 
		?>
	</body>
</html>
<?php 
	unset($_SESSION["supplier_error"]);
?>
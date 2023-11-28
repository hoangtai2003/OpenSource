<?php 
	session_start();
	if (!isset($_SESSION["size_error"])){
		$_SESSION["size_error"]="";
	}
	require_once("../connect.php");
	$result=$conn->query("select * from 0203466_size_18");
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1 align=center>Size List</h1>
		<center><font color=red><?php echo $_SESSION["size_error"];?></font>
		<br>
			<a href="size_add.php">Add new size</a>
		</center>
		<table border=1 align=center width=100% cellspacing=5>
			<tr>
				<th>Size ID</th>
				<th>Size Name</th>
				<th>Size Status</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php 
				while ($row = $result->fetch_assoc()){
					?>
			<tr>
				<td><?php echo $row["sizeid"];?></td>
				<td><?php echo $row["sizename"];?></td>
				<td><?php if ($row["sizestatus"]==1) echo "Active";
							else echo "Inactive";?></td>
				<td>
					<a href="size_edit.php?sizeid=<?php echo $row["sizeid"];?>">Edit
					
					</a>
				</td>
				<td>
					<a 
                        onclick="return confirm('Are you sure to delete <?php echo $row['sizename'];?>?');" 
                        href="size_delete.php?sizeid=<?php echo $row["sizeid"];?>">delete
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
	unset($_SESSION["color_error"]);
?>
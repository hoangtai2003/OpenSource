<?php 
	session_start();
	if (!isset($_SESSION["color_error"])){
		$_SESSION["color_error"]="";
	}
	require_once("../connect.php");
	$result=$conn->query("select * from color");
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1 align=center>Color List</h1>
		<center><font color=red><?php echo $_SESSION["color_error"];?></font>
		<br>
			<a href="color_add.php">Add new color</a>
		</center>
		<table border=1 align=center width=100% cellspacing=5>
			<tr>
				<th>Color ID</th>
				<th>Color Name</th>
				<th>Color Status</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php 
				while ($row = $result->fetch_assoc()){
					?>
			<tr>
				<td><?php echo $row["colorid"];?></td>
				<td><?php echo $row["colorname"];?></td>
				<td><?php if ($row["colorstatus"]==1) echo "Active";
							else echo "Inactive";?></td>
				<td>
					<a href="color_edit.php?colorid=<?php echo $row["colorid"];?>">Edit
					
					</a>
				</td>
				<td>
					<a 
                        onclick="return confirm('Are you sure to delete <?php echo $row['colorname'];?>?');" 
                        href="color_delete.php?colorid=<?php echo $row["colorid"];?>">delete
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
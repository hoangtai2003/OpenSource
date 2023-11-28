<?php 
	session_start();
	if (!isset($_SESSION["categories_error"])){
		$_SESSION["categories_error"]="";
	}
	require_once("../connect.php");
	$result=$conn->query("select * from categories");
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1 align=center>Categories List</h1>
		<center><font color=red><?php echo $_SESSION["categories_error"];?></font>
		<br>
			<a href="categories_add.php">Add new categories</a>
		</center>
		<table border=1 align=center width=100% cellspacing=5>
			<tr>
				<th>Category ID</th>
				<th>Category Name</th>
				<th>Category Image</th>
				<th>Category Description</th>
				<th>Category Order</th>
				<th>Category status</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
			<?php 
				while ($row = $result->fetch_assoc()){
					?>
			<tr>
				<td><?php echo $row["cid"];?></td>
				<td><?php echo $row["cname"];?></td>
				<td><img src="../product/images/<?php echo $row["cimage"];?>" width=200></td>
				<td><?php echo $row["cdesc"];?></td>
				<td><?php echo $row["corder"];?></td>
				<td><?php if ($row["cstatus"]==1) echo "Active";
							else echo "Inactive";?></td>
				<td>
					<a href="categories_edit.php?cid=<?php echo $row["cid"];?>">Edit
					
					</a>
				</td>
				<td>
					<a onclick="return confirm('Are you sure to delete <?php echo $row["cname"];?>?');" href="categories_delete.php?cid=<?php echo $row["cid"];?>">delete
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
	unset($_SESSION["categories_error"]);
?>
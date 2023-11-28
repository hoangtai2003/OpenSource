<?php 
	session_start();
	require_once("../connect.php");
if (!isset($_SESSION["categories_edit_error"])){
		$_SESSION["categories_edit_error"]="";
	
}
	$cid = $_GET["cid"];
	$sql = "select * from categories where cid=$cid";
	$result = $conn->query($sql);
	if ($result->num_rows==0){
		$_SESSION["categories_error"]="Data not exist!";
		header("Location:categories_view.php");
	} else {
		$row = $result->fetch_assoc();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Edit category</h1>
		<center><font color=red><?php echo $_SESSION["categories_edit_error"];?></font></center>
		<form method=POST action="categories_edit_action.php?cid=<?php echo $cid;?>">
			<table border=0 align=center width=400>
				<tr>
					<td>Category Name:</td>
	<td><input style="width:180px" type=text value="<?php echo $row["cname"];?>" name=txtCname></td>
				</tr>
				<tr>
					<td>Category Description:</td>
					<td><textarea cols=20 style="width:180px" rows=6 name=taCdesc><?php echo $row["cdesc"];?></textarea></td>
				</tr>
				<tr>
					<td>Category Image:</td>
					<td><input type=text  style="width:180px" value="<?php echo $row["cimage"];?>" name=txtCimage></td>
				</tr>
				<tr>
					<td>Category Order:</td>
					<td><input type=text style="width:180px" name=txtCorder  value="<?php echo $row["corder"];?>"></td>
				</tr>
				<tr>
					<td>Category Status:</td>
					<td><input type=radio
						<?php 
							if ($row["cstatus"]==1) echo " checked";
						?> name=rdCstatus value=1>Active
						<input type=radio <?php 
							if ($row["cstatus"]==0) echo " checked";
						?> name=rdCstatus value=0>Inactive
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
	$_SESSION["categories_edit_error"]="";
?>
<?php 
	session_start();
	require_once("../connect.php");
    if (!isset($_SESSION["color_edit_error"])){
		$_SESSION["color_edit_error"]="";
    }
	$colorid = $_GET["colorid"];
	$sql = "select * from color where colorid=$colorid";
	$result = $conn->query($sql);
	if ($result->num_rows==0){
		$_SESSION["color_error"]="Data not exist!";
		header("Location:color.php");
	} else {
		$row = $result->fetch_assoc();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Edit color</h1>
		<center><font color=red><?php echo $_SESSION["color_edit_error"];?></font></center>
		<form method=POST action="color_edit_action.php?colorid=<?php echo $colorid;?>">
			<table border=0 align=center width=400>
                <tr>
                    <input type="hidden" name="colorid" value="<?php echo $row["colorid"];?>">
                </tr>
				<tr>
					<td>Color Name:</td>
	                <td><input style="width:180px" type=text value="<?php echo $row["colorname"];?>" name=txtColorname></td>
				</tr>
				<tr>
					<td>Color Status:</td>
					<td><input type=radio
						<?php 
							if ($row["colorstatus"]==1) echo " checked";
						?> name=rdColorstatus value=1>Active
						<input type=radio <?php 
							if ($row["colorstatus"]==0) echo " checked";
						?> name=rdColorstatus value=0>Inactive
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
	$_SESSION["color_edit_error"]="";
?>
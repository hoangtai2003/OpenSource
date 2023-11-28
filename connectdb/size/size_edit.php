<?php 
	session_start();
	require_once("../connect.php");
    if (!isset($_SESSION["size_edit_error"])){
		$_SESSION["size_edit_error"]="";
    }
	$sizeid = $_GET["sizeid"];
	$sql = "select * from 0203466_size_18 where sizeid=$sizeid";
	$result = $conn->query($sql);
	if ($result->num_rows==0){
		$_SESSION["size_error"]="Data not exist!";
		header("Location:size_view.php");
	} else {
		$row = $result->fetch_assoc();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tiêu đề trang web</title>
	</head>
	<body>
		<h1 align=center>Edit size</h1>
		<center><font color=red><?php echo $_SESSION["size_edit_error"];?></font></center>
		<form method=POST action="size_edit_action.php?sizeid=<?php echo $sizeid;?>">
			<table border=0 align=center width=400>
                <tr>
                    <input type="hidden" name="sizeid" value="<?php echo $row["sizeid"];?>">
                </tr>
				<tr>
					<td>Size Name:</td>
	                <td><input style="width:180px" type=text value="<?php echo $row["sizename"];?>" name=txtSizename></td>
				</tr>
				<tr>
					<td>Size Status:</td>
					<td><input type=radio
						<?php 
							if ($row["sizestatus"]==1) echo " checked";
						?> name=rdSizestatus value=1>Active
						<input type=radio <?php 
							if ($row["sizestatus"]==0) echo " checked";
						?> name=rdSizestatus value=0>Inactive
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
	$_SESSION["size_edit_error"]="";
?>
<?php 
	session_start();
	if (!isset($_SESSION["product_edit_error"])){
		$_SESSION["product_edit_error"]="";
	}
	$pid =$_REQUEST["pid"];
    $sql1 = "select * from categories";
	$sql2 = "select * from 0203466_supplier_18";
	$sql3 = "select * from 0203466_size_18";
	$sql = "SELECT 0203466_product_18.* from 
	0203466_product_18 inner join categories on 0203466_product_18.cid= categories.cid 
	INNER JOIN 0203466_size_18 on 0203466_product_18.sizeid = 0203466_size_18.sizeid 
	INNER JOIN 0203466_supplier_18 on 0203466_product_18.sid = 0203466_supplier_18.sid where pid = ".$pid;
	require("../connect.php");
    $result1 = $conn->query($sql1) or die($conn->error);
	$result2 = $conn->query($sql2) or die($conn->error);
	$result3 = $conn->query($sql3) or die($conn->error);
	$result = $conn->query($sql) or die($conn->error);
	if ($result->num_rows==0){
		$_SESSION["product_error"]="Data not exist!";
		header("Location:product_view.php");
	} else {
        $row = $result->fetch_assoc();
        
?>
<html>
	<head>
		<meta charset="utf-8">
		<style type="text/css">
			.width{
				width:250px;
			}
		</style>
	</head>
	<body>
		<h1 align=center>Edit product</h1>
		<center>
			<font color=red><?php echo $_SESSION["product_edit_error"];?></font>
		</center>
		<form method=POST action="product_edit_action.php?pid=<?php echo $pid;?>">
			<table border=0 align=center cellspacing=10 class="table table-hover">
				<tr>
					<td align=right>Product Name:</td>
					<td><input type=text name=txtPname class=width value="<?php echo $row["pname"]?>"></td>
				<tr>
				<tr>
					<td align=right valign=top>Product Description:</td>
					<td><textarea class=width rows=10 name=taPdesc><?php echo $row["pdesc"];?></textarea></td>
				</tr>
				<tr>
					<td align=right valign=top>Product Image:</td>
					<td><input type=text class=width name=txtPimage value="<?php echo $row["pimage"];?>">
						<br>
						<img src="images/<?php echo $row["pimage"];?>" class=width>
					</td>
				</tr>
				<tr>
					<td align=right>Product Order:</td>
					<td><input class=width type=text name=txtPorder value="<?php echo $row["porder"];?>"></td>
				</tr>
                <tr>
					<td align=right>Product Price:</td>
					<td><input class=width type=text name=txtPprice value="<?php echo $row["pprice"];?>"></td>
				</tr>
                <tr>
					<td align=right>Product Quantiy:</td>
					<td><input class=width type=text name=txtPquantity value="<?php echo $row["pquantity"];?>"></td>
				</tr>
                <tr>
					<td align=right>Category Name:</td>
					<td>
                        <select name="slCid">
                            <?php 
                            while($row1 = $result1->fetch_assoc()){
                                if($row1["cid"] == $row["cid"]){ 
                            ?>
                                <option value="<?php echo $row1["cid"]?>" selected><?php echo $row1["cname"] ?></option>
                            <?php
                                }else{
                            ?>
                                <option value="<?php echo $row1["cid"]?>"><?php echo $row1["cname"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
				</tr>
				<tr>
					<td align=right>Tên nhà cung cấp:</td>
					<td>
                        <select name="slSid">
                            <?php 
                            while($row2 = $result2->fetch_assoc()){
                                if($row2["sid"] == $row["sid"]){ 
                            ?>
                                <option value="<?php echo $row2["sid"]?>" selected><?php echo $row2["sname"] ?></option>
                            <?php
                                }else{
                            ?>
                                <option value="<?php echo $row2["sid"]?>"><?php echo $row2["sname"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
				</tr>
				<tr>
					<td align=right>Size:</td>
					<td>
                        <select name="slSizeid">
                            <?php 
                            while($row3 = $result3->fetch_assoc()){
                                if($row3["sizeid"] == $row["sizeid"]){ 
                            ?>
                                <option value="<?php echo $row3["sizeid"]?>" selected><?php echo $row3["sizename"] ?></option>
                            <?php
                                }else{
                            ?>
                                <option value="<?php echo $row3["sizeid"]?>"><?php echo $row3["sizename"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
				</tr>
				<tr>
					<td align=right>Product Status:</td>
					<td>
						<input type=radio name=rdPstatus value=1 <?php if ($row["pstatus"]==1) { echo " checked ";}?>>Active
						<input type=radio name=rdPstatus value=0 <?php if ($row["pstatus"]==0) { echo " checked ";}?>>Inactive
					</td>
				</tr>
				<tr>
					<td align=right><input type=submit value="Update" class="btn btn-sm btn-success"></td>
					<td><input type=reset class="btn btn-sm btn-danger">
				</tr>
			</table>
		</form>
	</body>
</html>
<?php 
    }
	$conn->close();
	unset($_SESSION["product_edit_error"]);
?>
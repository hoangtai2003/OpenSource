<?php 
    include("../connect.php");
    if (!isset($_SESSION["product_error"])){
		$_SESSION["product_error"]="";
	}
    $action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
    $pid = isset($_REQUEST["pid"]) ? $_REQUEST["pid"] : "";
    switch($action){
        case "add_new":
            $pname = $_POST["txtPname"];
            $pdesc = $_POST["taPdesc"];
            $pimage = $_POST["txtPimage"];
            $porder = $_POST["txtPorder"];
            $pquantity = $_POST["txtPquantity"];
            $cid = $_POST["slCid"];
            $sid = $_POST["slSid"];
            $colorid = $_POST["slColorid"];
            $pprice = $_POST["txtPprice"];
            $pcode = $_POST["txtPcode"];
            $sizeid = $_POST["slSizeid"];
            $pstatus = $_POST["rdPstatus"];
            $sql = "select * from 0203466_Product_18 where pname = '$pname' ";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $_SESSION['product_error'] = "Đã tồn tại tên sản phẩm";
            } else {
                $sql = "insert into 0203466_product_18
                (pname, pdesc, pimage, porder, pprice, pquantity, cid, sid, colorid, code, sizeid,  pstatus) values('$pname', '$pdesc', '$pimage', '$porder', '$pprice', '$pquantity', '$cid', '$sid', '$colorid', '$pcode', '$sizeid', '$pstatus')";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $_SESSION['product_error'] = "Thêm sản phẩm thành công";
                } else {
                    $_SESSION['product_error'] = "Xin mời nhập lại";
                } 
            }
            break;
        case "save_edit":
            $pname = $_POST["txtPname"];
            $pdesc = $_POST["taPdesc"];
            $pimage = $_POST["txtPimage"];
            $porder = $_POST["txtPorder"];
            $pquantity = $_POST["txtPquantity"];
            $cid = $_POST["slCid"];
            $sid = $_POST["slSid"];
            $colorid = $_POST["slColorid"];
            $pprice = $_POST["txtPprice"];
            $pcode = $_POST["txtPcode"];
            $sizeid = $_POST["slSizeid"];
            $pstatus = $_POST["rdPstatus"];
            $sql = "select * from 0203466_product_18 where pname='".$pname."' and pid<>$pid";
            $result = $conn->query($sql) or die($conn->error);
            if ($result->num_rows>0){
                $_SESSION["product_edit_error"]="$pname đã tồn tại!";
            } else {
                $sql_update="update 0203466_product_18 set 
                                pname='$pname',
                                pdesc='$pdesc',
                                pimage='$pimage',
                                porder = $porder,
                                pprice = $pprice,
                                pquantity = $pquantity,
                                cid = $cid,
                                sid = $sid,
                                colorid = $colorid,
                                sizeid = $sizeid,
                                code = '$pcode',
                                pstatus= $pstatus
                                where pid=$pid";
                $update = mysqli_query($conn, $sql_update);
                $_SESSION["product_error"]="Cập nhật thành công!";
            }
            break;
        case "delete":
            $sql = "delete from 0203466_product_18 where pid = '$pid'";
            $result = mysqli_query($conn, $sql);
            break;
        default:
            break;
    }
    $sql = 
    "select 0203466_product_18.*, categories.cname, 0203466_supplier_18.sname, color.colorname, 0203466_size_18.sizename 
    from 0203466_product_18,  categories, 0203466_supplier_18, 0203466_size_18, color 
    where 0203466_product_18.cid = categories.cid and 0203466_product_18.sid = 0203466_supplier_18.sid
    and 0203466_product_18.colorid = color.colorid and 0203466_product_18.sizeid =  0203466_size_18.sizeid";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 align = center>Danh sách các sản phẩm trong hệ thống</h1>
    <center><font color=red><?php echo $_SESSION["product_error"]?></font></center>
    <br>
	<center><a href="?action=add">Thêm mới một sản phẩm</a></center>
    <table border=1 width=100% align=center>
        <tr>
			<th>Mã sản phẩm</th>
			<th>Tên sản phẩm</th>
			<th>Mô tả sản phẩm</th>
			<th>Ảnh sản phẩm</th>
            <th>Sắp xếp</th>
            <th>Giá tiền</th>
            <th>Số lượng</th>
            <th>Mã Code</th>
			<th>Tên danh mục</th>
            <th>Màu sắc</th>
			<th>Tên nhà cung cấp</th>			
			<th>Size</th>
            <th>Trạng thái</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
            <?php 
                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        if($action == "edit"){
                            ?>
                                <form method="POST" action="product_view_all.php?action=save_edit&pid=<?=$row["pid"]?> ">
                                    <tr valign=top>
                                        <td><?= $row["pid"]?></td>
                                        <td><input type="text" name="txtPname" value="<?=$row["pname"]?>"></td>
                                        <td><input type="text" name="taPdesc" value="<?=$row["pdesc"]?>"></td>
                                        <td><input type="text" name="txtPimage" value="<?=$row["pimage"]?>"></td>
                                        <td><input type="text" name="txtPorder" value="<?=$row["porder"]?>"></td>
                                        <td><input type="text" name="txtPprice" value="<?=$row["pprice"]?>"></td>
                                        <td><input type="text" name="txtPquantity" value="<?=$row["pquantity"]?>"></td>
                                        <td><input type="text" name="txtPcode" value="<?=$row["code"]?>"></td>
                                        <td>
                                            <select name="slCid">
                                                <?php 
                                                    $result1 = mysqli_query($conn, "select * from categories");
                                                while($row1 = $result1->fetch_assoc()){
                                                    if($row1["cid"] == $row["cid"]){ 
                                                ?>
                                                    <option value="<?= $row1["cid"]?>" selected><?= $row1["cname"] ?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                    <option value="<?= $row1["cid"]?>"><?= $row1["cname"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="slColorid">
                                                <?php 
                                                    $result2 = mysqli_query($conn, "select * from color");
                                                while($row2 = $result2->fetch_assoc()){
                                                    if($row2["colorid"] == $row["colorid"]){ 
                                                ?>
                                                    <option value="<?= $row2["colorid"]?>" selected><?= $row2["colorname"] ?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                    <option value="<?= $row2["colorid"]?>"><?= $row2["colorname"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="slSid">
                                                <?php 
                                                    $result3 = mysqli_query($conn, "select * from 0203466_supplier_18");
                                                while($row3 = $result3->fetch_assoc()){
                                                    if($row3["sid"] == $row["sid"]){ 
                                                ?>
                                                    <option value="<?= $row3["sid"]?>" selected><?= $row3["sname"] ?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                    <option value="<?= $row3["sid"]?>"><?= $row3["sname"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="slSizeid">
                                                <?php 
                                                    $result4 = mysqli_query($conn, "select * from 0203466_size_18");
                                                while($row4 = $result4->fetch_assoc()){
                                                    if($row4["sizeid"] == $row["sizeid"]){ 
                                                ?>
                                                    <option value="<?= $row4["sizeid"]?>" selected><?= $row4["sizename"] ?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                    <option value="<?= $row4["sizeid"]?>"><?= $row4["sizename"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type=radio name=rdPstatus value=1 <?php if ($row["pstatus"]==1) { echo " checked ";}?>>Active
                                            <input type=radio name=rdPstatus value=0 <?php if ($row["pstatus"]==0) { echo " checked ";}?>>Inactive
                                        </td>
                                        <td><input type=submit value="Cập nhật"></td>
								        <td><input type=button onclick="window.location='product_view_all.php';" value="Hủy bỏ"></td>
                                    </tr>
                                </form>
                            <?php
                        } else {
                            ?>
                                <tr>
                                    <td><?= $row["pid"];?></td>
                                    <td><?= $row["pname"];?></td>
                                    <td><?= $row["pdesc"];?></td>
                                    <td><img width=300 src="images/<?= $row["pimage"];?>"></td>
                                    <td><?= $row["porder"];?></td>
                                    <td><?= $row["pprice"];?></td>
                                    <td><?= $row["pquantity"];?></td>
                                    <td><?= $row["code"];?></td>
                                    <td><?= $row["cname"];?></td>
                                    <td><?= $row["colorname"];?></td>
                                    <td><?= $row["sname"];?></td>
                                    <td><?= $row["sizename"];?></td>
                                    <td><?php
                                    if ($row["pstatus"]==1){
                                        echo "Hoạt động";
                                    } else { 
                                        echo "Ngừng hoạt động";
                                    } 
                                    ?></td>
                                    <td><a href="product_view_all.php?action=edit&pid=<?= $row["pid"];?>">Sửa</a></td>
                                    <td><a onclick="return confirm("Bạn có chắc muốn xoá <?=$row["pname"]?> hay ko?)  href="product_view_all.asp?action=delete&pid=<?=$row["pid"]?>">Xóa</a></td>
                                </tr>
                            <?php
                        }
                    }
                }
            ?>
    </table>
	<center><a href="?action=add">Thêm mới một sản phẩm</a></center>	
    <?php 
        if ($action == "add"){
            $result1 = mysqli_query($conn, "select * from categories");
            $result2 = mysqli_query($conn, "select * from 0203466_supplier_18");
            $result3 = mysqli_query($conn, "select * from 0203466_size_18");
            $result4 = mysqli_query($conn, "select * from color");
            

    ?>		
	<center><font color=red><?php echo $_SESSION["product_error"]?></font></center>
    <form method=POST action="product_view_all.php">
        <table align=center border=0>
            <tr>
                <td align=right>Product Name:</td>
                <td><input type=text name=txtPname class=width></td>
            </tr>
            <tr>
                <td valign=top align=right>Product Description:</td>
                <td>
                    <textarea class=width cols=20 rows=7 name=taPdesc></textarea>
                </td>
            </tr>
            <tr></tr>
                <td align=right>Product Image:</td>
                <td>
                    <input type=text name=txtPimage class=width>
                </td>
            </tr>
            <tr>
                <td align=right>Product Order:</td>
                <td><input type=text name=txtPorder class=width></td>
            </tr>
            <tr>
                <td align=right>Product Price:</td>
                <td><input type=text name=txtPprice class=width></td>
            </tr>
            <tr>
                <td align=right>Product Quantity:</td>
                <td><input type=text name=txtPquantity class=width></td>
            </tr>
            <tr>
                <td align=right>Mã code:</td>
                <td><input type=text name=txtPcode class=width></td>
            </tr>
            <tr>
                <td align=right>Nhóm sản phẩm:</td>
                <td>
                    <select name="slCid">
                        <option value="0"></option>
                        <?php
                            if(mysqli_num_rows($result1) > 0){
                                while ($row = mysqli_fetch_assoc($result1)){
                                    ?>
                                        <option value="<?=$row['cid']?>"><?=$row['cname']?></option>
                                    <?php
                                }
                            } 
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align=right>Nhà cung cấp:</td>
                <td>
                    <select name="slSid">
                        <option value="0"></option>
                        <?php
                            if(mysqli_num_rows($result2) > 0){
                                while ($row = mysqli_fetch_assoc($result2)){
                                    ?>
                                        <option value="<?=$row['sid']?>"><?=$row['sname']?></option>
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
                        <option value="0"></option>
                        <?php
                            if(mysqli_num_rows($result3) > 0){
                                while ($row = mysqli_fetch_assoc($result3)){
                                    ?>
                                        <option value="<?=$row['sizeid']?>"><?=$row['sizename']?></option>
                                    <?php
                                }
                            } 
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align=right>Color:</td>
                <td>
                    <select name="slColorid">
                        <option value="0"></option>
                        <?php
                            if(mysqli_num_rows($result4) > 0){
                                while ($row = mysqli_fetch_assoc($result4)){
                                    ?>
                                        <option value="<?=$row['colorid']?>"><?=$row['colorname']?></option>
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
                    <input type=radio checked name=rdPstatus value=1>Active
                    <input type=radio name=rdPstatus value=0>Inactive
                </td>
            </tr>
            <tr>
					<td align=right><input type=submit value="Thêm mới"></td>
					<td><input type=reset value="Làm lại">
						<input type=hidden name="action" value="add_new">
				</tr>
        </table>
	</form>
    <?php
        }
    ?>
</body>
</html>
<?php 
session_start();
require_once("../connect.php");

$search = '';
$category = '';
$supplier = '';
$size = '';
if (isset($_POST["cmd"])) {
    $search = isset($_POST["txtSearch"]) ? $_POST["txtSearch"] : "";
    $category = isset($_POST["slcid"]) ? $_POST["slcid"] : "";
    $supplier = isset($_POST["slsid"]) ? $_POST["slsid"] : "";
    $size = isset($_POST["slsizeid"]) ? $_POST["slsizeid"] : "";

    $hiddenKey = "HoàngĐứcTài PM1_18"; 

    $sql = "select 0203466_product_18.*, categories.cname, 0203466_supplier_18.sname, 0203466_size_18.sizename 
						from 0203466_product_18 
						inner join categories on 0203466_product_18.cid= categories.cid 
						INNER JOIN 0203466_size_18 on 0203466_product_18.sizeid = 0203466_size_18.sizeid 
						INNER JOIN 0203466_supplier_18 on 0203466_product_18.sid = 0203466_supplier_18.sid
						where (pname like '%".$search."%'
						or pdesc like '%".$search."%')";
    $result = $conn->query($sql) or die($conn->error);
}
?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h1 align="center">Search Product</h1>
    <form name="f" method="POST">
        <center>
            Enter text to find:
            <input type="text" name="txtSearch" value="<?php echo $search; ?>" size="50">
            <input type="submit" value="Search" name="cmd">
        </center>
        <tr>
            <td>Nhóm sản phẩm:</td>
            <td>
                <select name="slcid">
                    <option value="">-- All --</option>
                    <?php
                    $sql1 = "SELECT * FROM categories";
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            ?>
                            <option value="<?= $row1['cid'] ?>" <?php if ($row1['cid'] == $category) echo "selected"; ?>><?= $row1['cname'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nhà cung cấp:</td>
            <td>
                <select name="slsid">
                    <option value="">-- All --</option>
                    <?php
                    $sql2 = "SELECT * FROM 0203466_supplier_18";
                    $result2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                            <option value="<?= $row2['sid'] ?>" <?php if ($row2['sid'] == $supplier) echo "selected"; ?>><?= $row2['sname'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Size:</td>
            <td>
                <select name="slsizeid">
                    <option value="">-- All --</option>
                    <?php
                    $sql3 = "SELECT * FROM 0203466_size_18";
                    $result3 = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result3) > 0) {
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            ?>
                            <option value="<?= $row3['sizeid'] ?>" <?php if ($row3['sizeid'] == $size) echo "selected"; ?>><?= $row3['sizename'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </form>
    <table border="1" width="100%" align="center">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category Name</th>
            <th>Size name</th>
            <th>Supplier Name</th>
            <th>Hidden Key</th>
        </tr>
        <?php
        if (isset($_POST["cmd"])) {
            if ($result->num_rows == 0) {
                echo "<tr><td style='color:red' colspan=10>No result!</td></tr>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["pid"]; ?></td>
                        <td><?php echo $row["pname"]; ?></td>
                        <td><?php echo $row["pdesc"]; ?></td>
                        <td><img src="images/<?php echo $row["pimage"]; ?>" width="200"></td>
                        <td><?php echo $row["pprice"]; ?></td>
                        <td><?php echo $row["pquantity"]; ?></td>
                        <td><?php echo $row["cname"]; ?></td>
                        <td><?php echo $row["sizename"]; ?></td>
                        <td><?php echo $row["sname"]; ?></td>
                        <td><?php echo $hiddenKey; ?></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </table>
</body>
</html>

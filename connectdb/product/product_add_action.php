<?php
session_start();
    include("../connect.php");
    if (isset($_POST["add_btn"])){
        $pname = $_POST["txtPname"];
        $pdesc = $_POST["taPdesc"];
        $pimage = $_POST["txtPimage"];
        $porder = $_POST["txtPorder"];
        $pprice = $_POST["txtPprice"];
        $pquantity = $_POST["txtPquantity"];
        $cid = $_POST["slcid"];
        $sid = $_POST["slsid"];
        $sizeid = $_POST["slsizeid"];
        $pstatus  = $_POST["rdPstatus"];
        $sql = "Select * from 0203466_product_18 where pname = '$pname'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $_SESSION['product_error'] = "Đã tồn tại tên sản phẩm";
            header("Location: product_add.php");
            exit(0);
        } else {
            $sql = "insert into 0203466_product_18(pname, pdesc, pimage, porder, pprice, pquantity, cid,sid, sizeid,  pstatus) values('$pname', '$pdesc', '$pimage', '$porder', '$pprice', '$pquantity', '$cid','$sid','$sizeid', '$pstatus')";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            if ($result){
                $_SESSION['product_error'] = "Thêm sản phẩm thành công";
                header("Location: product_view.php");
                exit(0);
            } else {
                $_SESSION['product_error'] = "Xin mời nhập lại";
                header("Location: product_add.php");
                exit(0); 
            }
        }
    }

?>
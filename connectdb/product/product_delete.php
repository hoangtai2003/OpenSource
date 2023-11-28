<?php 
session_start();
include("../connect.php");
    if (isset($_GET["pid"])){
        $product_id = $_GET['pid'];
        $sql = "DELETE FROM 0203466_product_18 WHERE pid = '$product_id'";
        $result = mysqli_query($conn, $sql);
        header("Location: product_view.php");
    }
?>
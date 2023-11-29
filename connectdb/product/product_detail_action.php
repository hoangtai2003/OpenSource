<?php
session_start();
require_once("../connect.php");
$pid = $_GET['pid'];
$sql = "select pview from 0203466_product_18 where pid = '$pid'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$sql2 = "update 0203466_product_18 set pview = '".($row['pview'] + 1)."'where pid ='$pid'";
$conn->query($sql2);
$conn->close();
header("Location: product_detail.php?pid=".$pid);
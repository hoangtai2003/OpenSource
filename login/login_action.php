<?php
    include("../connectdb/connect.php");
    session_start();
    if (isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "select * from user where username = '$username' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $_SESSION["login"] = true;
            header("Location: ../connectdb/product/shoppingcart.php");
            exit(0);
        } else {
            header("Location: login.php");
        }
    }

?>
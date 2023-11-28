<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "66pm12";
$conn = new mysqli($servername,$username,$password,$dbname);
//hàm kiểm tra xem kết nối có đúng không:
if ($conn->connect_error){
	die("Lỗi kết nối!".$conn->connect_error);
} else {
	//echo "Kết nối thành công!";
}
?>
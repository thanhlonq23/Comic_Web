<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyentranh";

// Tạo kết nối đến CSDL sử dụng PDO
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Đặt chế độ xử lý lỗi cho PDO thành chế độ ngoại lệ
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>
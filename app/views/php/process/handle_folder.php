<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy tên truyện tranh từ form
    $name = $_POST['name'];

    // Đường dẫn thư mục cha
    $parentDirectory = "../../uploads/";

    // Tạo thư mục dựa trên tên truyện tranh
    $comicDirectory = $parentDirectory . $name; // Thư mục lưu trữ hình ảnh của truyện tranh
    $coverDirectory = $comicDirectory . "/cover"; // Thư mục lưu trữ hình ảnh bìa

    if (!file_exists($comicDirectory)) {
        mkdir($comicDirectory, 0777, true); // Tạo thư mục truyện tranh nếu chưa tồn tại
    }
    if (!file_exists($coverDirectory)) {
        mkdir($coverDirectory, 0777, true); // Tạo thư mục bìa nếu chưa tồn tại
    }

    // Chuyển hướng sang form tải ảnh và nhập mô tả
    header("Location: upload_cover.php?name=" . urlencode($name));
    exit();
}
?>

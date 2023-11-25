<?php
// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyentranh";

// Tạo kết nối mới
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối CSDL thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category_name = $_POST['category_name'];

    // Tạo ID ngẫu nhiên có độ dài 10 ký tự
    $random_id = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

    // Kiểm tra nếu tên danh mục không rỗng
    if (!empty($category_name)) {
        // Sử dụng hàm mysqli_real_escape_string để bảo vệ dữ liệu
        $safe_category_name = mysqli_real_escape_string($conn, $category_name);

        // Thực hiện truy vấn để thêm danh mục mới vào CSDL
        $insert_sql = "INSERT INTO categories (id, name) VALUES ('$random_id', '$safe_category_name')";
        if (mysqli_query($conn, $insert_sql)) {
            echo "Danh mục đã được thêm thành công";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Tên danh mục không được để trống";
    }

    // Đóng kết nối CSDL
    mysqli_close($conn);
}
?>

<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="save_categories.php" method="post">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required>
        <input type="submit" value="Add Category">
    </form>

</body>

</html>
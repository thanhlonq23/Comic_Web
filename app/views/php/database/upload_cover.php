<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải Ảnh Cover và Nhập Mô Tả</title>
</head>

<body>
    <form action="handle_upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($_GET['name']); ?>">
        <label for="cover">Tải ảnh cover:</label>
        <input type="file" name="cover" id="cover" accept="image/*">
        <br>
        <label for="status">Trạng thái:</label>
        <select name="status" id="status">
            <option value="0">On-going</option>
            <option value="1">Completed</option>
        </select>
        <br>
        <label for="category_select">Select Categories:</label><br>
        <!-- <select id="category_select" name="categories[]" multiple>  -->
        <!-- Đã thêm thuộc tính multiple -->
        <?php
        // Kết nối CSDL
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "truyentranh"; // Thay 'ten_cua_database' bằng tên thực của database của bạn

        // Tạo kết nối mới
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối CSDL thất bại: " . $conn->connect_error);
        }

        // Truy vấn SQL để lấy danh sách categories
        $sql = "SELECT id, name FROM categories"; // Thay 'categories' bằng tên bảng lưu categories trong CSDL của bạn
        $result = $conn->query($sql);

        // Hiển thị các checkbox cho từng category nếu có dữ liệu trả về từ truy vấn
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category_id = $row['id'];
                $category_name = $row['name'];
                echo "<input type='checkbox' name='categories[]' value='$category_id'> $category_name<br>";
            }
        } else {
            echo "Không có danh mục nào được tìm thấy";
        }

        // Đóng kết nối CSDL
        $conn->close();
        ?>

        </select>
        <br>
        <label for="new_categories">Nhập thể loại mới (phân cách bằng dấu phẩy):</label>
        <input type="text" id="new_categories" name="new_categories">
        <br>
        <label for="describe">Mô tả:</label>
        <textarea name="describe" id="describe" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" value="Lưu">
    </form>
</body>

</html>
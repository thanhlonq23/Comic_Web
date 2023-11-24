<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $describe = $_POST['describe'];
    $status = $_POST['status'];
    $selected_categories = $_POST['categories'];
    // $new_category_name = $_POST['new_category_name'];
    $new_categories = $_POST['new_categories']; // Chuỗi các thể loại mới nhập từ trường văn bản
    // Xử lý chuỗi các thể loại mới thành mảng
    $new_categories_array = explode(',', $new_categories);

    // Kết nối CSDL bằng PDO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "truyentranh";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->beginTransaction();

        // Lưu thông tin category mới nếu có
        if (!empty($new_category_name)) {
            $check_sql = "SELECT * FROM categories WHERE name = :new_category_name";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bindParam(':new_category_name', $new_category_name);
            $check_stmt->execute();

            if ($check_stmt->rowCount() == 0) {
                $id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $insert_sql = "INSERT INTO categories (id, name) VALUES (:id, :new_category_name)";
                $insert_stmt = $conn->prepare($insert_sql);
                $insert_stmt->bindParam(':id', $id);
                $insert_stmt->bindParam(':new_category_name', $new_category_name);
                $insert_stmt->execute();

                $selected_categories[] = $id;
            } else {
                echo "Category already exists";
            }
        }

        // Lưu thông tin về webtoon vào bảng webtoons
        $currentDate = date("Y-m-d");
        $targetDirectory = "../../uploads/" . $name . "/cover/";
        $targetFile = $targetDirectory . basename($_FILES["cover"]["name"]);
        move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile);
        $coverUrl = $targetDirectory . $_FILES["cover"]["name"];

        $random_number = mt_rand(10000, 99999);
        $comic_id = 'comic' . $random_number;

        $insert_webtoon_sql = "INSERT INTO webtoons (id, name, cover, `describe`, status, `date`) VALUES (:comic_id, :name, :coverUrl, :describe, :status, :currentDate)";
        $insert_webtoon_stmt = $conn->prepare($insert_webtoon_sql);
        $insert_webtoon_stmt->bindParam(':comic_id', $comic_id);
        $insert_webtoon_stmt->bindParam(':name', $name);
        $insert_webtoon_stmt->bindParam(':coverUrl', $coverUrl);
        $insert_webtoon_stmt->bindParam(':describe', $describe);
        $insert_webtoon_stmt->bindParam(':status', $status);
        $insert_webtoon_stmt->bindParam(':currentDate', $currentDate);
        $insert_webtoon_stmt->execute();

        foreach ($new_categories_array as $new_category_name) {
            if (!empty($new_category_name)) {
                $check_sql = "SELECT * FROM categories WHERE name = :new_category_name";
                $check_stmt = $conn->prepare($check_sql);
                $check_stmt->bindParam(':new_category_name', $new_category_name);
                $check_stmt->execute();

                if ($check_stmt->rowCount() == 0) {
                    $id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                    $insert_sql = "INSERT INTO categories (id, name) VALUES (:id, :new_category_name)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bindParam(':id', $id);
                    $insert_stmt->bindParam(':new_category_name', $new_category_name);
                    $insert_stmt->execute();

                    $selected_categories[] = $id; // Thêm ID mới vào mảng các thể loại đã chọn
                } else {
                    // Nếu thể loại đã tồn tại, bạn có thể thực hiện một hành động nào đó ở đây
                    // Ví dụ: thông báo cho người dùng, không thêm lại thể loại đã tồn tại, vv.
                }
            }
        }

        // Lưu thông tin quan hệ giữa webtoon và categories vào bảng webtoons_categories
        // Lưu thông tin quan hệ giữa webtoon và categories vào bảng webtoons_categories
        foreach ($selected_categories as $category_id) {
            $webtoon_category_sql = "INSERT INTO webtoons_categories (webtoons_id, categories_id) VALUES (:comic_id, :category_id)";
            $webtoon_category_stmt = $conn->prepare($webtoon_category_sql);
            $webtoon_category_stmt->bindParam(':comic_id', $comic_id);
            $webtoon_category_stmt->bindParam(':category_id', $category_id);
            $webtoon_category_stmt->execute();
        }


        $conn->commit();
        echo "Thông tin đã được thêm vào CSDL.";
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}

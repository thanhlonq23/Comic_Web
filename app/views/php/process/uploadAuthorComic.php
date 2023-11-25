<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['comicName'];
    $authorName = $_POST['authorName'];
    $describe = $_POST['description'];
    $status = $_POST['status'];
    $selected_categories = $_POST['selectedCategories'];
    // $new_categories = $_POST['new_categories'];

    // Xử lý chuỗi các thể loại mới thành mảng
    $new_categories_array = explode(',', $selected_categorie);

    // Xử lý việc di chuyển và lưu trữ ảnh cover vào thư mục
    $parentDirectory = "../../uploads/";

    // Chuyển tên webtoon thành một đường dẫn hợp lệ bằng cách loại bỏ các ký tự không phù hợp
    // $comicDirectoryName = preg_replace('/[^a-zA-Z0-9]/', '_', $name);

    $comicDirectory = $parentDirectory . $name;
    $coverDirectory = $comicDirectory . "/cover/";

    if (!file_exists($comicDirectory)) {
        mkdir($comicDirectory, 0777, true); // Tạo thư mục truyện tranh nếu chưa tồn tại
    }

    if (!file_exists($coverDirectory)) {
        mkdir($coverDirectory, 0777, true); // Tạo thư mục bìa nếu chưa tồn tại
    }

    // Kết nối CSDL bằng PDO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "truyentranh";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->beginTransaction();


        // Tạo ID cho tác giả mới
        $random_number_author = mt_rand(10000, 99999);
        $author_id = 'Author' . $random_number_author;
        // Thêm tác giả mới vào bảng Authors
        $insert_author_sql = "INSERT INTO Authors (id, name) VALUES (:author_id, :authorName)";
        $insert_author_stmt = $conn->prepare($insert_author_sql);
        $insert_author_stmt->bindParam(':author_id', $author_id);
        $insert_author_stmt->bindParam(':authorName', $authorName);
        $insert_author_stmt->execute();

        // Lưu thông tin category mới nếu có
        // Xử lý thông tin category mới nếu có
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

                    // $selected_categories[] = $id; // Thêm ID mới vào mảng các thể loại đã chọn
                } else {
                    // Thể loại đã tồn tại trong CSDL, không cần thêm mới
                    // Bạn có thể thực hiện hành động khác tại đây (ví dụ: thông báo cho người dùng)
                }
            }
        }

        // Lưu thông tin về webtoon vào bảng webtoons
        $currentDate = date("Y-m-d");
        $targetDirectory = "../../uploads/" . $name . "/cover/";
        // Xử lý tệp ảnh cover và di chuyển vào thư mục cover của webtoon
        $coverFileName = $_FILES['coverImage']['name']; // Tên tệp ảnh cover
        $coverTempFile = $_FILES['coverImage']['tmp_name']; // Tên tệp tạm thời trên máy chủ
        $targetCoverDirectory = $coverDirectory . $coverFileName;

        move_uploaded_file($coverTempFile, $targetCoverDirectory);

        // Tạo đường dẫn cho cover
        $coverUrl = $coverDirectory . $coverFileName;

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

        //Xử lý thông tin quan hệ giữa webtoon và categories
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

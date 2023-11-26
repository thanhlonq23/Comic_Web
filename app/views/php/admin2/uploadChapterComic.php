<?php
// Kết nối đến cơ sở dữ liệu sử dụng PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyentranh";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy giá trị gửi từ form
    $comicId = $_POST['comicId'];
    $chapterNumber = $_POST['chapterNumber'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Lấy tên của webtoon từ cơ sở dữ liệu dựa trên comicId
    $webtoonNameQuery = "SELECT name FROM webtoons WHERE id = :comicId";
    $stmt = $conn->prepare($webtoonNameQuery);
    $stmt->bindParam(':comicId', $comicId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $webtoonName = $row['name'];

    // Tạo thư mục cho chapter và cover
    $parentDirectory = "../../uploads/". $webtoonName;
    $comicDirectory = $parentDirectory . $webtoonName . "/";

    if (!file_exists($comicDirectory)) {
        mkdir($comicDirectory, 0777, true);
    }

    $chapterDirectoryName = "Chapter " . $chapterNumber;
    $coverDirectory = $comicDirectory . $chapterDirectoryName . "/";

    if (!file_exists($coverDirectory)) {
        mkdir($coverDirectory, 0777, true);
    }

    // Di chuyển và lưu trữ các ảnh vào thư mục coverDirectory
    foreach ($_FILES as $key => $value) {
        $tempFile = $_FILES[$key]['tmp_name'];
        $targetPath = $coverDirectory . $_FILES[$key]['name'];
        move_uploaded_file($tempFile, $targetPath);
    }

    // Tiến hành lưu thông tin vào database
    $sql = "INSERT INTO Chapters (id, webtoon_id, name, price, status, date, media)
    VALUES (:chapterDirectoryName, :comicId, :name, :price, :status, NOW(), :coverDirectory)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':chapterDirectoryName', $chapterDirectoryName);
    $stmt->bindParam(':comicId', $comicId);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':coverDirectory', $coverDirectory);

    $stmt->execute();

    echo "Thêm mới chapter thành công";
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

$conn = null;
?>

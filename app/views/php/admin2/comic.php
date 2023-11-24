<?php
// Kết nối tới cơ sở dữ liệu (ví dụ: sử dụng PDO)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyentranh";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ báo lỗi PDO để thông báo lỗi SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy ID từ URL
    $comicId = $_GET['id'];

    // Thực hiện truy vấn để lấy thông tin comic từ cơ sở dữ liệu dựa trên ID
    $query = "SELECT * FROM webtoons WHERE id = :comicId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':comicId', $comicId);
    $stmt->execute();

    // Lưu kết quả vào biến $comic
    $comic = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($comic) {
        // ... Hiển thị thông tin comic trên trang ...

        // Lấy danh sách các chapters từ cơ sở dữ liệu dựa trên ID của comic
        $queryChapters = "SELECT * FROM chapters WHERE webtoon_id = :comicId";
        $stmtChapters = $conn->prepare($queryChapters);
        $stmtChapters->bindParam(':comicId', $comicId);
        $stmtChapters->execute();
        $chapters = $stmtChapters->fetchAll(PDO::FETCH_ASSOC);

        // Hiển thị danh sách các thể loại
        $queryCategories = "SELECT categories.id, categories.name
        FROM categories
        INNER JOIN webtoons_categories ON categories.id = webtoons_categories.categories_id
        WHERE webtoons_categories.webtoons_id = :comicId";
        $stmtCategories = $conn->prepare($queryCategories);
        $stmtCategories->bindParam(':comicId', $comicId);
        $stmtCategories->execute();
        $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

        // Truy vấn để lấy số lượng chapters của webtoon từ bảng chapters
        $queryCountChapters = "SELECT COUNT(*) AS total_chapters FROM chapters WHERE webtoon_id = :comicId";
        $stmtCountChapters = $conn->prepare($queryCountChapters);
        $stmtCountChapters->bindParam(':comicId', $comicId);
        $stmtCountChapters->execute();
        $countChapters = $stmtCountChapters->fetch(PDO::FETCH_ASSOC);

        // Số lượng chapters của webtoon
        $totalChapters = $countChapters['total_chapters'];
    } else {
        echo "Không tìm thấy thông tin về comic!";
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
    <title>F4 COMICS</title>
</head>

<body>
    <?php
    require_once 'nav.php';
    ?>
    <!-- End of Navbar -->

    <!-- Nội dung chính -->
    <main class="main">
        <div class="bottom-data">
            <div class="comics">
                <div class="top-cover">
                    <div class="image-container">
                        <img src="<?php echo $comic['cover']; ?>" alt="Comic Cover">
                    </div>
                    <div class="text-container">
                        <div>
                            <h1><?php echo $comic['name']; ?></h1>
                        </div>
                        <div class="describe">
                            <p><?php echo $comic['describe']; ?></p>
                        </div>
                        <div>
                            <p><span>Tác giả:</span>Châu</p>
                        </div>
                        <div>
                            <?php if ($comic['status'] == 0) : ?>
                                <p><span>Status:</span> On-going</p>
                            <?php elseif ($comic['status'] == 1) : ?>
                                <p><span>Status:</span> Completed</p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p><span>View:</span>20030907</p>
                        </div>
                        <?php
                        // Hiển thị danh sách categories
                        if (!empty($categories)) {
                            // echo "<div><p><span>Categories:</span></p><ul>";
                            echo "<div><ul>";
                            foreach ($categories as $category) {
                                echo "<li>{$category['name']}</li>";
                            }
                            echo "</ul></div>";
                        } else {
                            echo "<p>No categories found for this comic.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-data">
            <!-- Hiển thị danh sách các chapter -->
            <div class="comics">
                <div class="header">
                    <i class='bx bxs-book-open'></i>
                    <h3><span><?php echo $totalChapters; ?></span> Chapters</h3>
                    <input type="button" value="Create Chapter">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="padding-left: 7px; font-size: 17px;">Chapter</th>
                            <th style="padding-left: 7px;font-size: 17px;">Status</th>
                            <th style="padding-left: 7px;font-size: 17px;">Publish Date</th>
                            <th style="padding-left: 7px;font-size: 17px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Lặp qua danh sách các chapter
                        // Ví dụ:
                        foreach ($chapters as $chapter) {
                            echo "<tr>";
                            echo "<td><p>{$chapter['chapter_name']}</p></td>";
                            echo "<td><span class='status {$chapter['status']}'>{$chapter['status']}</span></td>";
                            echo "<td>{$chapter['publish_date']}</td>";
                            echo "<td>";
                            echo "<input type='button' value='Edit'>";
                            echo "<input type='button' value='Delete'>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <!-- End of Main content-->

    </div>

    <script src="../../js/admin/admin.js"></script>

</body>

</html>
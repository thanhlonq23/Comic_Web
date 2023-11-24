<?php
// Kết nối đến cơ sở dữ liệu, sử dụng thông tin kết nối của bạn
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyentranh";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu kèm số lượng chapters và lưu vào biến "total_chapters" từ bảng webtoons
$sql = "SELECT webtoons.*, COUNT(chapters.id) AS total_chapters
        FROM webtoons
        LEFT JOIN chapters ON webtoons.id = chapters.webtoon_id
        GROUP BY webtoons.id";
$result = $conn->query($sql);

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
        <div style="background-color: #f6f6f9; padding: 15px; width: 100% ;border-radius: 20px; position: sticky; top: 50px;">
            <div class="upload-comic">
                <input style="display: block; background-color: #00c493; color: #ffffff; font-size: 16px; cursor: pointer; padding: 12px 24px;
        border-radius: 8px;border: none; outline: none;" type="button" value="Create Project">
            </div>
        </div>

        <!-- Phần dữ liệu phía dưới -->
        <div class="bottom-data">

            <!-- Bảng Comics gần đây -->
            <div class="comics">

                <!-- Bảng hiển thị các comics gần đây (name, date, trạng thái) -->
                <div class="header">
                    <i class='bx bxs-book-open'></i>
                    <h3>List Comics</h3>
                    <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                    <form action="#">

                        <div class="form-input">
                            <input type="search" placeholder="Search...">
                            <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="padding-left: 7px; font-size: 17px;">Comics</th>
                            <!-- <th>Uploading Date</th> -->
                            <th style="padding-left: 7px;font-size: 17px;">Status</th>
                            <th style="font-size: 17px;">Publish Date</th>
                            <th style="padding-left: 7px;font-size: 17px;">Chapter</th>
                            <th style="padding-left: 7px;font-size: 17px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ... (Mã kết nối đến cơ sở dữ liệu, truy vấn đã có từ trước)
                        $basePath = "C:/Users/Nguyen thi ha chau/OneDrive - QUANG TRUNG COLLEGE/f4comics/"; // Đường dẫn gốc tới thư mục chứa ảnh

                        // Kiểm tra và hiển thị dữ liệu từ cơ sở dữ liệu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='comic-row' data-id='" . $row['id'] . "' style='cursor: pointer;'>";
                                echo "<td>";
                                echo "<img src='" . $row['cover'] . "' alt='" . $row['name'] . "'>";
                                echo "<p>" . $row['name'] . "</p>";
                                echo "</td>";
                                // Kiểm tra giá trị của cột status để hiển thị trạng thái tương ứng
                                echo "<td>";
                                if ($row['status'] == 0) {
                                    echo "<span class='status process'>Processing</span>";
                                } elseif ($row['status'] == 1) {
                                    echo "<span class='status completed'>Completed</span>";
                                } else {
                                    echo "<span class='status'>Unknown</span>"; // Trạng thái không xác định
                                }
                                echo "</td>";
                                echo "</span></td>";
                                echo "<td class='date'>" . $row['date'] . "</td>";
                                echo "<td>" . $row['total_chapters'] . " Chapters</td>";
                                echo "<td>";
                                echo "<input type='button' value='Edit'>";
                                echo "<input type='button' value='Delete'>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
                        }
                        $conn->close();
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </main>
    <!-- End of Main content-->

    <script src="../../js/admin/admin.js"></script>


</body>

</html>
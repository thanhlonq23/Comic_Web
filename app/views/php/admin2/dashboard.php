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

// Truy vấn dữ liệu, số lượng chapters qua khóa ngoại "webtoon_chapter_id" và lưu vào biến "total_chapters", định dạng lại Date lưu vào biến "formatted_date" từ bảng webtoons
$sql = "SELECT webtoons.*, COUNT(chapters.id) AS total_chapters,
        DATE_FORMAT(webtoons.date, '%d/%m/%Y') AS formatted_date
        FROM webtoons
        LEFT JOIN chapters ON webtoons.id = chapters.webtoon_id
        GROUP BY webtoons.id
        ORDER BY webtoons.date DESC
        LIMIT 5 "; // Giới hạn kết quả trả về chỉ 5 bản ghi, sắp xếp theo ngày giảm dần
//ORDER BY webtoons.date DESC để sắp xếp kết quả theo ngày giảm dần
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
        <ul class="insights">
            <li>
                <i class='bx bxs-book-open'></i>
                <span class="info">
                    <h3>
                        1,074
                    </h3>
                    <p>Total Comics</p>
                </span>
            </li>
            <li><i class='bx bx-show-alt'></i>
                <span class="info">
                    <h3>
                        3,944
                    </h3>
                    <p>Site Visit</p>
                </span>
            </li>
            <li>
                <i class='bx bx-user-circle'></i>
                <span class="info">
                    <h3>
                        14,721
                    </h3>
                    <p>Users</p>
                </span>
            </li>
            <li><i class='bx bx-dollar-circle'></i>
                <span class="info">
                    <h3>
                        $6,742
                    </h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </ul>
        <!-- End of Insights -->

        <!-- Phần dữ liệu phía dưới -->
        <div class="bottom-data">
            <!-- Bảng Comics gần đây -->
            <div class="comics">
                <!-- Bảng hiển thị các comics gần đây (name, date, trạng thái) -->
                <div class="header">
                    <i class='bx bxs-book-open'></i>
                    <h3>Recent Comics</h3>
                    <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="padding-left: 7px; font-size: 17px;">Comics</th>
                            <!-- <th>Uploading Date</th> -->
                            <th style="padding-left: 7px;font-size: 17px;">Status</th>
                            <th style="padding-left: 7px;font-size: 17px;">Publish Date</th>
                            <th style="padding-left: 7px;font-size: 17px;">Chapter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Thay thế dữ liệu cứng bằng dữ liệu từ truy vấn SQL trong comicslist.php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='comicdb-row' data-id='" . $row['id'] . "' style='cursor: pointer;'>";
                                echo "<td>";
                                echo "<img src='" . $row['cover'] . "' alt='" . $row['name'] . "'>";
                                echo "<p>" . $row['name'] . "</p>";
                                echo "</td>";
                                // Hiển thị trạng thái từ dữ liệu
                                echo "<td>";
                                if ($row['status'] == 0) {
                                    echo "<span class='status process'>Processing</span>";
                                } elseif ($row['status'] == 1) {
                                    echo "<span class='status completed'>Completed</span>";
                                } else {
                                    echo "<span class='status'>Unknown</span>"; // Trạng thái không xác định
                                }
                                echo "</td>";
                                echo "<td class='date'>" . $row['formatted_date'] . "</td>";
                                echo "<td>" . $row['total_chapters'] . " Chapters</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>

    </main>
    <!-- End of Main content-->

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các hàng có class ".comicdb-row"
            const comicRows = document.querySelectorAll('.comicdb-row');

            // Lặp qua từng hàng và thêm sự kiện click
            comicRows.forEach(row => {
                row.addEventListener('click', () => {
                    const comicId = row.dataset.id;

                    // Tạo URL mới với ID và chuyển hướng đến comic.php
                    const url = `comic.php?id=${encodeURIComponent(comicId)}`;
                    window.location.href = url;
                });
            });
        });
    </script>
    <script src="../../js/admin/admin.js"></script>


</body>

</html>
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
        <!--
              Header với tiêu đề và đường dẫn dẫn đến những phần khác
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Analytics
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a>
            </div>
            -->

        <!-- Insights -->
        <!-- Phần Insights hiển thị các chỉ số chính -->

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
                        <tr class="comic-row" style="cursor: pointer;">
                            <td>
                                <img src="../../css/admin/images/1.jpg" alt="Comic 1">
                                <p>Hệ Thống Tự Cứu Của Nhân Vật Phản Diện</p>

                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status completed">Completed</span></td>
                            <td>07/09/2003</td>
                            <td>30 chapters</td>
                        </tr>
                        <tr class="comic-row" style="cursor: pointer;">

                            <td>
                                <img src="../../css/admin/images/3.jpg" alt="Comic 2">
                                <p>Ma Đạo Tổ Sư</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status completed">Completed</span></td>
                            <td>07/09/2003</td>
                            <td>30 chapters</td>
                        </tr>
                        <tr class="comic-row" style="cursor: pointer;">

                            <td>
                                <img src="../../css/admin/images/4.jpg" alt="Comic 3">
                                <p>Thiên Quan Tứ Phúc</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status process">Processing</span></td>
                            <td>07/09/2003</td>
                            <td>30 chapters</td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <!-- Events -->
            <!-- Phần Sự kiện -->
            <!-- <div class="events">
        <div class="header">
            <i class='bx bx-note'></i>
            <h3>Remiders</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-plus'></i>
        </div>
        <ul class="task-event">
            <li class="completed">
                <div class="task-title">
                    <i class='bx bx-check-circle'></i>
                    <p>SAuthors</p>
                </div>
                <i class='bx bx-dots-vertical-rounded'></i>
            </li>
            <li class="completed">
                <div class="task-title">
                    <i class='bx bx-check-circle'></i>
                    <p>COins</p>
                </div>
                <i class='bx bx-dots-vertical-rounded'></i>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class='bx bx-x-circle'></i>
                    <p>New</p>
                </div>
                <i class='bx bx-dots-vertical-rounded'></i>
            </li>
        </ul>
    </div> -->

            <!-- End of Reminders-->

        </div>


    </main>
    <!-- End of Main content-->

    </div>

    <script src="../../js/admin/admin.js"></script>


</body>

</html>
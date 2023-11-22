<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
    <title>F4 COMICS</title>
    <style>
        td.date {
            /* display: flex; */
            max-width: 80%;
            /* Điều chỉnh giá trị max-width cho phù hợp với nội dung của bạn */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 5px;
        }
    </style>
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
                        <tr class="comic-row" style="cursor: pointer;">

                            <td>
                                <img src="../../css/admin/images/1.jpg" alt="Comic 1">
                                <p>Hệ Thống Tự Cứu Của Nhân Vật Phản Diện</p>

                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status completed">Completed</span></td>
                            <td class="date">07/09/2003</td>
                            <td>30 chapters</td>
                            <td>
                                <input type="button" value="Edit">
                                <input type="button" value="Delete">
                            </td>

                        </tr>
                        <tr class="comic-row" style="cursor: pointer;">

                            <td>
                                <img src="../../css/admin/images/3.jpg" alt="Comic 2">
                                <p>Ma Đạo Tổ Sư</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status completed">Completed</span></td>
                            <td class="date">07/09/2003</td>
                            <td>30 chapters</td>
                            <td>
                                <input type="button" value="Edit">
                                <input type="button" value="Delete">
                            </td>

                        </tr>
                        <tr class="comic-row" style="cursor: pointer;">

                            <td>
                                <img src="../../css/admin/images/4.jpg" alt="Comic 3">
                                <p>Thiên Quan Tứ Phúc</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status process">Processing</span></td>
                            <td class="date">07/09/2003</td>
                            <td>30 chapters</td>
                            <td>
                                <input type="button" value="Edit">
                                <input type="button" value="Delete">
                            </td>

                        </tr>
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
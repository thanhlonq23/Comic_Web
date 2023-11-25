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
        <!-- <div class="bottom-data">
            <div class="comics">
                <div class="top-cover">
                    <div class="cover-wrapper" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, auto)); gap: 16px;">
                        <div class="image-container" style="width: 240px; height: 360px; overflow: hidden; padding: 0 5px; justify-self: center;">
                            <img style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" src="../../css/admin/images/3.jpg" alt="Comic 1">
                        </div>
                        <div class="text-container" style="justify-self: start; grid-column: span 2 / -1;">
                            <div style="block-size: auto; margin-bottom: 20px; font-size: 30px; font-weight: 800; display: flex;">
                                Ma đạo tổ sư
                                <H1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum dolorem ex animi, natus doloribus corrupti ratione eos provident necessitatibus laboriosam? Pariatur corporis ratione eum, numquam dolorum dicta perspiciatis in ad.</H1>
                            </div>
                            <div style="block-size: auto; margin-bottom: 20px; display: flex;">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Non pariatur voluptates fugiat corrupti autem explicabo sed consequuntur doloribus quas eaque ratione, minus quo libero voluptatibus sapiente! Ullam ut quas ducimus?
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates tempore sunt sed quaerat non sapiente dolores maxime aut. Nihil hic dolores excepturi. Quae, mollitia laboriosam magni veritatis eum voluptate facere.
                            </div>
                            <div style="block-size: auto; margin-bottom: 10px; display: flex;">
                                Thể loại
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="bottom-data">
            <div class="comics">
                <div class="top-cover">
                    <div class="image-container">
                        <div class="imageIncontainer" style="background-image: url('../../css/admin/images/3.jpg');" alt="Comic Cover"></div>
                    </div>
                    <div class="text-container">
                        <div>
                            <h1>Ma đạo tổ sư</h1>
                        </div>
                        <div class="describe">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, rerum. Amet beatae itaque, voluptatem perspiciatis sunt quo optio incidunt? Repudiandae praesentium porro aut modi voluptas reprehenderit explicabo eos sequi delectus?
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet quos neque, officiis recusandae dolorem perferendis voluptas, sed ipsa laudantium optio adipisci facere, a dignissimos ad et eius inventore saepe asperiores?
                            </p>
                        </div>
                        <div>
                            <p><span>Tác giả:</span>Châu</p>
                        </div>
                        <div>
                            <p><span>Status:</span>On-going</p>
                        </div>
                        <div>
                            <p><span>View:</span>20030907</p>
                        </div>
                        <div>
                            <ul>
                                <li>Action</li>
                                <li>Boy Love</li>
                                <li>Romance</li>
                                <li>Fantastic</li>
                                <li>Chinese</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="bottom-data">

            <!-- Bảng Comics gần đây -->
            <div class="comics">

                <!-- Bảng hiển thị các comics gần đây (name, date, trạng thái) -->
                <div class="header">
                    <i class='bx bxs-book-open'></i>
                    <h3>3 Chapters</h3>
                    <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                        <input type="button" value="Create Chapter">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="padding-left: 7px; font-size: 17px;">Chapter</th>
                            <!-- <th>Uploading Date</th> -->
                            <th style="padding-left: 7px;font-size: 17px;">Status</th>
                            <th style="padding-left: 7px;font-size: 17px;">Publish Date</th>
                            <th style="padding-left: 7px;font-size: 17px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="chapter-row" style="cursor: pointer;">

                            <td>
                                <p>Chapter 1</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status completed">Completed</span></td>
                            <td>20/10/2021</td>
                            <td>
                                <input type="button" value="Edit">
                                <input type="button" value="Delete">
                            </td>

                        </tr>
                        <tr class="chapter-row" style="cursor: pointer;">

                            <td>
                                <p>Chapter 2</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status completed">Completed</span></td>
                            <td>20/10/2021</td>
                            <td class="button">
                                <input type="button" value="Edit">
                                <input type="button" value="Delete">
                            </td>

                        </tr>
                        <tr class="chapter-row" style="cursor: pointer;">

                            <td>
                                <p>Chapter 3</p>
                            </td>
                            <!-- <td>14-08-2023</td> -->
                            <td><span class="status process">Processing</span></td>
                            <td>20/10/2021</td>
                            <td>
                                <input type="button" value="Edit">
                                <input type="button" value="Delete">
                            </td>

                        </tr>

                    </tbody>

                </table>
            </div>
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

    </main>
    <!-- End of Main content-->

    </div>

    <script src="../../js/admin/admin.js"></script>

</body>

</html>
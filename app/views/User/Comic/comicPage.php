<body class="d-flex flex-column min-vh-100 bg-dark-subtle">
    <div class="container bg-white">
        <div>
            <p class="fs-5 fw-bold text-center"><?php echo $webtoons[0]['name'] ?></p>
            <div class="row">
                <div class="col-4 cover-item">

                    <img src="./public/Uploads/Cover/Webtoon/<?php echo $webtoons[0]['cover'] ?> " alt="" class="cover">

                </div>

                <div class="col-8">
                    <ul>
                        <li class="row">
                            <p class="col-xs-4">
                                <i class="fa-solid fa-user"></i>
                                Tác Giả: Đang cập nhật
                            </p>
                        </li>
                        <li class="row">
                            <p class="col-xs-4">
                                <i class="fa-solid fa-rss"></i>
                                Tình Trạng:
                                <?php
                                if ($webtoons[0]['status'] == 0) {
                                    echo 'Chưa hoàn thành';
                                } else {
                                    echo 'Đã hoàn thành';
                                }
                                ?>
                            </p>
                        </li>
                        <li class="row">
                            <p class="col-xs-4">
                                <i class="fa-solid fa-tags"></i>
                                Thể Loại:
                                <?php
                                // Hiển thị danh sách categories nếu có, nếu không hiển thị thông báo "Không có thể loại"
                                if (empty($categories)) {
                                    echo "Không có thể loại";
                                } else {
                                    // Sắp xếp mảng categories theo trường 'name'
                                    usort($categories, function ($a, $b) {
                                        return strcmp($a['name'], $b['name']);
                                    });

                                    foreach ($categories as $category) {
                                        echo "{$category['name']} ";
                                    }
                                }
                                ?>
                            </p>
                        </li>
                        <?php
                        $totalViews = 0; // Khởi tạo biến tổng lượt xem

                        // Lặp qua mảng $chapters để tính tổng lượt xem của từng chapter
                        foreach ($chapters as $chapter) {
                            $totalViews += $chapter['views']; // Cộng lượt xem của từng chapter vào tổng lượt xem
                        }
                        ?>

                        <li class="row">
                            <p class="col-xs-4">
                                <i class="fa-solid fa-eye"></i>
                                Lượt Xem: <?php echo $totalViews; ?>
                            </p>
                        </li>
                        <!-- <li class="row">
                            <p class="col-xs-4">
                                <i class="fa-solid fa-eye"></i>
                                Lượt Xem: <?php print_r($chapters) ?>
                            </p>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-3 details">
            <h3>
                <i class="fa-brands fa-readme">
                    DETAILS:
                </i>
            </h3>
            <p>
                <?php echo $webtoons[0]['description'] ?>
            </p>
            <!-- <a href="#" class="link-info">
                Xem thêm
            </a> -->
        </div>
        <div class="list-chapter mt-3">
            <h2 class="list-title clearfix">
                <i class="fa fa-list">
                    CHAPTER LIST
                </i>
            </h2>

            <div class="row">
                <div class="col-7 text-nowrap">Số chương</div>
                <div class="col-2 text-nowrap text-center">Cập nhật</div>
                <div class="col-3 text-nowrap text-center">Lượt xem</div>
            </div>
            <nav>
                <ul>
                    <?php
                    foreach ($chapters as $key => $value) {
                    ?>
                        <a href="<?php echo BASE_URL ?>?url=comicPage/readPage/<?php echo $value['webtoon_id'] ?>&chapter=<?php echo $value['id'] ?>" style="font-size: large;">
                            <li class="row">
                                <div class="col-7">
                                    <?php echo $value['name'] ?>
                                </div>
                                <div class="col-2 text-nowrap text-center small">
                                    <?php echo $value['date'] ?>
                                </div>
                                <div class="col-3 text-nowrap text-center small">
                                    <?php echo $value['views'] ?>
                                </div>
                            </li>
                        </a>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</body>
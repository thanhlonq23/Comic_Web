<!-- Nội dung chính -->
<!-- Này là phần đầu của hiển thị từng comic  -->
<main class="main">
    <div class="bottom-data">
        <div class="comics">
            <div class="top-cover">
                <?php
                foreach ($webtoons as $key => $value) {
                ?>
                    <div class="image-container">
                        <div class="imageIncontainer" style="background-image: url('./public/Uploads/Cover/Webtoon/<?php echo $value['cover']; ?>');" alt="Comic Cover"></div>
                    </div>
                    <div class="text-container">
                        <div>
                            <h1><?php echo $value['name'] ?></h1>
                        </div>
                        <div class="describe">
                            <p>
                                <?php echo $value['description'] ?>
                            </p>
                        </div>
                        <div>
                            <p><span>Tác giả:</span>Chưa cập nhật</p>
                        </div>
                        <div>
                            <p>
                                <span>Status:</span>
                                <?php

                                if ($value['status'] == 0) {
                                    echo "Chưa hoàn thành";
                                } else {
                                    echo "Đã hoàn thành";
                                }
                                ?>
                            </p>
                        </div>
                        <div>
                            <p><span>View:</span>20030907</p>
                        </div>
                        <div>
                            <ul>
                                <?php
                                // Hiển thị danh sách categories nếu có, nếu không hiển thị thông báo "Không có thể loại"
                                if (empty($categories)) {
                                    echo "Không có thể loại";
                                } else {
                                    foreach ($categories as $category) {
                                        echo "<li>{$category['name']}</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>
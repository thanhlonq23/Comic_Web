<!-- Nội dung chính -->
<main class="main">
    <div class="bottom-data">
        <div class="comics">
            <div class="top-cover">
                <?php
                foreach ($webtoons as $key => $value) {
                ?>
                    <div class="image-container">
                        <img src="./public/Uploads/Cover/Webtoon/<?php echo $value['cover'] ?>" alt="Comic 1">
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
                                <li>Action</li>
                                <li>Boy Love</li>
                                <li>Romance</li>
                                <li>Fantastic</li>
                                <li>Chinese</li>
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
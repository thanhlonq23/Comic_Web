<body class="d-flex flex-column min-vh-100">
    <!-- CATALOGY -->
    <div class="container catalogy">
        <div class="bd-highlight mb-3 recommendation">
            <div class="title">
                <div class="fs-1">Tìm kiếm từ khóa : <?php echo $tuKhoa ?></div>
            </div>
            <ul class="d-flex nav p-2 gap-3 justify-content-around comics-list">
                <?php
                foreach ($search as $key => $value) {
                ?>
                    <div class="comic-item">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL . '/?url=comicPage/homePage/&id=' . $value['id'] ?>" target="_blank">
                                <img src="./public/Uploads/Cover/Webtoon/<?php echo $value['cover'] ?>" class="cover">
                                <div class="comic-title">
                                    <div class="fs-5"><?php echo $value['name'] ?></div>
                                </div>
                            </a>
                        </li>
                    </div>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</body>
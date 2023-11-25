    <div class="bd-highlight mb-3 discover">
        <div class="title">
            <div class="fs-1">Truyện mới cập nhật</div>
        </div>
        <ul class="d-flex nav p-2 gap-3 justify-content-around comics-list">
            <?php
            foreach ($webtoons as $key => $value) {
            ?>
                <div class="comic-item">
                    <li class="nav-item">
                        <a href="#" target="_blank">
                            <img src="./public/Uploads/Cover/Webtoon/<?php echo $value['cover'] ?>" alt="Học Bá Vô Danh" class="cover">
                            <div class="comic-title">
                                <div class="fs-5">Học Bá Vô Danh</div>
                            </div>
                        </a>
                    </li>
                </div>
            <?php
            }
            ?>
        </ul>
    </div>
    </body>
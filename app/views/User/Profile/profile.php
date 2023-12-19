<?php
$mediaValue = ($userInfo[0]["media"] === 'defaut') ? 'user' : $userInfo[0]["media"];
$mediaPath = "./public/Uploads/User/{$mediaValue}.jpg";
?>
<style>
    .Header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .scroll-buttons {
        display: flex;
        gap: 10px;
    }

    button#scroll-left,
    button#scroll-right {
        background-color: #f2f2f2;
        border: none;
        padding: 0 20px;
        border-radius: 10px;
        font-size: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button#scroll-left:hover,
    button#scroll-right:hover {
        background-color: #ddd;
    }

    .divReading {
        width: 80%;
        margin: 0 auto;
        margin-top: 50px;
    }

    .readinglist {
        padding: 10px;
        box-sizing: content-box;
        display: flex;
        /* margin-left: 130px; */
        flex-direction: row;
        justify-content: flex-start;
        align-items: stretch;
        /* overflow-x: scroll; */
        overflow-x: hidden;
        -ms-scroll-snap-type: x mandatory;
        scroll-snap-type: x mandatory;
        scroll-behavior: auto;
        width: 100%;
        max-width: 98%;
        /* min-width: 100% */
    }

    .webtoon-item {
        border-radius: 20px;
        flex-shrink: 0;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 9px;
        scroll-snap-align: start;
        width: 385px;
        margin-right: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .webtoon-item>a {
        min-height: 100%;
        border-radius: 20px;
        background-color: #fff;
        overflow: hidden;
        display: flex;
        flex-direction: row;
        padding: 12px;
        box-sizing: border-box;
        align-items: center;
        justify-content: flex-start;
        gap: 12px;
        width: 385px;
        text-decoration: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .webtoon-item .image-container {
        position: relative;
        overflow: hidden;
        width: 110px;
        border-radius: 20px;
        /* height: 165px; */
        color: rgb(255, 255, 255);
        background-color: rgb(83, 72, 70);
        display: flex;
        justify-content: center;
        /* Canh giữa theo chiều ngang */
        align-items: center;
        /* Canh giữa theo chiều dọc */
    }

    .webtoon-item .image-container img {
        width: 100%;
        /* Đảm bảo hình ảnh phù hợp với kích thước của container */
        height: auto;
        display: block;
        /* Loại bỏ khoảng trắng dư thừa */
    }

    .webtoon-item .info-container {
        flex: 1 1;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 4px;
        z-index: 1;
    }

    .webtoon-item .webtoon-name,
    .webtoon-item .chapter-name {
        display: -webkit-box;
        max-width: 100%;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        position: relative;
        color: black;
    }

    .webtoon-item .date-info {
        display: flex;
        flex-direction: row;
        align-items: baseline;
        padding: 0;
        gap: 4px;
        flex: none;
        flex-grow: 0;
        color: black;
    }

    .container-that-holds-webtoons {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
    }

    .info-container .webtoon-name {
        font-size: 20px;
    }

    .info-container .chapter-name,
    .info-container .date-info {
        color: #000000a3;
    }

    .no-reading-list {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }
</style>

<body class="d-flex flex-column min-vh-100 bg-dark-subtle">
    <div>
        <div class="profile-container container">
            <div class="row">
                <div class="col-4">
                    <div class="user-avatar">
                        <img src="<?php echo $mediaPath ?>" alt="Profile Picture" class="card-img-top user-image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $userInfo[0]["name"] ?></h5>
                    </div>
                </div>
                <div class="col-8 m-auto">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">ID: <?php echo $userInfo[0]["id"] ?></li>
                        <li class="list-group-item">Email: <?php echo $userInfo[0]["email"] ?></li>
                        <li class="list-group-item">Số điện thoại: <?php echo $userInfo[0]["phoneNumber"] ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- <div class="container bg-white">
            <div class="m-3">
                <ul class="d-flex nav p-2 gap-3 justify-content-around">
                    <li class="nav-item">
                        <a class="btn btn-outline-dark m-1" href="#" title="Đã thích" role="button" target="_blank"><i class="fa-regular fa-heart"></i> Đang theo dõi</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark m-1" href="#" title="Đã mở khóa" role="button" target="_blank"><i class="fa-solid fa-lock"></i> Đã mở khóa</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark m-1" href="#" title="Lịch sử" role="button" target="_blank"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử dọc</a>
                    </li>
                </ul>
            </div>
        </div> -->

        <div class="divReading">
            <div class="Header">
                <h3>Reading List</h3>
                <div class="scroll-buttons">
                    <button id="scroll-left">&lt;</button>
                    <button id="scroll-right">&gt;</button>
                </div>
            </div>

            <?php if (empty($webtoon_info)) : ?>
                <div class="no-reading-list">
                    <p>Bạn chưa thêm truyện vào danh sách đọc.</p>
                </div>
            <?php else : ?>
                <div class="readinglist">
                    <?php foreach ($webtoon_info as $key => $webtoon) : ?>
                        <?php
                        $webtoon_name = $webtoon[0]['name'];
                        $chapter_name = $chapter_info[$key][0]['name'];
                        $cover_image = $webtoon[0]['cover'];
                        ?>

                        <div class="webtoon-item">
                            <a href="<?php echo BASE_URL ?>?url=comicPage/readPage/<?php echo $chapter_info[$key][0]['webtoon_id'] ?>&chapter=<?php echo $chapter_info[$key][0]['id']; ?>" class="webtoon-link">
                                <div class="image-container">
                                    <img src='./public/Uploads/Cover/Webtoon/<?php echo $cover_image; ?>' alt='Cover Image'>
                                </div>
                                <div class="info-container">
                                    <div class="webtoon-name"><?php echo $webtoon_name; ?></div>
                                    <div class="chapter-name"><?php echo $chapter_name; ?></div>
                                    <!-- <div class="date-info">Date Info Here</div> -->
                                    <div class="date-info"><?php echo $chapter_info[$key][0]['date']; ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <?php
    // ...
    // echo '<br>';
    // echo '<br>';
    // print_r($reading_list);
    // echo '<br>';
    // echo '<br>';
    // print_r($webtoon_info);
    // echo '<br>';
    // echo '<br>';
    // print_r($chapter_info);
    ?>

    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scrollRightButton = document.getElementById("scroll-right");
        const scrollLeftButton = document.getElementById("scroll-left");
        const container = document.querySelector('.readinglist');

        scrollRightButton.addEventListener("click", function() {
            container.scrollBy({
                left: 200,
                behavior: "smooth"
            });
        });

        scrollLeftButton.addEventListener("click", function() {
            container.scrollBy({
                left: -200,
                behavior: "smooth"
            });
        });
    });
</script>
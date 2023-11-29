<body class="bg-dark-subtle d-flex flex-column min-vh-100">
    <div class="container">
        <div class="row">
            <div class="reading ">
                <div class="container bg-light-subtle border-bottom border-5 border-black">
                    <div class="top text-center">
                        <h1>
                            <!-- <a href="">Tên Truyện</a> - -->
                            <span>
                                <?php
                                foreach ($chapters as $key => $value) {
                                    if ($value['id'] == $_GET['chapter']) {
                                        echo $value['name'];
                                    }
                                }
                                ?>
                            </span>
                        </h1>
                    </div>


                    <div class="reading-control text-center" style="font-size: 30px;">
                        <div class="">
                            <a href="<?php echo BASE_URL ?>" class="p-2">
                                <i class="fa fa-home"></i>
                            </a>
                            <a href="<?php echo BASE_URL ?>/?url=comicPage/readPage/<?php echo $previousChapter['webtoon_id'] . '&chapter=' . $previousChapter['id'] ?>" class="p-2">
                                <i class="btn btn-outline-dark m-1 fa fa-arrow-left"></i>
                            </a>

                            <select id="select-Chapter">
                                <option>Select chapter</option>
                                <?php
                                foreach ($chapters as $key => $value) {
                                ?>
                                    <option value="<?php echo BASE_URL ?>/?url=comicPage/readPage/<?php echo $value['webtoon_id'] . '&chapter=' . $value['id'] ?>"><?php echo $value['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <a href="<?php echo BASE_URL ?>/?url=comicPage/readPage/<?php echo $nextChapter['webtoon_id'] . '&chapter=' . $nextChapter['id'] ?>" class="p-2">
                                <i class="btn btn-outline-dark m-1 fa fa-arrow-right"></i>
                            </a>

                            <a href="#" class="p-2">
                                <i class="fa fa-bookmark fa-fa-2xs"></i>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="container text-center bg-dark">
                    <?php
                    // Duyệt qua từng file và hiển thị ảnh (chỉ hiển thị các file ảnh)
                    foreach ($files as $key => $file) {
                        // Đường dẫn đầy đủ của file
                        $filePath = $dir['folderPath'] . '/' . $file;

                        // Kiểm tra nếu là file ảnh
                        if (is_file($filePath) && in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                    ?>
                            <!-- Hiển thị ảnh -->
                            <div class="page-chaper row">
                                <img src="<?php echo $filePath ?>">
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div> <br><br>
            </div>
        </div>
    </div>

    <!-- Chuyển chương -->
    <script type="text/javascript">
        // Sự kiện khi chương được chọn thay đổi
        document.getElementById("select-Chapter").addEventListener("change", function() {
            // Lấy giá trị (value) từ thẻ option được chọn
            var selectedValue = this.value;
            window.location.href = selectedValue;
        });
    </script>

</body>
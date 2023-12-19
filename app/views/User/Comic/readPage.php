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

                            <form id="myForm">
                                <input type="hidden" name="webtoon_id" value="<?php echo $value['webtoon_id']; ?>">
                                <input type="hidden" name="chapter_id" value="<?php echo $value['id']; ?>">
                                <button type="button" onclick="submitForm()" class="bookmark-btn">
                                    <i class='bx bx-bookmark' style='color:#0d6efd; font-size:40px;'></i>
                                </button>
                            </form>
                            <!-- <i class='bx bxs-bookmark' style='color:#FCFD0D; font-size:40px;'></i> -->
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
                                <center>
                                    <img src="<?php echo $filePath ?>" style="max-width: 900px;  height: auto;">
                                </center>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
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


        function submitForm() {
            var webtoonId = document.getElementsByName('webtoon_id')[0].value;
            var chapterId = document.getElementsByName('chapter_id')[0].value;

            console.log("webtoon_id: " + webtoonId);
            console.log("chapter_id: " + chapterId);

            // Tạo đối tượng FormData và thêm dữ liệu vào
            var formData = new FormData();
            formData.append('webtoon_id', webtoonId);
            formData.append('chapter_id', chapterId);

            // Gửi dữ liệu bằng Fetch API hoặc XMLHttpRequest
            fetch("<?php echo BASE_URL ?>/?url=comicPage/add_to_reading_list", {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Xử lý khi gửi thành công
                        console.log("Dữ liệu đã được gửi thành công!");
                        // Thực hiện các hành động sau khi gửi thành công ở đây
                    } else {
                        // Xử lý khi gửi không thành công
                        console.error("Có lỗi xảy ra khi gửi dữ liệu.");
                    }
                })
                .catch(error => {
                    console.error("Lỗi: ", error);
                });
        }
    </script>



</body>
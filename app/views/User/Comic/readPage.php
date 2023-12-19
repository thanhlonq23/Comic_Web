<style>
    /* Loại bỏ viền và định dạng lại các nút */
    .bookmark-btn {
        border: none;
        /* Loại bỏ viền */
        background: none;
        /* Loại bỏ nền */
        padding: 0;
        /* Loại bỏ padding */
        cursor: pointer;
    }

    /* Định dạng icon bên trong nút */
    .bookmark-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
    }

    /* Tùy chỉnh màu sắc và kích thước của icon */
    .bookmark-icon i {
        color: #0d6efd;
        /* Màu sắc icon */
        font-size: 24px;
        /* Kích thước icon */
    }
</style>

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

                            <!-- <button type="button" onclick="addForm()" class="bookmark-btn bookmark-icon">
                                <i class='bx bx-bookmark' style='color:#0d6efd; font-size:40px;'></i>
                            </button>
                            <button type="button" onclick="removeForm()" class="bookmark-btn bookmark-icon">
                                <i class='bx bxs-bookmark' style='color:#FCFD0D; font-size:40px;'></i>
                            </button> -->
                            <button type="button" onclick="toggleForms('add')" class="bookmark-btn bookmark-icon" id="addBtn">
                                <i class='bx bx-bookmark' style='color:#0d6efd; font-size:40px;'></i>
                            </button>
                            <button type="button" onclick="toggleForms('remove')" class="bookmark-btn bookmark-icon" id="removeBtn" style="display: none;">
                                <i class='bx bxs-bookmark' style='color:#FCFD0D; font-size:40px;'></i>
                            </button>
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

        function toggleForms(action) {
            const addBtn = document.getElementById('addBtn');
            const removeBtn = document.getElementById('removeBtn');

            if (action === 'add') {
                addBtn.style.display = 'none';
                removeBtn.style.display = 'inline-flex';
            } else if (action === 'remove') {
                addBtn.style.display = 'inline-flex';
                removeBtn.style.display = 'none';
            }
        }
    </script>



</body>
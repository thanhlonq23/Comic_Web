<body class="bg-dark-subtle d-flex flex-column min-vh-100">
    <div class="container">
        <div class="row">
            <div class="reading ">
                <div class="container bg-light-subtle border-bottom border-5 border-black">
                    <div class="top text-center">
                        <h1>
                            <a href="">Tên Truyện</a>
                            <span> - Chapter 1</span>
                        </h1>
                    </div>
                    <div class="reading-control text-center" style="font-size: 30px;">
                        <div class="">
                            <a href="<?php echo BASE_URL ?>" class="p-2">
                                <i class="fa fa-home"></i>
                            </a>
                            <!-- <a href="#" class="p-2">
                                <i class="fa fa-backward fa-fa-2xs"></i>
                            </a> -->
                            <!-- <a href="#" class="p-2">
                                <i class="fa fa-rotate-left fa-fa-2xs"></i>
                            </a> -->
                            <a href="#" class="p-2">
                                <i class="btn btn-outline-dark m-1 fa fa-arrow-left"></i>
                            </a>
                            <select>
                                <option value="#">Chapter 1</option>
                                <option value="#">Chapter 2</option>
                                <option value="#">Chapter 3</option>
                            </select>
                            <a href="#" class="p-2">
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
                </div>
                <br><br>
            </div>
        </div>
    </div>
</body>
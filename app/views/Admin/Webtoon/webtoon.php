<style>
    .image-container {
        position: relative;
        /* Đặt vị trí là tương đối */
    }

    /* Đoạn mã CSS */
    .change-cover-text {
        display: none;
        color: white;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0.7;
        transition: opacity 0.3s ease-in-out;
        height: 100%;
        width: 100%;
        /* Chiều cao bằng với phần tử cha */
        justify-content: center;
        align-items: center;
    }

    .change-cover-text:hover {
        cursor: pointer;
        opacity: 1;
    }


    .buttons {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        /* Khoảng cách từ nút đến ảnh */
    }

    .cancelButton,
    .doneButton {
        color: #fff;
        padding: 10px 20px;
        background-color: #00c493;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    .cancelButton:hover,
    .doneButton:hover {
        background-color: #45a049;
    }

    .preview-modal {
        display: none;
        /* Không hiển thị ban đầu */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        /* Màu nền với độ mờ */
        z-index: 9999;
        /* Đảm bảo nó hiển thị trên các phần khác */
    }

    .preview-modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        max-width: 80%;
        max-height: 80%;
        overflow: auto;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        /* align-items: center; */
    }

    .preview-image img {
        width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .imageTitle {
        display: block;
        margin: 20px;
    }
</style>
<?php
// Lấy giá trị của tham số 'id' từ URL nếu có
$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
if (isset($parsed_url['query'])) {
    parse_str($parsed_url['query'], $query_params);
    if (isset($query_params['id']) && !empty($query_params['id'])) {
        $webtoonId = rtrim($query_params['id'], '/');
    }
}

if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        if ($value === "Cập nhật cover thành công") {
            // Nếu thêm chapter thành công, hiển thị Swal với nút "Continue"
            echo "
            <script>
            Swal.fire({
                title: 'Cập nhật cover thành công!',
                //text: 'Chọn Continue để tiếp tục thêm truyện',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done',
                allowOutsideClick: false, //Không được phép click ra ngoài popup
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . BASE_URL . "/?url=admin/info/&id=$webtoonId';
                }
            });
        </script>";
        } else {
            echo "
        <script>
            Swal.fire({
                title: 'Cập nhật cover thất bại!',
                //text: 'Kiểm tra lại thông tin Truyện',
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Check',
                allowOutsideClick: false, //Không được phép click ra ngoài popup
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . BASE_URL . "/?url=admin/info/&id=$webtoonId';
                }
            });
        </script>";
        }
    }
}
?>

<!-- Nội dung chính -->
<!-- Này là phần đầu của hiển thị từng comic  -->
<main class="main">
    <form action="<?php echo BASE_URL ?>/?url=webtoon/editCover/<?php echo $webtoonId ?>" method="post" enctype="multipart/form-data">
        <div class="preview-modal">
            <div class="preview-modal-content">
                <div class="preview-image">
                    <div class="imageTitle">Xem trước ảnh</div>
                    <div>
                        <img id="imagePreview" src="#" alt="Preview"> <!-- This is where the selected image will be displayed -->
                        <input name="cover" type="file" id="fileInput" style="display: none;" accept="image/*" />
                    </div>
                    <div class="buttons">
                        <!-- <button class="cancelButton">Cancel</button> -->
                        <button type="submit" class="doneButton">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="bottom-data">
        <div class="comics">
            <div class="top-cover">
                <?php
                foreach ($webtoons as $key => $value) {
                ?>
                    <div class="image-container">
                        <div class="imageIncontainer" style="background-image: url('./public/Uploads/Cover/Webtoon/<?php echo $value['cover']; ?>');" alt="Comic Cover" id="comicCover">
                            <span class="change-cover-text">Chỉnh Sửa Cover</span>
                        </div>
                        <input type="file" name="cover" style="display: none;" accept="image/*" />
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
                        <!-- <div>
                            <p><span>View:</span><?php echo isset($totalViews) ? $totalViews : 0; ?></p>
                        </div> -->
                        <div>
                            <ul>
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
<script>
    // Đoạn mã JavaScript
    document.addEventListener("DOMContentLoaded", function() {
        var fileInput = document.getElementById('fileInput');
        var comicCover = document.getElementById('comicCover');
        var changeCoverText = document.querySelector('.change-cover-text');

        // Sự kiện khi người dùng click vào ảnh cover
        comicCover.addEventListener('click', function() {
            // Mở hộp thoại chọn file khi người dùng click vào ảnh
            fileInput.click();
        });

        // Sự kiện khi người dùng di chuột vào ảnh cover
        comicCover.addEventListener('mouseenter', function() {
            // Hiển thị văn bản "Thay đổi Cover" khi di chuột vào ảnh
            changeCoverText.style.display = 'flex';
        });

        // Sự kiện khi người dùng rời chuột khỏi ảnh cover
        comicCover.addEventListener('mouseleave', function() {
            // Ẩn văn bản "Thay đổi Cover" khi rời chuột khỏi ảnh
            changeCoverText.style.display = 'none';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewModal = document.querySelector('.preview-modal');
        const cancelButton = document.querySelector('.cancelButton');
        const doneButton = document.querySelector('.doneButton');
        const coverInput = document.querySelector('input[name="cover"]');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewModal.style.display = 'block'; // Hiển thị modal xem trước

                    // Gán file hình ảnh đã chọn vào phần tử input file có name là "cover"
                    coverInput.files = event.target.files;
                };
                reader.readAsDataURL(file);
            }
        });


        // cancelButton.addEventListener('click', function() {
        //     previewModal.style.display = 'none'; // Hide the preview modal
        //     fileInput.value = ''; // Reset the input field
        //     imagePreview.src = '#'; // Reset the preview image source
        // });

        doneButton.addEventListener('click', function() {
            // event.preventDefault();
            // Kiểm tra xem người dùng đã chọn hình ảnh chưa trước khi gửi đi
            if (imagePreview.src !== '#') {
                // Tự động gửi form khi người dùng đã chọn hình ảnh
                document.querySelector('form').submit();
                console.log(coverInput.files);
            } else {
                console.log('Vui lòng chọn hình ảnh trước khi gửi đi.');
            }
        });

    });
</script>
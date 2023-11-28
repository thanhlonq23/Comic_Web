<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        if ($value === "Thêm truyện thành công") {
            // Nếu thêm chapter thành công, hiển thị Swal với nút "Continue"
            echo "
        <script>
        Swal.fire({
            title: 'Thêm truyện thành công!',
            text: 'Chọn Continue để tiếp tục thêm truyện',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#4CAF50',
            cancelButtonText: 'Done',
            confirmButtonText: 'Continue',
            allowOutsideClick: false, //Không được phép click ra ngoài popup
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . BASE_URL . "/?url=webtoon/add_Webtoon';
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = '" . BASE_URL . "?url=admin/dashboard';
            }
        });
        </script>";
        } elseif ($value === "Thêm truyện thất bại") {
            // Nếu thêm chapter thất bại, hiển thị Swal với thông báo lỗi (màu đỏ và chữ Check)
            echo "
        <script>
        Swal.fire({
            title: 'Thêm Truyện thất bại',
            text: 'Kiểm tra lại thông tin Truyện',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Check',
            allowOutsideClick: false, //Không được phép click ra ngoài popup
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . BASE_URL . "/?url=webtoon/add_Webtoon';
            }
        });
        </script>";
        }
    }
}

echo "
    <script>
        function validateWebtoonForm() {
            var webtoonName = document.forms['webtoonForm']['name'].value;
            var description = document.forms['webtoonForm']['description'].value;
            var coverInput = document.forms['webtoonForm']['cover'];

            if (webtoonName === '') {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng nhập tên truyện',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, //Không được phép click ra ngoài popup
                });
                return false; // Ngăn chặn việc gửi biểu mẫu
            }

            if (description === '') {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng nhập mô tả truyện',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, //Không được phép click ra ngoài popup
                });
                return false; // Ngăn chặn việc gửi biểu mẫu
            }

            // Kiểm tra xem ít nhất một tệp đã được chọn
            if (!coverInput.value) {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng chọn ảnh bìa',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, //Không được phép click ra ngoài popup
                });
                return false; // Ngăn chặn việc gửi biểu mẫu
            }

            // Bạn có thể thêm các kiểm tra xác thực khác cho các trường khác nếu cần

            return true; // Cho phép gửi biểu mẫu
        }
    </script>";

?>

<h1 style="text-align: center;">Thêm truyện:</h1>
<div class="container mt-5">
    <form name="webtoonForm" onsubmit="return validateWebtoonForm()" action="<?php echo BASE_URL ?>/?url=webtoon/add" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên truyện:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên truyện">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả:</label><br>
            <textarea class="form-control" name="description" rows="5" placeholder="Nhập mô tả"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh bìa:</label>
            <input type="file" class="form-control" name="cover" accept=".jpg,.png,.mov,.jpeg">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>


</div>


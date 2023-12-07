<?php
$webtoonId = ''; // Khai báo biến webtoonId

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
        if ($value === "Thêm chapter thành công") {
            // Nếu thêm chapter thành công, hiển thị Swal với nút "Continue"
            echo "
        <script>
        var webtoonId = " . json_encode($webtoonId) . ";

        Swal.fire({
            title: 'Thêm chapter thành công!',
            text: 'Chọn Continue để tiếp tục thêm Chapter',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#4CAF50',
            cancelButtonText: 'Done',
            confirmButtonText: 'Continue',
            allowOutsideClick: false, //Không được phép click ra ngoài popup
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . BASE_URL . "/?url=chapter/add_Chapter/&id=' + webtoonId;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = '" . BASE_URL . "/?url=admin/info/&id=' + webtoonId;
            }
        });
        </script>";
        } elseif ($value === "Thêm chapter thất bại") {
            // Nếu thêm chapter thất bại, hiển thị Swal với thông báo lỗi (màu đỏ và chữ Check)
            echo "
        <script>
        var webtoonId = " . json_encode($webtoonId) . ";

        Swal.fire({
            title: 'Thêm chapter thất bại',
            text: 'Kiểm tra lại thông tin Chapter',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Check',
            allowOutsideClick: false, //Không được phép click ra ngoài popup
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . BASE_URL . "/?url=chapter/add_Chapter/&id=' + webtoonId;
            }
        });
        </script>";
        }
    }
}

echo "
    <script>
        function validateForm() {
            var chapterName = document.forms['chapterForm']['name'].value;
            var fileInput = document.forms['chapterForm']['images[]'];

            if (chapterName === '') {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng nhập tên Chapter',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, //Không được phép click ra ngoài popup
                });
                return false; // Ngăn chặn việc gửi biểu mẫu
            }

            // Kiểm tra xem ít nhất một tệp đã được chọn
            if (fileInput.files.length === 0) {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng chọn ít nhất một tệp',
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
<h1 style="text-align: center;">Thêm Chapter:</h1>
<div class="container mt-5">
    <form name="chapterForm" onsubmit="return validateForm()" action="<?php echo BASE_URL ?>/?url=chapter/add" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Webtoon:</label>
            <?php
            $selectedWebtoon = ''; // Khởi tạo biến để lưu trữ tên của webtoon được chọn
            foreach ($webtoons as $key => $value) {
                if ($value['id'] == $webtoonId) {
                    $selectedWebtoon = $value['name']; // Lưu trữ tên của webtoon được chọn
                }
            }
            ?>
            <input type="text" class="form-control" name="webtoon_name" id="webtoon_name" value="<?php echo htmlspecialchars($selectedWebtoon); ?>" readonly>
            <input type="hidden" name="webtoon_id" value="<?php echo $webtoonId; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Chapter Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên Chapter">
        </div>

        <div class="mb-3">
            <label class="form-label">File:</label>
            <input class="form-control" type="file" name="images[]" accept=".png,.jpg,.mov,.jpeg" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>

    </form>

</div>
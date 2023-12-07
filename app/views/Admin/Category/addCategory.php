<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        if ($value === "Thêm thể loại thành công") {
            // Nếu thêm chapter thành công, hiển thị Swal với nút "Continue"
            echo "
        <script>
        Swal.fire({
            title: 'Thêm thể loại thành công!',
            text: 'Chọn Continue để tiếp tục thêm thể loại',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#4CAF50',
            cancelButtonText: 'Done',
            confirmButtonText: 'Continue',
            allowOutsideClick: false, //Không được phép click ra ngoài popup
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . BASE_URL . "/?url=category/add_Category';
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = '" . BASE_URL . "?url=admin/category_List';
            }
        });
        </script>";
        } elseif ($value === "Thêm thể loại thất bại") {
            // Nếu thêm chapter thất bại, hiển thị Swal với thông báo lỗi (màu đỏ và chữ Check)
            echo "
        <script>
        Swal.fire({
            title: 'Thêm thể loại thất bại',
            text: 'Kiểm tra lại thông tin thể loại',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Check',
            allowOutsideClick: false, //Không được phép click ra ngoài popup
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . BASE_URL . "/?url=category/add_Category';
            }
        });
        </script>";
        }
    }
}

echo "
    <script>
        function validateCategoryForm() {
            var categoryName = document.forms['categoryForm']['name'].value;

            if (categoryName === '') {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng nhập tên thể loại',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, //Không được phép click ra ngoài popup
                });
                return false; // Ngăn chặn việc gửi biểu mẫu
            }
        }
    </script>";

?>

<h1 style="text-align: center;">Thêm mới Category</h1>
<div class="container mt-5">
    <form name="categoryForm" onsubmit="return validateCategoryForm()" action="<?php echo BASE_URL ?>/?url=category/add" method="post">
        <div class="mb-3">
            <label class="form-label">Tên Category:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên Category">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
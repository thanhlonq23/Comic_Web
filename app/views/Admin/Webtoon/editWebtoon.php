<?php
// print_r($categoriesDatabase);
// var_dump($webtoonByID);
print_r($selectedCategories);

if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        if ($value === "Cập nhật truyện thành công") {
            // Nếu thêm chapter thành công, hiển thị Swal với nút "Continue"
            echo "
        <script>
        Swal.fire({
            title: 'Cập nhật truyện thành công!',
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
        } else {
            // Nếu thêm chapter thất bại, hiển thị Swal với thông báo lỗi (màu đỏ và chữ Check)
            echo "
        <script>
        Swal.fire({
            title: 'Cập nhật truyện thành công',
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
        function UpdateupdateWebtoonForm() {
            var webtoonName = document.forms['updateWebtoonForm']['name'].value;
            var description = document.forms['updateWebtoonForm']['description'].value;
            var coverInput = document.forms['updateWebtoonForm']['cover'];

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

<style>
    /* CSS cho các selectedCategories */
    #selectedCategories {
        display: flex;
        /* Sử dụng Flexbox để xếp theo hàng ngang */
        flex-wrap: wrap;
        /* Cho phép các phần tử wrap sang hàng mới nếu không đủ không gian */
        gap: 8px;
        /* Khoảng cách giữa các phần tử */
    }

    /* CSS cho mỗi phần tử danh mục được chọn */
    #selectedCategories li {
        background-color: #3498db;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 5px;
        font-size: 14px;
    }

    #selectedCategories li:hover {
        background-color: red;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 5px;
        font-size: 14px;
    }
</style>

<h1 style="text-align: center;">Sửa truyện:</h1>
<div class="container mt-5">
    <form name="updateWebtoonForm" onsubmit="return updateWebtoonForm()" action="<?php echo BASE_URL ?>/?url=webtoon/edit/<?php echo $webtoonByID[0]['id'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên truyện:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên truyện" value="<?php echo $webtoonByID[0]['name']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả:</label><br>
            <textarea class="form-control" name="description" rows="5" placeholder="Nhập mô tả"><?php echo $webtoonByID[0]['description']; ?></textarea>
        </div>





        <!-- Tạo danh sách categories còn lại trong database -->
        <div class="form-group">
            <label for="categories">Categories:</label>
            <div style="display: flex; align-items: center;">
                <select class="form-select" id="categoryList">
                </select>

                <input type="hidden" name="danhsach2[]" multiple>
                <button onclick="addCategory()" type="button">Add</button>
            </div>
        </div>

        <!-- Tạo danh sách categories đã được chọn -->
        <div class="mb-3">
            <ul id="selectedCategories">
                <?php foreach ($selectedCategories as $category) : ?>
                    <!-- Lưu các ID vào danh sách categories[] -->
                    <input type="hidden" name="categories[]" value="<?php echo $category['id']; ?>">
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="mb-3">
            Tình trạng <br>
            <input type="radio" id="status1" name="status" value="1" <?php if ($webtoonByID[0]['status'] == 1) echo 'checked'; ?>>
            <label for="status1">Đã hoàn thành</label>
            <input type="radio" id="status2" name="status" value="0" <?php if ($webtoonByID[0]['status'] == 0) echo 'checked'; ?>>
            <label for="status2">Chưa hoàn thành</label>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectedCategoriesInputs = document.querySelectorAll("#selectedCategories input[name='categories[]']");
        var categories = [];

        selectedCategoriesInputs.forEach(function(input) {
            categories.push(input.value);
        });

        console.log("Danh sách ID trong categories[]:", categories);

        // Tạo danh sách danhsach2[] từ categoriesDatabase và selectedCategories
        var categoriesDatabase = <?php echo json_encode($categoriesDatabase); ?>;
        var selectedCategories = <?php echo json_encode($selectedCategories); ?>;

        var selectedCategoryIds = selectedCategories.map(function(category) {
            return category.id;
        });

        var danhsach2 = categoriesDatabase.filter(function(category) {
            return !selectedCategoryIds.includes(category.id);
        });

        // Hiển thị danh sách danhsach2[]
        var categoryList = document.getElementById("categoryList");
        danhsach2.forEach(function(category) {
            var option = document.createElement("option");
            option.value = category.id;
            option.textContent = category.name;
            categoryList.appendChild(option);
        });

        console.log("Danh sách ID trong danhsach2[]:", danhsach2);
    });

    document.addEventListener("DOMContentLoaded", function() {

        var selectedCategories = document.getElementById("selectedCategories");
        var categoryInputs = selectedCategories.querySelectorAll("input[name='categories[]']");
        var categoryList = document.getElementById("categoryList");

        categoryInputs.forEach(function(input) {
            var categoryId = input.value;
            var li = document.createElement("li");
            li.setAttribute("value", categoryId);
            li.textContent = getCategoryNameById(categoryId);
            li.addEventListener("click", function() {
                selectedCategories.removeChild(li);
                input.remove();

                var option = document.createElement("option");
                option.value = categoryId;
                option.textContent = getCategoryNameById(categoryId);
                categoryList.appendChild(option);

                // Log danh sách sau khi xóa
                console.log("Danh sách categories sau khi xóa:", Array.from(selectedCategories.querySelectorAll("input[name='categories[]']")).map(function(input) {
                    return input.value;
                }));

                console.log("Danh sách 2 sau khi xóa:", Array.from(categoryList.options).map(function(option) {
                    return option.value;
                }));
            });
            selectedCategories.appendChild(li);
        });

        // Hàm để lấy tên danh mục dựa trên ID (thay thế bằng dữ liệu thực tế từ PHP)
        function getCategoryNameById(id) {
            var categories = <?php echo json_encode($selectedCategories); ?>;
            var category = categories.find(function(category) {
                return category.id === id;
            });
            return category ? category.name : ''; // Trả về tên danh mục hoặc chuỗi rỗng nếu không tìm thấy
        }
    });

    //Sự kiện button add
    function addCategory() {
        var categoryList = document.getElementById("categoryList");
        var selectedCategories = document.getElementById("selectedCategories");

        var selectedOption = categoryList.options[categoryList.selectedIndex];
        var categoryId = selectedOption.value;
        var categoryName = selectedOption.textContent;


        // Tạo một hidden input mới để lưu giá trị vào danh sách 1
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "categories[]";
        input.value = categoryId;
        selectedCategories.appendChild(input);

        // Hiển thị tên danh mục đã chọn từ danh sách 2 sang danh sách 1
        var li = document.createElement("li");
        li.textContent = categoryName;
        li.addEventListener("click", function() {
            // Khi click vào một li từ danh sách 1, di chuyển giá trị từ danh sách 1 sang danh sách 2
            selectedCategories.removeChild(li);
            categoryList.appendChild(selectedOption);

            // Loại bỏ giá trị khỏi danh sách 1 sau khi di chuyển
            Array.from(selectedCategories.querySelectorAll("input[name='categories[]']")).forEach(function(input) {
                if (input.value === categoryId) {
                    input.remove();
                }
            });

            // Log danh sách sau khi di chuyển
            console.log("Danh sách categories sau khi xóa:", Array.from(selectedCategories.querySelectorAll("input[name='categories[]']")).map(function(input) {
                return input.value;
            }));
            console.log("Danh sách 2 sau khi xóa:", Array.from(categoryList.options).map(function(option) {
                return option.value;
            }));
        });
        selectedCategories.appendChild(li);

        // Loại bỏ option đã chọn từ danh sách 2
        categoryList.removeChild(selectedOption);

        // Log danh sách sau khi thêm
        console.log("Danh sách categories sau khi thêm:", Array.from(selectedCategories.querySelectorAll("input[name='categories[]']")).map(function(input) {
            return input.value;
        }));
        console.log("Danh sách 2 sau khi thêm:", Array.from(categoryList.options).map(function(option) {
            return option.value;
        }));
    }

    // Gán sự kiện click cho nút "Thêm"
    var addButton = document.querySelector("button");
    addButton.addEventListener("click", addCategory);
</script>
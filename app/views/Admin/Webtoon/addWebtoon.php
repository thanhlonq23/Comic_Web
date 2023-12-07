<style>
    h1 {
        margin-top: 50px;
    }

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
    #selectedCategories div {
        background-color: #3498db;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 5px;
        font-size: 14px;
    }

    #selectedCategories div:hover {
        background-color: red;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 5px;
        font-size: 14px;
    }

    #AddButton {
        padding: 5px 40px;
        border: none;
        background-color: #00c493;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        margin-left: 8px;
    }

    #AddButton:hover {
        background-color: #45a049;
    }

    #SubmitButton {
        /* padding: 5px 40px; */
        border: none;
        background-color: #00c493;
        color: white;
        cursor: pointer;
        border-radius: 4px;
    }

    #SubmitButton:hover {
        background-color: #45a049;
    }

    #SubmitButton {
        display: block;
        margin: 0 auto;
        width: 200px;
        height: 50px;
    }

    .char-count {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #888;
    }

    #divButton {
        margin-top: 100px;
    }
</style>

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
    #selectedCategories div {
        background-color: #3498db;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 5px;
        font-size: 14px;
    }

    #selectedCategories div:hover {
        background-color: red;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 5px;
        font-size: 14px;
    }

    #AddButton {
        padding: 5px 40px;
        border: none;
        background-color: #00c493;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        margin-left: 8px;
    }

    #AddButton:hover {
        background-color: #45a049;
    }

    #SubmitButton {
        /* padding: 5px 40px; */
        border: none;
        background-color: #00c493;
        color: white;
        cursor: pointer;
        border-radius: 4px;
    }

    #SubmitButton:hover {
        background-color: #45a049;
    }

    #SubmitButton {
        display: block;
        margin: 0 auto;
        width: 200px;
        height: 50px;
    }

    .char-count {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #888;
    }

    #divButton {
        margin-top: 100px;
    }
</style>

<h1 style="text-align: center;">Thêm truyện:</h1>
<div class="container mt-5">
    <form name="webtoonForm" onsubmit="return validateWebtoonForm()" action="<?php echo BASE_URL ?>/?url=webtoon/add" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên truyện:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên truyện">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả:</label><br>
            <textarea class="form-control" name="description" rows="5" maxlength="255" placeholder="Nhập mô tả"></textarea>
            <span id="charCount" class="char-count"> 255 ký tự còn lại.</span>
        </div>
        <?php if (!empty($categories)) : ?>
            <div class="form-group">
                <label for="categories">Categories:</label>
                <div style="display: flex; align-items: center;">
                    <select class="form-select" id="categoryList">
                    <option value="" disabled selected>---Chọn thể loại---</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button onclick="addCategory()" type="button" id="AddButton">Add</button>
                </div>
            </div>
            <div class="mb-3">
                <!-- <label class="form-label">Thể loại đã chọn:</label> -->
                <ul id="selectedCategories"></ul>
                <input type="hidden" name="categories[]" id="selectedCategoriesInput" multiple>
            </div>
        <?php else : ?>
            <p>No categories found.</p>
        <?php endif; ?>
        <div>
            <label class="form-label">Ảnh bìa:</label>
            <input type="file" class="form-control" name="cover" accept=".jpg,.png,.mov,.jpeg">
        </div>
        <div id="divButton">
            <button type="submit" class="btn btn-primary" id="SubmitButton">Thêm</button>
        </div>
    </form>


</div>
<script>
    //Setting độ dài descrpition 255 vì database của mình đang để varchar255 muốn dài hơn thì sang TEXT hoặc LONGTEXT nhưng mà thôi lười sửa database
    const textarea = document.querySelector('textarea');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
        const remainingChars = 255 - textarea.value.length;
        charCount.textContent = remainingChars;
    });

    //Giải quyết nút Button Add
    function addCategory() {
        var selectElement = document.getElementById('categoryList');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedCategoriesDiv = document.getElementById('selectedCategories');
        var selectedCategoriesInput = document.getElementsByName('categories[]')[0]; // Thay đổi ở đây

        // Create a new item in the selected categories list
        var div = document.createElement("div");
        div.textContent = selectedOption.text;
        div.classList.add('selected-category'); // Thêm class để xác định các selected categories
        div.setAttribute('data-category-id', selectedOption.value); // Lưu ID của category

        // Xóa selected category khi click và cập nhật mảng categories[]
        div.addEventListener('click', function() {
            selectedCategoriesDiv.removeChild(div);
            removeCategoryFromArray(selectedOption.value);
        });

        selectedCategoriesDiv.appendChild(div);

        // Thêm giá trị category
        var currentValue = selectedCategoriesInput.value;
        var newValue = (currentValue === '') ? selectedOption.value : currentValue + ',' + selectedOption.value; // Thay đổi ở đây
        selectedCategoriesInput.value = newValue;

        // In ra Giá trị category gửi đi ở console
        console.log("Giá trị category gửi đi:", selectedCategoriesInput.value);

        // Xóa category tại dropdown để tránh chọn 2 lần
        selectElement.remove(selectElement.selectedIndex);
    }

    // Hàm xóa category khỏi mảng categories[]
    function removeCategoryFromArray(categoryId) {
        var selectedCategoriesInput = document.getElementsByName('categories[]')[0]; // Thay đổi ở đây
        var categoriesArray = selectedCategoriesInput.value.split(',');
        var index = categoriesArray.indexOf(categoryId);
        if (index !== -1) {
            categoriesArray.splice(index, 1);
            selectedCategoriesInput.value = categoriesArray.join(',');
        }
        console.log("Giá trị category gửi đi:", selectedCategoriesInput.value);
    }
</script>
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
        } else {
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

<?php
// Thông tin kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay thế bằng tên máy chủ MySQL của bạn
$username = "root";
$password = "";
$dbname = "truyentranh";

try {
    // Tạo kết nối PDO
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi để bắt lỗi
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn dữ liệu từ bảng categories
    $sql = "SELECT name FROM categories";
    $statement = $connection->prepare($sql);
    $statement->execute();

    // Lấy kết quả trả về dưới dạng mảng kết hợp
    $categorySuggestionsData = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Chuyển đổi kết quả thành dạng JSON để sử dụng trong JavaScript
    $categorySuggestionsDataJSON = json_encode($categorySuggestionsData);
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F4 Comics</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        select,
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 16px;
            /* Điều chỉnh padding để làm cho nút nhỏ hơn */
            font-size: 14px;
            /* Điều chỉnh kích thước chữ */
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Categories */
        .selected-category {
            display: inline-block;
            margin-right: 5px;
            padding: 5px;
            background-color: #3498db;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            position: relative;
            font-size: 15px;
            /* Thêm thuộc tính position */
        }

        .new-category {
            display: inline-block;
            margin-right: 5px;
            padding: 5px;
            background-color: #00c493;
            /* Màu khác cho danh mục mới */
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            position: relative;
            /* Thêm thuộc tính position */
            font-size: 15px;
        }

        .selected-category:hover,
        .new-category:hover {
            display: inline-block;
            margin-right: 5px;
            padding: 5px;
            background-color: red;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            position: relative;
        }

        .category-hover {
            background-color: #f4f4f4;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    require_once 'nav.php';
    ?>
    <main class="main">
        <div class="container">
            <h1>Thêm mới truyện tranh</h1>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="comicName">Name:</label>
                    <input type="text" id="comicName" name="comicName" required>
                </div>
                <div class="form-group">
                    <label for="author-comic">Author:</label>
                    <input type="text" id="author-comic" name="author-comic" required>
                </div>
                <div style="display: flex; justify-content: center;align-items: center;">
                    <input id="Next" type="button" value="Next">
                    <input id="Back1" type="button" value="Back" onclick="goBackComicslist()">
                </div>
            </form>
        </div>

        <div class="container">
            <h1>Thêm mới truyện tranh</h1>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="On-going">On-going</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="coverImage">Cover Image:</label>
                    <input type="file" id="coverImage" name="coverImage" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="categories">Categories:</label>
                    <div style="display: flex; align-items: center;"> <!-- Thêm container flexbox -->
                        <input type="text" id="categories" name="categories" placeholder="Enter categories">
                        <button type="button" id="addCategory">Add</button>
                    </div>
                    <div id="categorySuggestions"></div>
                    <div id="selectedCategories"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div style="display: flex; justify-content: center;align-items: center;">
                    <input type="button" id="Submit" value="Submit">
                    <input type="button" id="Back2" value="Back">
                </div>
            </form>
        </div>


    </main>
    <script src="../../js/admin/admin.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let comicName = ''; // Biến để lưu tên truyện tranh từ form 1
            let authorName = ''; // Biến để lưu tên tác giả

            const firstForm = document.querySelector('.container:nth-of-type(1)');
            const secondForm = document.querySelector('.container:nth-of-type(2)');
            const next = document.querySelector("#Next");
            const back1 = document.querySelector("#Back1");
            const back2 = document.querySelector("#Back2");
            const submit = document.querySelector("#Submit");

            // Hide the second form initially
            secondForm.style.display = 'none';

            next.addEventListener('click', function() {

                // Kiểm tra các trường dữ liệu của biểu mẫu thứ nhất
                // const comicName = document.querySelector("#comicName").value.trim();
                // const authorComic = document.querySelector("#author-comic").value.trim();

                // Kiểm tra các trường dữ liệu của biểu mẫu thứ nhất và lưu vào form 2
                comicName = firstForm.querySelector("#comicName").value.trim();
                authorName = firstForm.querySelector("#author-comic").value.trim();

                // Nếu cả hai trường dữ liệu đã được điền
                if (comicName !== '' && authorName !== '') {
                    firstForm.style.display = 'none';
                    secondForm.style.display = 'block';
                } else {
                    alert("Vui lòng nhập đầy đủ thông tin trước khi chuyển tiếp.");
                    // Hoặc bạn có thể thực hiện các hành động khác, như hiển thị thông báo cho người dùng.
                }
            });

            back1.addEventListener('click', function() {
                // Redirect to comicslist.php
                window.location.href = 'comicslist.php';
            });

            back2.addEventListener('click', function() {
                secondForm.style.display = 'none';
                firstForm.style.display = 'block';
            });


            let userInputCategories = [];
            const categoriesInput = document.getElementById('categories');
            const categorySuggestions = document.getElementById('categorySuggestions');
            const selectedCategories = document.getElementById('selectedCategories');
            const addCategoryButton = document.getElementById('addCategory');

            // Dữ liệu danh mục từ PHP
            // const categorySuggestionsData = ['Action', 'Adventure', 'Fantasy', 'Romance', 'Sci-Fi'];
            const categorySuggestionsData = <?php echo json_encode($categorySuggestionsData); ?>;

            // Hàm để tạo một phần tử danh mục được chọn
            function createCategoryElement(category) {
                const categoryElement = document.createElement('span');
                categoryElement.textContent = category;
                categoryElement.classList.add('selected-category');

                // Tạo sự kiện click để xóa danh mục đã chọn khi click vào nó
                categoryElement.addEventListener('click', function() {
                    selectedCategories.removeChild(categoryElement);
                });

                return categoryElement;
            }

            categoriesInput.addEventListener('input', function() {
                const inputText = this.value.toLowerCase();
                const suggestions = categorySuggestionsData.filter(category =>
                    category.toLowerCase().includes(inputText)
                ); //So sánh dữ liệu nhập và dữ liệu từ database qua chữ thường sau khi biến đổi

                categorySuggestions.innerHTML = suggestions
                    .map(suggestion => `<div>${suggestion}</div>`)
                    .join('');
            });

            categorySuggestions.addEventListener('click', function(event) {
                if (event.target.tagName === 'DIV') {
                    const category = event.target.textContent.trim();
                    const categoryElement = createCategoryElement(category);
                    selectedCategories.appendChild(categoryElement);

                    categoriesInput.value = '';
                    categorySuggestions.innerHTML = '';
                }
            });

            categorySuggestions.addEventListener('mouseover', function(event) {
                if (event.target.tagName === 'DIV') {
                    event.target.classList.add('category-hover');
                }
            });

            categorySuggestions.addEventListener('mouseout', function(event) {
                if (event.target.tagName === 'DIV') {
                    event.target.classList.remove('category-hover');
                }
            });
            addCategoryButton.addEventListener('click', function() {
                const category = categoriesInput.value.trim();
                if (category !== '') {
                    const categoryElement = document.createElement('span');
                    categoryElement.textContent = category;
                    categoryElement.classList.add('new-category');

                    // Thêm vào mảng userInputCategories
                    userInputCategories.push(category);

                    selectedCategories.appendChild(categoryElement);
                    categoriesInput.value = '';
                    categorySuggestions.innerHTML = '';
                }
            });

            submit.addEventListener('click', function() {
                // Kiểm tra các trường dữ liệu của biểu mẫu thứ hai
                const status = document.querySelector("#status").value;
                const coverImage = document.querySelector("#coverImage").files[0];
                const description = document.querySelector("#description").value.trim();

                //Định dạng lại dữ liệu của categories trước khi gửi

                const selectedCategoryElements = document.querySelectorAll('.selected-category');
                const selectedCategoriesArray = Array.from(selectedCategoryElements).map(element => element.textContent.trim());
                const selectedCategories = selectedCategoriesArray.join(',');
                const userInputSelectedCategories = userInputCategories.join(',');

                // Kiểm tra tất cả các trường dữ liệu từ cả hai form
                if (status !== '' && coverImage !== '' && description !== '' && comicName !== '' && authorName !== '' && (selectedCategories || userInputSelectedCategories) !== '') {
                    // Tạo object chứa thông tin từ cả hai form
                    const formData = new FormData();
                    formData.append('comicName', comicName);
                    formData.append('authorName', authorName);
                    formData.append('status', status);
                    formData.append('coverImage', coverImage);
                    formData.append('description', description);
                    formData.append('selectedCategories', selectedCategories);
                    formData.append('userInputSelectedCategories', userInputSelectedCategories);

                    // Xử lý việc gửi biểu mẫu tới tệp PHP
                    // Sử dụng AJAX hoặc gửi biểu mẫu để gửi dữ liệu đến tệp PHP của bạn để xử lý cơ sở dữ liệu
                    // Ví dụ: sử dụng Fetch API hoặc XMLHttpRequest
                    // Sau khi gửi thành công, bạn có thể chuyển hướng đến một trang khác hoặc hiển thị thông báo thành công
                    // Sử dụng Fetch API để gửi dữ liệu đến uploadComic.php
                    fetch('http://f4comics.com:81/f4comics/app/views/php/process/uploadAuthorComic.php', {
                            method: 'POST',
                            body: formData,
                        })
                        // .then(response => {
                        //     if (response.ok) {
                        //         for (const pair of formData.entries()) {
                        //             console.log(pair[0] + ', ' + pair[1]);
                        //         }
                        //         throw new Error('Network response was not ok.');
                        //         // Thực hiện các xử lý khác nếu cần
                        //     }
                        // })
                        .then(data => {
                            // Xử lý kết quả nếu cần thiết
                            window.location.href = 'dashboard.php';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                    // for (const pair of formData.entries()) {
                    //     console.log(pair[0] + ', ' + pair[1]);
                    // }
                } else {
                    alert("Vui lòng nhập đầy đủ thông tin trước khi gửi.");
                    // Hoặc bạn có thể thực hiện các hành động khác, như hiển thị thông báo cho người dùng.
                }
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F4 Comics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
    <style>
        body .container2 {
            /* display: flex; */
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            /* margin: 200px 0 0 400px; */
            margin-top: 100px;
        }

        .container2 {
            width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 20px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            display: flex;
            flex-direction: column;
            /* Adjust alignment and spacing */
            align-items: center;
            gap: 20px;
            /* Adjust gap between elements */
            align-items: center;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .preview {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .image-list {
            flex: 1;
            overflow-y: auto;
            max-height: 540px;
            /* max-width: 200px; */
            border-right: 1px solid #ccc;
            /* Adding a border for separation */
            /* Adjust styles for better appearance */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .image-list ul {
            list-style: none;
            padding: 0;
        }

        .image-list li {
            display: block;
            cursor: pointer;
            padding: 10px;
            margin: 5px;

        }

        .image-list li:hover {
            background-color: #f0f0f0;
            /* Change to the desired hover color */
            text-decoration: none;
        }

        /* CSS cho phần tử <li> chứa hình ảnh được chọn */
        #imageList li.selected-image {
            background-color: #3498db;
            /* Màu nền */
            color: white;
            /* Màu chữ */
            /* Các thuộc tính CSS khác tùy thuộc vào thiết kế bạn muốn áp dụng */
            /* ví dụ: border, padding, margin, font-size, font-weight, etc. */
        }

        /* div 1 */
        .image-viewer {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* padding: 24px; */
            /* gap: 24px; */
            max-width: 1000px;
            width: calc((100% - 200px));
            align-self: stretch;
            /* height: calc(((100vh - 100pxpx)) - 15px); */
            overflow: auto;
            box-sizing: border-box;
        }

        /* div 2 */
        .display-area {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0px;
            gap: 4px;
            width: 100%;
            min-height: 500px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #ccc;
        }

        /* img trong div 2 */
        .display-area img {
            background: #ccc;

            /* max-height: 890px; */
            /*  */
            box-sizing: border-box;
            vertical-align: middle;
            border-style: none;
            overflow-clip-margin: content-box;
            overflow: clip;

            width: 100%;
            height: 100%;
            max-height: 500px;
            object-fit: contain;
        }

        .image-list h4 {
            position: sticky;
            top: 0px;
            /* Điều chỉnh khoảng cách từ đỉnh trang xuống phần tử */
            background-color: #fff;
            /* Màu nền cho phần tử đính cố định */
            z-index: 1;
            /* Đảm bảo phần tử đính cố định hiển thị trên các phần tử khác */
            padding: 8px 0;
            /* Thêm padding để tạo khoảng trắng xung quanh */
            margin-bottom: 10px;
            /* Khoảng cách phần tử đính cố định với phần tử dưới nó */
        }

        .container1 {
            /* max-width: 650px;
            width: 100%;
            padding: 30px; */
            width: calc((100% - 400px));
            margin: 200px 0 0 200px;
            padding: 20px;
            background: #fff;
            border-radius: 20px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;

        }

        .drag-area {
            height: 400px;
            border: 3px dashed #e0eafc;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 10px auto;
        }

        h3 {
            margin-bottom: 20px;
            font-weight: 500;
        }

        .drag-area .icon {
            font-size: 50px;
            color: #1683ff;
        }

        .drag-area .header {
            font-size: 20px;
            font-weight: 500;
            color: #34495e;
        }

        .drag-area .support {
            font-size: 12px;
            color: gray;
            margin: 10px 0 15px 0;
        }

        .drag-area .button {
            font-size: 20px;
            font-weight: 500;
            color: #1683ff;
            cursor: pointer;
        }

        .drag-area.active {
            border: 2px solid #1683ff;
        }

        .drag-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <?php
    require_once 'nav.php';
    ?>

    <main class="main">
        <div class="container1" id="formContainer1">
            <h3>Upload your File or Folder:</h3>
            <div class="drag-area" id="dragDropArea">
                <div class="icon">
                    <i class="fas fa-images"></i>
                </div>
                <span class="header">Click Folder to Upload</span>
                <input type="file" id="fileInput" multiple directory webkitdirectory mozdirectory hidden />
                <!-- multiple: Chọn nhiều files
                directory: cho phép chọn thư mục kết hợp với webkitdirectory và mozdirectory (thuộc tính đặc điểm phi chuẩ của trình duyệt chrome, firefox): cho phép người dùng chọn thư mục trong cửa sổ chọn file
                hidden: Ẩn phần tử khỏi giao diện (ẩn cái button "choose files"+ dòng chữ no file chosen mặc định ấy và thay theesnos là vùng bao quanh -> vùng click vào rộng hơn) -->
                <span class="support">Supports: JPEG, JPG, PNG</span>
            </div>

            <div style="display: block; text-align:center;">
                <input type="button" id="submitButton" value="Submit">
            </div>
        </div>
        <div class="container2" id="formContainer2" style="display: none;">
            <div class="preview">
                <div class="image-list">
                    <h4>Uploaded Images:</h4>
                    <ul id="imageList"></ul>
                </div>
                <div class="image-viewer">
                    <h4>Image Viewer:</h4>
                    <div class="display-area" id="imageDisplayArea">
                        <img id="currentImage" src="" alt="Uploaded Image" />
                    </div>
                </div>
            </div>
            <div style="display: block; text-align:center;">
                <input type="button" id="finalizeUploadButton" value="Submit">
            </div>
        </div>
    </main>

    <script src="../../js/admin/admin.js"></script>
    <script>
        /** NOTE:
         * 'const'.addEventListener.("name_event", () =>{}); Là một arrow function làm callback cho sự kiện "name_event"
         *
         */
        document.addEventListener("DOMContentLoaded", function() {
            //Phần tử HTML
            const fileInput = document.getElementById("fileInput"); //biến của phần input để có thể chọn file hoặc folder
            const imageList = document.getElementById("imageList"); //Danh sách ảnh hiển thị sau khi load ở form sau
            const imageDisplayArea = document.getElementById("imageDisplayArea"); // xác định vùng hiển thị ảnh
            const currentImage = document.getElementById("currentImage"); //biến ảnh đang được hiển thị
            const submitButton = document.getElementById("submitButton"); //submit ở form đầu để chọn xem trước ảnh
            const finalizeUploadButton = document.getElementById("finalizeUploadButton");
            //submit của form sau để thực hiện tác vụ của file xử lý với database
            // const dragDropArea = document.getElementById("dragDropArea");
            //sự kiện cho div id "dragDropArea" (form đầu)
            const firstForm = document.querySelector(".container1");
            const secondForm = document.querySelector(".container2");
            let loadedImages = []; //Khai báo mảng

            //Sự kiện diễn ra trên phần tử dragDropArea
            dragDropArea.addEventListener("click", () => {
                fileInput.click(); //Sự kiện click vào vùng chọn id=dragDropArea (thực tế là button id=fileInput)
            });

            fileInput.addEventListener("change", () => {
                //Giải thích callback function ở đây là sau khi sự kiện "click" hạt động xong thì có 'fileInput', 'fileInput' được truyền vào đây để xử lý như 1 tham số => phải thực hiện sự kiện click trước thì sự kiện change mới hoạt động được.
                const files = fileInput.files; //Sự kiện change xảy ra là lúc fileInput (change)
                //thuộc tính files để truy cập dsach đã chọn (chứa luôn các files được chọn)
                loadedImages = Array.from(files);
                //Array.from() để chuyển danh sách các files đã chọn từ một đối tượng không phải mảng 'files' phía trên (trả về từ fileInput.files)
                //loadImages: mảng chứa các files đã chọn
            });

            //Hàm xử lý sự kiện sau khi upload
            function updateDragDropAreaContent(files) {
                const fileCount = files.length;
                const folderName = files[0].webkitRelativePath.split("/")[0]; // Lấy tên folder nếu có

                // Thay đổi nội dung của dragDropArea
                const dragAreaContent = folderName ? folderName : `${fileCount} image(s) selected`;
                dragDropArea.innerHTML = dragAreaContent;

                // Gọi hàm để hiển thị danh sách ảnh hoặc thực hiện các thao tác khác nếu cần
                displayImage(0);
            }

            fileInput.addEventListener("change", () => {
                const files = fileInput.files;
                loadedImages = Array.from(files);
                // Gọi hàm để cập nhật nội dung của dragDropArea
                updateDragDropAreaContent(loadedImages);
            });



            fileInput.addEventListener("change", () => {
                const files = fileInput.files;
                loadedImages = Array.from(files);

                imageList.innerHTML = "";

                loadedImages.forEach((image, index) => {
                    const listItem = document.createElement("li");
                    listItem.textContent = image.name;
                    listItem.addEventListener("click", () => {
                        displayImage(index);
                    });
                    imageList.appendChild(listItem);
                });

                displayImage(0);
            });

            submitButton.addEventListener("click", () => {
                // Xử lý sự kiện khi người dùng ấn nút 'Submit' trên form 1
                // Ẩn form 1 và hiển thị form 2
                firstForm.style.display = "none";
                secondForm.style.display = "flex";
                // Hiển thị danh sách các file đã chọn
                const files = fileInput.files;
                const imageList = document.getElementById("imageList");
                imageList.innerHTML = "";
                Array.from(files).forEach((file, index) => {
                    const listItem = document.createElement("li");
                    listItem.textContent = file.name;
                    listItem.addEventListener("click", () => {
                        displayImage(index);
                    });
                    imageList.appendChild(listItem);
                });
                // Hiển thị ảnh đầu tiên
                displayImage(0);
            });

            finalizeUploadButton.addEventListener("click", () => {
                // Xử lý sự kiện khi người dùng ấn nút 'Finalize Upload' trên form 2
                // Thực hiện các hành động khi hoàn tất quá trình tải lên (ví dụ: gửi dữ liệu đến upload.php)
                console.log("Finalizing upload...", loadedImages);
                // Ví dụ: const formData = new FormData(); formData.append("images", loadedImages);
                // fetch("upload.php", { method: "POST", body: formData });
            });

            //Sự kiện hiển thị ảnh tương ứng với chỉ số index được truyền vào.
            function displayImage(index) {
                if (loadedImages && loadedImages.length > 0 && index >= 0 && index < loadedImages.length) {
                    //kiểm tra xem mảng loadedImages có tồn tại và không rỗng, đồng thời chỉ số index nằm trong phạm vi của mảng hay không
                    const reader = new FileReader();
                    //Đối tượng FileReader cho phép web app đọc nội dung của file (hoặc raw data buffer) được yêu cầu từ người dùng. File hoặc raw data buffer được yêu cầu thông qua input type="file" hoặc drag and drop (sự kiện drop).
                    reader.onload = function(event) {
                        //Sự kiện load được kích hoạt khi tiến trình đọc file hoàn tất.
                        currentImage.src = event.target.result;
                        //Đối tượng FileReader có thuộc tính result chứa nội dung của file được đọc dưới dạng URL (base64 encoded string).

                        const listItems = document.querySelectorAll("#imageList li");
                        // Tìm phần tử <li> chứa hình ảnh được chọn bằng cách sử dụng index
                        listItems.forEach((item, idx) => {
                            if (idx === index) {
                                // Nếu index của phần tử <li> trùng với index của hình ảnh được chọn
                                item.classList.add("selected-image"); // Thêm lớp CSS cho phần tử <li>
                            } else {
                                item.classList.remove("selected-image"); // Xóa lớp CSS cho các phần tử <li> còn lại
                            }
                        });
                    };
                    reader.readAsDataURL(loadedImages[index]);
                    //Phương thức readAsDataURL() của đối tượng FileReader sẽ đọc nội dung của file được chọn và trả về dưới dạng URL (base64 encoded string).
                }
            }
        });
    </script>


</body>


</html>
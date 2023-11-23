const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

// $(document).ready(function () {
//     // Function để load nội dung từ trang dashboard.php khi truy cập lần đầu
//     function loadInitialContent() { // khai báo một hàm JavaScript
//         var currentURL = window.location.href; // lấy địa chỉ URL hiện tại của trang web và lưu trữ vào biến currentURL.
//         if (currentURL.indexOf('?') === -1) {
//             /*kiểm tra xem trong currentURL có chứa ký tự ? không.
//             Ký tự ? thường xuất hiện trong các URL có query string (các tham số được truyền qua URL).
//             giá trị -1. Điều này có ý nghĩa là chuỗi con không được tìm thấy trong chuỗi gốc.
//             tức là không ánh xạ url qua trang khác đó (không có tham số truyền vào ví dụ page=? ? ở đâu có thể là dashboard của dashboard.php, user.php, category.php, product.php, order.php, setting.php)
//             */
//             loadContent('dashboard.php');//tải nội dung từ trang dashboard.php khi truy cập lần đầu
//             $('.side-menu a[href="dashboard.php"]').parent('li').addClass('active');
//             //Sử dụng JQuery thêm lớp active vào li chứa một a có href là "dashboard.php"
//             /*
//             Ký hiệu $ được sử dụng trong jQuery để thực hiện các hoạt động chọn phần tử DOM hoặc gọi các chức năng của thư viện jQuery
//             $('.some-class') sẽ chọn tất cả các phần tử có class là 'some-class'.
//             $('#some-id') sẽ chọn phần tử có id là 'some-id'.
//             $(document).ready(function() { ... }) sẽ chạy các đoạn mã JavaScript bên trong khi tài liệu HTML đã được tải hoàn toàn.
//             */
//         }
//     }

//     // Function để load nội dung từ các trang PHP
//     function loadContent(page) {
//         $.ajax({
//             /**
//              * Một yêu cầu AJAX (Asynchronous JavaScript and XML) là một loại yêu cầu gửi từ trình duyệt web đến máy chủ thông qua JavaScript mà không làm tải lại trang hoàn toàn.
//             Nó cho phép truy vấn và nhận dữ liệu từ máy chủ một cách bất đồng bộ, tức là không gây gián đoạn trải nghiệm người dùng.
//             *Công nghệ AJAX không bắt buộc phải sử dụng XML, mà cũng có thể sử dụng các định dạng dữ liệu khác như JSON hoặc các định dạng văn bản khác.
//             *Các yêu cầu AJAX có thể thực hiện các hoạt động như:
//                 1. Gửi dữ liệu đến máy chủ: Điều này thường được thực hiện thông qua phương thức POST hoặc GET để gửi dữ liệu từ form hoặc các thông tin khác lên máy chủ.
//                 2. Nhận dữ liệu từ máy chủ: Sau khi yêu cầu được gửi, máy chủ sẽ xử lý và trả về dữ liệu. Dữ liệu này có thể là văn bản, JSON, hoặc bất kỳ định dạng nào khác mà máy chủ hỗ trợ.
//                 3. Cập nhật giao diện người dùng một cách không đồng bộ: Dữ liệu trả về từ máy chủ có thể được sử dụng để cập nhật phần nội dung của trang web mà không cần tải lại trang hoàn toàn.
//                 Điều này giúp cải thiện trải nghiệm người dùng và làm cho ứng dụng trở nên nhanh hơn và trực quan hơn.
//             *Yêu cầu AJAX thường được thực hiện bằng cách sử dụng các phương thức và thư viện JavaScript như XMLHttpRequest, fetch API hoặc các thư viện như jQuery để gửi và nhận dữ liệu từ máy chủ.
//              */
//             url: page,//page: biến đại diện cho đường dẫn trang cần ánh xạ
//             type: 'GET',
//             success: function (response) {
//                 /**
//                  * hàm callback được thực thi khi yêu cầu AJAX thành công. Biến response chứa dữ liệu được trả về từ trang PHP.
//                  */
//                 $('.main').html(response); // Thay đổi nội dung của <div class="main"> thành nội dung của trang được load
//                 /*$('.main').html(response): Câu lệnh này sử dụng jQuery để thay đổi nội dung của phần tử có class là 'main' bằng nội dung được trả về từ trang PHP.
//                 Điều này thường được sử dụng để cập nhật giao diện người dùng với dữ liệu mới.
//                 */
//             },
//             error: function () {
//                 //error: function () { ... }: Đây là một hàm callback được thực thi khi yêu cầu AJAX gặp lỗi.
//                 $('.main').html('Không thể tải trang.'); // Xử lý lỗi nếu có
//             }
//         });
//     }

//     // Load trang ban đầu nếu không có query string trong URL và đánh dấu active cho side menu
//     loadInitialContent();

//     // Xử lý khi click vào menu
//     $('.side-menu a').click(function (e) {
//         e.preventDefault(); // Ngăn chặn chuyển hướng mặc định của link

//         var page = $(this).attr('href'); // Lấy đường dẫn từ href
//         loadContent(page); // Gọi hàm để load nội dung tương ứng với trang

//         // Xóa class active khỏi tất cả các liên kết trong side menu
//         $('.side-menu a').removeClass('active');
//         // Thêm class active cho liên kết được click
//         $(this).addClass('active');
//     });
// });
// Lấy danh sách các menu items

// document.addEventListener("DOMContentLoaded", function() {
//     const comicRows = document.querySelectorAll(".comic-row");

//     comicRows.forEach(function(row) {
//         row.addEventListener("click", function() {
//             location.href = 'comic.php';
//         });
//     });
// });

//list dashboard
// document.addEventListener("DOMContentLoaded", function() {
//     const comicRows = document.querySelectorAll(".comicdb-row");

//     comicRows.forEach(function(row) {
//         row.addEventListener("click", function() {
//             // Chuyển hướng tới trang comic khi click vào comic row
//             location.href = 'comic.php';
//         });
//     });
// });
// //list comicslist
// document.addEventListener("DOMContentLoaded", function() {
//     const comicRows = document.querySelectorAll(".comic-row");

//     comicRows.forEach(function(row) {
//         const editButton = row.querySelector('input[value="Edit"]');
//         const deleteButton = row.querySelector('input[value="Delete"]');

//         editButton.addEventListener("click", function(eventcm) {
//             eventcm.preventDefault();
//             location.href = 'editcomic.php';
//         });

//         deleteButton.addEventListener("click", function(eventcm) {
//             eventcm.preventDefault();
//             location.href = 'deletecomic.php';
//         });

//         row.addEventListener("click", function(eventcm) {
//             if (eventcm.target !== editButton && eventcm.target !== deleteButton) {
//                 location.href = 'comic.php';
//             }
//         });
//     });
// });

// //list chapters tại comic.php
// document.addEventListener("DOMContentLoaded", function() {
//     const comicRows = document.querySelectorAll(".chapter-row");

//     comicRows.forEach(function(row) {
//         // Lấy nút "Edit" trong từng hàng
//         const editButton = row.querySelector('input[value="Edit"]');
//         const deleteButton = row.querySelector('input[value="Delete"]');

//         // Thêm sự kiện click cho nút "Edit"
//         editButton.addEventListener("click", function(event) {
//             // Ngăn chặn hành vi mặc định của nút (tránh refresh trang)
//             event.preventDefault();

//             // Chuyển hướng sang trang edit.php
//             location.href = 'editchapter.php';
//         });

//         // Thêm sự kiện click cho nút "Delete"
//         deleteButton.addEventListener("click", function(event) {
//             // Ngăn chặn hành vi mặc định của nút (tránh refresh trang)
//             event.preventDefault();

//             // Thực hiện xóa hoặc xử lý logic xóa ở đây

//             // Ví dụ: chuyển hướng sang trang delete.php
//             location.href = 'deletechapter.php';
//         });

//         // Thêm sự kiện click cho toàn bộ hàng (trừ nút "Edit" và "Delete")
//         row.addEventListener("click", function(event) {
//             // Kiểm tra xem sự kiện click được kích hoạt từ nút "Edit" hoặc "Delete" hay không
//             if (event.target !== editButton && event.target !== deleteButton) {
//                 location.href = 'reading.php';
//             }
//         });
//     });
// });


// document.addEventListener("DOMContentLoaded", function() {
//     const comicRows = document.querySelectorAll(".comic-row");

//     comicRows.forEach(function(row) {
//         const editButton = row.querySelector('input[value="Edit"]');
//         const deleteButton = row.querySelector('input[value="Delete"]');

//         editButton.addEventListener("click", function(eventcm) {
//             eventcm.preventDefault();
//             location.href = 'editcomic.php';
//         });

//         deleteButton.addEventListener("click", function(eventcm) {
//             eventcm.preventDefault();
//             location.href = 'deletecomic.php';
//         });

//         row.addEventListener("click", function(eventcm) {
//             if (eventcm.target !== editButton && eventcm.target !== deleteButton) {
//                 location.href = 'comic.php';
//             }
//         });
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    // Lấy tất cả các hàng có class "comic-row"
    const comicRows = document.querySelectorAll('.comic-row');

    // Lặp qua từng hàng và thêm sự kiện click
    comicRows.forEach(row => {
        row.addEventListener('click', () => {
            window.location.href = 'comic.php'; // Chuyển hướng sang comic.php khi click vào hàng
        });

        // Lấy các button "Edit" và "Delete" trong mỗi hàng
        const editButton = row.querySelector('input[value="Edit"]');
        const deleteButton = row.querySelector('input[value="Delete"]');

        // Thêm sự kiện click cho nút Edit
        editButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Ngăn chặn sự kiện click trên hàng
            window.location.href = 'editcomic.php'; // Chuyển hướng sang edit.php khi click vào nút Edit
        });

        // Thêm sự kiện click cho nút Delete
        deleteButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Ngăn chặn sự kiện click trên hàng
            window.location.href = 'deletecomic.php'; // Chuyển hướng sang delete.php khi click vào nút Delete
        });
    });

});
document.addEventListener("DOMContentLoaded", function () {
    const chapterRows = document.querySelectorAll(".chapter-row");

    chapterRows.forEach(function (row) {
        const editButton = row.querySelector('input[value="Edit"]');
        const deleteButton = row.querySelector('input[value="Delete"]');

        editButton.addEventListener("click", function (event) {
            event.preventDefault();
            location.href = 'editchapter.php';
        });

        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            location.href = 'deletechapter.php';
        });

        row.addEventListener("click", function (event) {
            if (event.target !== editButton && event.target !== deleteButton) {
                location.href = 'reading.php';
            }
        });
    });
});



const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

// const toggler = document.getElementById('theme-toggle');

// toggler.addEventListener('change', function () {
//     if (this.checked) {
//         document.body.classList.add('dark');
//     } else {
//         document.body.classList.remove('dark');
//     }
// });


//Khi có nội dung list chpaters trong tbody thì vẫn hiển thị default, khi không có chapter nào sẽ hiển thị phần thêm chapter mới, ẩn thead
document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.querySelector(".bottom-data .comics tbody");
    const thead = document.querySelector(".bottom-data .comics thead");

    if (tbody.children.length === 0) {
        // Nếu tbody không có nội dung, ẩn thead
        thead.style.display = "none";
        // tbody.classList.add("no-thead");
        // Tạo một dòng mới trong tbody
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td colspan="4" style="justify-content: center; height: 250px">
                <p>Chưa có chapter nào. Hãy thêm chapter</p>
                <input type="button" value="Create Chapter">
            </td>
        `;

        // Thêm sự kiện click vào td mới
        newRow.addEventListener("click", function () {
            location.href = 'uploadchapter.php';
        });

        // Thêm dòng mới vào tbody
        tbody.appendChild(newRow);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const createChapterBtn = document.querySelector('.header input[type="button"][value="Create Chapter"]');

    if (createChapterBtn) {
        createChapterBtn.addEventListener("click", function () {
            location.href = 'uploadchapter.php';
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const createProjectBtn = document.querySelector('.upload-comic input[type="button"][value="Create Project"]');

    if (createProjectBtn) {
        createProjectBtn.addEventListener("click", function (event) {
            event.preventDefault();
            location.href = 'uploadcomic.php';
        });
    }
});


// document.addEventListener("DOMContentLoaded", function() {
//     const comicRows = document.querySelectorAll(".comic-row");

//     comicRows.forEach(function(row) {
//         const deleteButton = row.querySelector('input[value="Delete"]');

//         deleteButton.addEventListener("click", function(event) {
//             event.preventDefault();
//             // Thực hiện xóa hoặc xử lý logic xóa ở đây
//             location.href = 'deletecomic.php';
//         });

//         row.addEventListener("click", function(event) {
//             // Kiểm tra xem sự kiện được kích hoạt có phải từ nút "Delete" hay không
//             if (event.target === deleteButton) {
//                 event.stopPropagation(); // Ngăn chặn sự kiện lan rộng
//             } else {
//                 location.href = 'comic.php';
//             }
//         });
//     });
// });

function goBackComicslist() {
    window.location.href = 'comicslist.php';
}


//upload chapter demo

$(document).ready(function () {
    function setupFileUpload() {
        const dragArea = $('.drag-area');
        const fileInput = $('input[type="file"]');
        const submitButton = $('input[type="button"]');

        // Kéo và thả thư mục
        dragArea.on('dragover', function (e) {
            e.preventDefault();
            dragArea.addClass('active');
        });

        dragArea.on('dragleave', function () {
            dragArea.removeClass('active');
        });

        dragArea.on('drop', function (e) {
            e.preventDefault();
            const files = e.originalEvent.dataTransfer.items;
            handleFiles(files);
            dragArea.removeClass('active');
        });

        // Chọn thư mục khi click vào khu vực tải lên
        dragArea.on('click', function () {
            fileInput.click();
        });

        // Xử lý sự kiện khi chọn thư mục
        fileInput.on('change', function () {
            const files = fileInput[0].files;
            handleFiles(files);
        });

        // Hàm kiểm tra và xử lý các tệp tin hình ảnh
        function handleFiles(files) {
            let hasImageFiles = false;

            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/jpg') {
                    hasImageFiles = true;
                    break;
                }
            }

            if (hasImageFiles) {
                // Code để xử lý tệp tin hình ảnh
                console.log('Files are valid. Ready to upload.');
            } else {
                alert('No image files found in the selected folder!');
            }
        }

        // Xử lý sự kiện nhấn nút "Submit Upload"
        submitButton.on('click', function () {
            const files = fileInput[0].files;
            handleFiles(files);
        });
    }

    // Gọi hàm setupFileUpload khi tài liệu được tải
    setupFileUpload();
});


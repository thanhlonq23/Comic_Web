
const sideLinks = document.querySelectorAll(
  ".sidebar .side-menu li a:not(.logout)"
);

sideLinks.forEach((item) => {
  const li = item.parentElement;
  item.addEventListener("click", () => {
    sideLinks.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các hàng có class "comic-row"
  const comicRows = document.querySelectorAll(".comic-row");
  var rows = document.querySelectorAll('.comic-row');
  var baseUrl = "http://localhost:81/f4comics";
  //Sửa lại đường link

  // Lặp qua từng hàng và thêm sự kiện click
  rows.forEach(function (row) {
    row.addEventListener('click', function () {

// Lấy giá trị của $value['id'] từ href của thẻ a trong hàng được click
var id = this.querySelector('a').getAttribute('href').split('id=')[1];
      // Chuyển hướng trang web tới đường link mong muốn
      window.location.href = baseUrl + "/?url=admin/info/&id=" + id;
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
      location.href = "#";
    });

    deleteButton.addEventListener("click", function (event) {
      event.preventDefault();
      location.href = "#";
    });

    row.addEventListener("click", function (event) {
      if (event.target !== editButton && event.target !== deleteButton) {
        location.href = "#";
      }
    });
  });
});

const menuBar = document.querySelector(".content nav .bx.bx-menu");
const sideBar = document.querySelector(".sidebar");

menuBar.addEventListener("click", () => {
  sideBar.classList.toggle("close");
});

const searchBtn = document.querySelector(
  ".content nav form .form-input button"
);
const searchBtnIcon = document.querySelector(
  ".content nav form .form-input button .bx"
);
const searchForm = document.querySelector(".content nav form");

searchBtn.addEventListener("click", function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault;
    searchForm.classList.toggle("show");
    if (searchForm.classList.contains("show")) {
      searchBtnIcon.classList.replace("bx-search", "bx-x");
    } else {
      searchBtnIcon.classList.replace("bx-x", "bx-search");
    }
  }
});

window.addEventListener("resize", () => {
  if (window.innerWidth < 768) {
    sideBar.classList.add("close");
  } else {
    sideBar.classList.remove("close");
  }
  if (window.innerWidth > 576) {
    searchBtnIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
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
      location.href = "uploadchapter.php";
    });

    // Thêm dòng mới vào tbody
    tbody.appendChild(newRow);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const createChapterBtn = document.querySelector(
    '.header input[type="button"][value="Create Chapter"]'
  );

  if (createChapterBtn) {
    createChapterBtn.addEventListener("click", function () {
      location.href = "#";
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const createProjectBtn = document.querySelector(
    '.upload-comic input[type="button"][value="Create Project"]'
  );

  if (createProjectBtn) {
    createProjectBtn.addEventListener("click", function (event) {
      event.preventDefault();
      location.href = "#";
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
  window.location.href = "#";
}

//upload chapter demo

$(document).ready(function () {
  function setupFileUpload() {
    const dragArea = $(".drag-area");
    const fileInput = $('input[type="file"]');
    const submitButton = $('input[type="button"]');

    // Kéo và thả thư mục
    dragArea.on("dragover", function (e) {
      e.preventDefault();
      dragArea.addClass("active");
    });

    dragArea.on("dragleave", function () {
      dragArea.removeClass("active");
    });

    dragArea.on("drop", function (e) {
      e.preventDefault();
      const files = e.originalEvent.dataTransfer.items;
      handleFiles(files);
      dragArea.removeClass("active");
    });

    // Chọn thư mục khi click vào khu vực tải lên
    dragArea.on("click", function () {
      fileInput.click();
    });

    // Xử lý sự kiện khi chọn thư mục
    fileInput.on("change", function () {
      const files = fileInput[0].files;
      handleFiles(files);
    });

    // Hàm kiểm tra và xử lý các tệp tin hình ảnh
    function handleFiles(files) {
      let hasImageFiles = false;

      for (let i = 0; i < files.length; i++) {
        if (
          files[i].type === "image/jpeg" ||
          files[i].type === "image/png" ||
          files[i].type === "image/jpg"
        ) {
          hasImageFiles = true;
          break;
        }
      }

      if (hasImageFiles) {
        // Code để xử lý tệp tin hình ảnh
        console.log("Files are valid. Ready to upload.");
      } else {
        alert("No image files found in the selected folder!");
      }
    }

    // Xử lý sự kiện nhấn nút "Submit Upload"
    submitButton.on("click", function () {
      const files = fileInput[0].files;
      handleFiles(files);
    });
  }

  // Gọi hàm setupFileUpload khi tài liệu được tải
  setupFileUpload();
});

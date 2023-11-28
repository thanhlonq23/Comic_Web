<?php
class category extends Controller
{
    private $table = 'categories';
    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }
    public function index()
    {
        $this->list_Category();
    }

    public function list_Category()
    {
        $categoryModel = $this->load->model("categoryModel");
        $data['categories'] = $categoryModel->selectAll($this->table);
        $this->load->view("Admin/header");
        $this->load->view("Admin/Category/listCategory", $data);
    }
    public function delete_Category($id)
    {
        $cond = "id = '$id'";
        $categoryModel = $this->load->model('categoryModel');
        $categoryModel->delete($this->table, $cond);
        header("Location:" . BASE_URL . "/?url=Category/list_Category");
    }
    public function edit_Category($id)
    {
        $cond = "id = '$id'";
        $categoryModel = $this->load->model("categoryModel");
        $data['categoryByID'] = $categoryModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/header");
        $this->load->view("Admin/User/editCategory", $data);
    }

    public function edit($id)
    {
        $name = $_POST['name'];

        $cond = "id = '$id'";
        $data = [
            'name' => $name
        ];

        $categoryModel = $this->load->model("categoryModel");
        $result = $categoryModel->update($this->table, $data, $cond);

        if ($result != 0) {
            $message['msg'] = "Cập nhật category thành công";
            header("Location:" . BASE_URL . "/?url=category/&msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật category thất bại";
            header("Location:" . BASE_URL . "/?url=category/&msg=" . urlencode(serialize($message)));
        }
    }

    public function viewWebtoons($categoryID)
    {
        // Lấy danh sách các webtoon thuộc category dựa trên ID
        $categoryModel = $this->load->model("categoryModel");
        $webtoons = $categoryModel->getWebtoonsByCategory($categoryID);

        // Hiển thị view để xem danh sách các webtoon thuộc category
        $data['webtoons'] = $webtoons;
        $this->load->view("Admin/Category/viewWebtoons", $data);
    }

    public function addWebtoon($categoryID, $webtoonID)
    {
        // Thêm webtoon vào category
        $categoryModel = $this->load->model("categoryModel");
        $result = $categoryModel->addWebtoonToCategory($categoryID, $webtoonID);

        // Kiểm tra và xử lý kết quả
        if ($result != 0) {
            echo '<script>';
            echo 'console.log("Thêm webtoon thành công!");';
            echo '</script>';
        } else {
            // Thêm thất bại
            echo '<script>';
            echo 'console.log("Thêm webtoon thất bại!");';
            echo '</script>';
        }
    }

    public function removeWebtoon($categoryID, $webtoonID)
    {
        // Xóa webtoon khỏi category
        $categoryModel = $this->load->model("categoryModel");
        $result = $categoryModel->removeWebtoonFromCategory($categoryID, $webtoonID);

        // Kiểm tra và xử lý kết quả
        if ($result != 0) {
            echo '<script>';
            echo 'console.log("Xóa webtoon thành công!");';
            echo '</script>';
        } else {
            // Thêm thất bại
            echo '<script>';
            echo 'console.log("Xóa webtoon thất bại!");';
            echo '</script>';
        }
    }
}

<?php
// Danh mục
class categoryController extends Controller
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("HomePage/header");
    }

    public function list_category()
    {
        $this->load->view("header");
        $categoryModel = $this->load->model('categoryModel');
        $tableCategory = 'user';
        $data['category'] = $categoryModel->category($tableCategory);
        $this->load->view("Category/category", $data);
        // $this->load->view("footer"); 
    }

    public function categoryByID()
    {
        $this->load->view("header");

        $categoryModel = $this->load->model('categoryModel');
        $id = 2;
        $tableCategory = 'user'; // Truyen
        $data['categoryByID'] = $categoryModel->categoryByID($tableCategory, $id);

        // Hiện trang từ views
        $this->load->view("Category/categoryByID", $data);

        // $this->load->view("footer"); 
    }

    public function insertCategory()
    {
        $id = null;
        $username = null;
        $password = null;

        $categoryModel = $this->load->model('categoryModel');
        $tableCategory = 'user';

        if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password'])) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
        }

        $data = array(
            'id' => $id,
            'username' => $username,
            'password' => $password
        );

        $result = $categoryModel->insertCategory($tableCategory, $data);

        $message = array();
        if ($result == 1) {
            $message['msg'] = "Thêm dữ liêu thành công";
        } else {
            $message['msg'] = "Thêm dữ liêu thất bại";
        }
        $this->load->view("Category/addCategory", $message);
    }

    // public function addCategory()
    // {
    //     $this->load->view('addCategory');
    // }

    public function updateCategory()
    {
        $categoryModel = $this->load->model('categoryModel');
        $tableCategory = 'user';

        // $id = $_POST['id'];
        // $username = $_POST['username'];
        // $password = $_POST['password'];

        $id = 2;
        $cond = "user.id='$id'";

        $data = array(
            'username' => "AAA",
            'password' => "123443"
        );

        $result = $categoryModel->updateCategory($tableCategory, $data, $cond);

        if ($result == 1) {
            echo "Cập nhật dữ liêu thành công";
        } else {
            echo "Cập nhật dữ liêu thất bại";
        }
    }

    public function deleteCategory()
    {
        $categoryModel = $this->load->model('categoryModel');
        $tableCategory = 'user';
        // $id = $_POST['id'];

        $id = 1;
        $cond = "id='$id'";
        $result = $categoryModel->deleteCategory($tableCategory, $cond);

        if ($result == 1) {
            echo "Xóa dữ liêu thành công";
        } else {
            echo "Xóa dữ liêu thất bại";
        }
    }
}

<?php
class categorycontroller extends Controller
{
    private $table = 'categories';

    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }

    public function index()
    {
        $this->listCategories();
    }

    public function list()
    {
        $data = $this->list();
        $this->load->view("Admin/Category/categoriesList", $data);
    }

    public function add()
    {
        $this->load->view("Admin/nav");
        $this->load->view("Admin/Category/addCategory");
    }

    public function delete_Category($id)
{
    $categoryModel = $this->load->model('categoryModel');

    // Xóa category từ bảng categories
    $cond = "id = '$id'";
    $result = $categoryModel->delete('categories', $cond);

    if ($result != 0) {
        // Xóa liên kết trong bảng webtoons_categories
        $cond_webtoons_categories = "categories_id = '$id'";
        $result_webtoons_categories = $categoryModel->delete('webtoons_categories', $cond_webtoons_categories);

        if ($result_webtoons_categories != 0) {
            $message['msg'] = "Xóa category thành công";
            header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
            exit;
        } else {
            $message['msg'] = "Xóa category không thành công: Lỗi khi xóa liên kết";
            header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
            exit;
        }
    } else {
        $message['msg'] = "Xóa category không thành công: Lỗi khi xóa category";
        header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
        exit;
    }
}

public function edit_Category($id)
{
    $categoryModel = $this->load->model('categoryModel');

    // Lấy thông tin category cần chỉnh sửa từ database
    $cond = "id = '$id'";
    $data['category'] = $categoryModel->selectByCond('categories', $cond);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Xử lý thông tin chỉnh sửa gửi từ form
        $name = $_POST['name'];

        $updatedData = [
            'name' => $name, // Các trường cần chỉnh sửa ở đây
            // Thêm các trường khác cần chỉnh sửa tương ứng
        ];

        // Thực hiện cập nhật dữ liệu
        $result = $categoryModel->update('categories', $updatedData, $cond);

        if ($result != 0) {
            $message['msg'] = "Chỉnh sửa category thành công";
            header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
            exit;
        } else {
            $message['msg'] = "Chỉnh sửa category không thành công";
            header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
            exit;
        }
    } else {
        // Hiển thị form chỉnh sửa thông tin category
        $this->load->view("Admin/nav");
        $this->load->view("Admin/Category/editCategory", $data);
    }
}


    // Thêm hàm để lấy danh sách các Webtoon thuộc một Category cụ thể
    public function getWebtoonsByCategory($categoryID)
    {
        // Viết code để lấy danh sách các Webtoon thuộc một Category cụ thể
        $webtoonModel = $this->load->model("webtoonModel");
        $cond = "categories_id = '$categoryID'";
        $data['webtoons'] = $webtoonModel->selectByCond('webtoons_categories', $cond);

        // Hiển thị dữ liệu webtoons thuộc category trong view
        $this->load->view("Category/webtoonsByCategory", $data);
    }

    // Các hàm khác cần thiết để xử lý Categories
    public function add_Category()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Xử lý thông tin gửi từ form thêm Category
        $name = $_POST['name']; // Đây là ví dụ, bạn cần thay đổi theo cấu trúc dữ liệu thực tế của category

        $newCategory = [
            'name' => $name, // Các trường cần thêm ở đây
            // Thêm các trường khác cần thiết cho Category
        ];

        $categoryModel = $this->load->model('categoryModel');
        $result = $categoryModel->insert('categories', $newCategory);

        if ($result != 0) {
            $message['msg'] = "Thêm category thành công";
            header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
            exit;
        } else {
            $message['msg'] = "Thêm category không thành công";
            header("Location:" . BASE_URL . "/?url=admin/category_List/&msg=" . urlencode(serialize($message)));
            exit;
        }
    } else {
        // Hiển thị form thêm Category
        $this->load->view("Admin/nav");
        $this->load->view("Admin/Category/addCategory");
    }
}


    // ...Thêm, chỉnh sửa, xóa, lấy danh sách Categories...
    public function listCategories()
{
    $categoryModel = $this->load->model("categoryModel");
    $data['categories'] = $categoryModel->selectAll('categories');
    $this->load->view("Admin/Category/categoriesList", $data);
}

}
?>

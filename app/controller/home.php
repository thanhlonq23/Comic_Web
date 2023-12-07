<?php
include_once('./app/controller/webtoon.php');
include_once('./app/controller/chapter.php');
include_once('./app/controller/user.php');


class home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->homePage();
        // Session::checkSession();
    }


    // Trang chủ
    public function homePage()
    {
        $this->load->view("User/header");

        // Lấy ra truyện
        $webtoon = new webtoon();
        $data1 = $webtoon->recent_Webtoon();
        $data2 = $webtoon->recommended_Webtoon(8);
        $data = array_merge_recursive($data1, $data2);

        // Hiển thị
        $this->load->view("User/HomePage/page", $data);
        $this->load->view("User/footer");
    }


    // Trang 404
    public function notFound()
    {
        $this->load->view("404");
    }

    // Tìm kiếm
    public function search()
    {
        $this->load->view("User/header");

        $webtoon = new webtoon();
        $tuKhoa = $_POST['tukhoa'];
        $webtoon->search_Webtoon($tuKhoa);

        $this->load->view("User/footer");
    }


    public function profile()
    {
        $this->load->view("User/header");

        $user = new user();
        $id = Session::get("id");
        $data = $user->get_User($id);

        $this->load->view("User/Profile/profile", $data);
        $this->load->view("User/footer");
    }
}

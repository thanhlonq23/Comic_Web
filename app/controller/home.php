<?php
include_once('./app/controller/webtoon.php');
include_once('./app/controller/chapter.php');

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
}

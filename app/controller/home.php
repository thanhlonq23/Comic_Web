<?php
include_once('./app/controller/webtoon.php');
include_once('./app/controller/chapter.php');

class home extends Controller
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->homePage();
        Session::checkSession();
    }

    public function homePage()
    {
        $this->load->view("User/header");

        // Lấy ra truyện
        $data1 = $this->recent_Comic();
        $data2 = $this->recommended_Comic();
        $data = array_merge_recursive($data1, $data2);

        $this->load->view("User/HomePage/page", $data);
        $this->load->view("User/footer");
    }

    public function notFound()
    {
        $this->load->view("404");
    }

    public function recommended_Comic()
    {
        $webtoon = new webtoon();
        $data = $webtoon->recommended_Webtoon(8);
        return $data;
    }

    public function recent_Comic()
    {
        $webtoon = new webtoon();
        $data = $webtoon->recent_Webtoon();
        return $data;
    }
}

<?php
include_once('./app/controller/webtoon.php');
include_once('./app/controller/chapter.php');

class comicPage extends Controller
{
    public function __construct()
    {
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
        $data = $this->getData();
        $this->load->view("User/Comic/comicPage", $data);
        $this->load->view("User/footer");
    }





    //================================================Các hàm xử lý=================================================//





    private function getData()
    {
        $id = $_GET['id'];
        $cond1 = "id = '$id'";
        $cond2 = "webtoon_id = '$id'";

        $webtoon = new webtoon();
        $chapter = new chapter();

        $data1 = $webtoon->getByCond($cond1);
        $data2 = $chapter->getByCond($cond2);
        $data = array_merge_recursive($data1, $data2);
        return $data;
    }
}

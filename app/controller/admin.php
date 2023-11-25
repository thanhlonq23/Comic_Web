<?php
include_once('./app/controller/webtoon.php');
include_once('./app/controller/chapter.php');

class admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Session::checkSession();
        $this->checkRole();
    }
    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $webtoon = new webtoon();
        $data = $webtoon->recent_Webtoon();

        $this->load->view("Admin/nav");
        $this->load->view("Admin/dashboard", $data);
    }


    public static function checkRole()
    {
        if (Session::get('role') != 'admin') {
            echo "<h1>Bạn không có quyền truy cập trang admin</h1>";
            exit();
        }
    }

    public function info()
    {
        $id = $_GET['id'];
        $webtoon = new webtoon();
        $chapter = new chapter();

        $this->load->view("Admin/nav");
        $webtoon->webtoon_Main();
        $chapter->chapter_Main($id);
    }

    public function comic_List()
    {
        $this->load->view("Admin/nav");
        $webtoon = new webtoon();
        $webtoon->list_Webtoon();
    }
}

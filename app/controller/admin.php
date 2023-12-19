<?php
include_once('./app/controller/webtoon.php');
include_once('./app/controller/chapter.php');
include_once('./app/controller/user.php');
include_once('./app/controller/author.php');
include_once('./app/controller/category.php');



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


    // Kiểm tra quyền
    public static function checkRole()
    {
        if (Session::get('role') != 'admin') {
            echo "<h1>Bạn không có quyền truy cập trang admin</h1>";
            exit();
        }
    }


    // Trang chủ admin
    public function dashboard()
    {
        $user = new user();
        $webtoon = new webtoon();
        $chapter = new chapter();

        $data1 = $webtoon->recentComics(4);
        $data2 = $webtoon->countWebtoons();
        $data3 = $user->countUsers();
        $data4 = $chapter->sumViewsChapter();

        $data = array_merge_recursive(array_merge_recursive($data1, $data2), array_merge_recursive($data3, $data4));

        $this->load->view("Admin/nav");
        $this->load->view("Admin/dashboard", $data);
    }


    // Mục thông tin truyện
    public function info()
    {
        $id = $_GET['id'];
        $webtoon = new webtoon();
        $chapter = new chapter();

        $this->load->view("Admin/nav");
        $webtoon->webtoon_Main();
        $chapter->chapter_Main($id);
    }


    // Mục danh sách truyện
    public function comic_List()
    {
        $this->load->view("Admin/nav");
        $webtoon = new webtoon();
        $webtoon->list_Webtoon();
    }

    public function users_List()
    {
        $this->load->view("Admin/nav");
        $user = new user();
        $user->list_User();
    }

    public function authors_List()
    {
        $this->load->view("Admin/nav");
        $author = new author();
        $author->list_Author();
    }
    public function category_List()
    {
        $this->load->view("Admin/nav");
        $category = new category();
        $category->list_Category();
    }
}

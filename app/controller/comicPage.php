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

        // Lấy ra dữ liệu webtoon
        $data = $this->getData();

        // Hiển thị
        $this->load->view("User/Comic/comicPage", $data);
        $this->load->view("User/footer");
    }

    public function readPage($webtoon_ID)
    {
        $chapter_ID = $_GET['chapter'];

        // Lấy ra mảng gồm đường dẫn và các img
        $data = $this->getImg($webtoon_ID, $chapter_ID);

        // Hiển thị
        $this->load->view("User/header");
        $this->load->view("User/Comic/readPage", $data);
        $this->load->view("User/footer");
    }





    //================================================Các hàm xử lý=================================================//





    private function getData()
    {
        $id = $_GET['id'];
        $cond1 = "id = '$id'";
        $cond2 = "webtoon_id = '$id' ORDER BY name";

        $webtoon = new webtoon();
        $chapter = new chapter();

        $data1 = $webtoon->getByCond($cond1);
        $data2 = $chapter->getByCond($cond2);
        $data = array_merge_recursive($data1, $data2);
        return $data;
    }

    private function getImg($webtoonId, $chapterID)
    {
        $folderPath = "./public/Uploads/Comic/$webtoonId/$chapterID"; // Đường dẫn đến thư mục chứa ảnh

        $dir['dir'] = [
            'folderPath' => $folderPath
        ];

        // Lấy danh sách tất cả các file trong thư mục
        $files['files'] = scandir($folderPath);

        return array_merge_recursive($files, $dir);
    }
}

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
    }


    // Trang thông tin truyện
    public function homePage()
    {
        $this->load->view("User/header");
        Session::checkSession();

        // Lấy ra dữ liệu webtoon
        $data = $this->getData();

        // Hiển thị
        $this->load->view("User/Comic/comicPage", $data);
        $this->load->view("User/footer");
    }



    // Trang đọc truyện
    public function readPage($webtoon_ID)
    {
        $this->load->view("User/header");
        $chapter_ID = $_GET['chapter'];

        // Lấy ra mảng gồm đường dẫn và các img
        $data1 = $this->getImg($webtoon_ID, $chapter_ID);
        $data2 = $this->switchChapter($chapter_ID, $webtoon_ID);

        // Gôp dữ liệu
        if ($data2 != null) {
            $data = array_merge_recursive($data1, $data2);
        } else {
            $data = $data1;
        }


        // Hiển thị
        Session::checkSession();
        $this->load->view("User/Comic/readPage", $data);
        $this->load->view("User/footer");
    }





    //================================================Các hàm xử lý=================================================//






    // Xử lý lấy dữ liệu webtoon
    private function getData()
    {
        // Lấy webtoon_id và tạo điều kiện
        $id = $_GET['id'];
        $cond1 = "id = '$id'";
        $cond2 = "webtoon_id = '$id' ORDER BY name"; //gọi và sx theo tên

        // Khởi tạo controller
        $webtoon = new webtoon();
        $chapter = new chapter();

        // Lấy dữ liệu truyện
        $data1 = $webtoon->getByCond($cond1);
        $data2 = $chapter->getByCond($cond2);

        // Gộp dữ liệu
        $data = array_merge_recursive($data1, $data2);

        return $data;
    }



    // Xử lý lấy ra ảnh trong thư mục chapter
    private function getImg($webtoonId, $chapterID)
    {
        // Đường dẫn đến thư mục chứa ảnh
        $folderPath = "./public/Uploads/Comic/$webtoonId/$chapterID";

        $dir['dir'] = [
            'folderPath' => $folderPath
        ];

        // Lấy danh sách tất cả các file trong thư mục
        $files['files'] = scandir($folderPath);

        return array_merge_recursive($files, $dir);
    }


    // Xử lý lấy chuyển chapter
    private function switchChapter($chapter_ID, $Webtoon_ID)
    {
        $chapter = new chapter();
        $data2 = null;
        $data3 = null;

        // Xử lý lấy tất cả chapter
        $data1 = $chapter->getChapter($Webtoon_ID);

        // Xử lý lấy chapter trước/sau
        if (isset($chapter->nextChapter($chapter_ID, $Webtoon_ID)['chapters'][0]))
            $data2['nextChapter'] = $chapter->nextChapter($chapter_ID, $Webtoon_ID)['chapters'][0];

        if (isset($chapter->previousChapter($chapter_ID, $Webtoon_ID)['chapters'][0]))
            $data3['previousChapter'] = $chapter->previousChapter($chapter_ID, $Webtoon_ID)['chapters'][0];

        // Gán dữ liệu
        if ($data2 == null) {
            $data = $data3;
        } else  if ($data3 == null) {
            $data = $data2;
        } else {
            $data = array_merge_recursive($data2, $data3);
        }

        // Gộp dữ liệu
        if ($data != null) {
            $data = array_merge_recursive($data, $data1);
        } else {
            $data = $data1;
        }

        return $data;
    }
}

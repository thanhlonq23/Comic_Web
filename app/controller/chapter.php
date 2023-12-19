<?php
class chapter extends Controller
{
    private $table = 'chapters';

    public function __construct()
    {
        // Session::checkSession();
        parent::__construct();
    }
    public function index()
    {
        $this->list_Chapter();
    }


    // Thông tin chapter
    public function chapter_Main($id)
    {
        $cond = "webtoon_id = '$id' ORDER BY name";
        $chapterModel = $this->load->model("chapterModel");

        $data['chapters'] = $chapterModel->selectByCond($this->table, $cond);
        $this->load->view("Admin/Chapter/chapter", $data);
    }


    // Danh sách chapter
    public function list_Chapter()
    {
        $chapterModel = $this->load->model("chapterModel");
        $data['chapters'] = $chapterModel->selectAll($this->table);
        $this->load->view("Admin/Chapter/chapter", $data);
    }


    // Hiện trang thêm chapter
    public function add_Chapter()
    {
        include_once('./app/controller/webtoon.php');
        $webtoon = new webtoon();
        $data = $webtoon->get_Webtoon();
        $this->load->view("Admin/nav");
        $this->load->view("Admin/chapter/addChapter", $data);
    }


    // Hiện trang sửa chapter
    public function edit_Chapter($id)
    {
        $cond = "id = '$id'";
        $chapterModel = $this->load->model("chapterModel");
        $data['chapterByID'] = $chapterModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/nav");
        $this->load->view("Admin/Chapter/editChapter", $data);
    }


    // Xóa chapter
    public function delete_Chapter($id)
    {
        $cond = "id = '$id'";
        $chapterModel = $this->load->model('chapterModel');

        // Tên chapter
        $dir = $id;

        // Xử lý lấy tên webtoon
        $getChapter = $chapterModel->selectByCond($this->table, $cond);
        $webtoonDir = $getChapter[0]['webtoon_id'];

        $this->delete($webtoonDir, $dir);
        $chapterModel->delete($this->table, $cond);
        header("Location:" . BASE_URL . "/?url=admin/info/&id=$webtoonDir");
    }



    // Next chapter
    public function nextChapter($chapter_ID, $WebtoonID)
    {
        // Xử lý lấy chapter hiện tại
        $cond = "webtoon_id = '$WebtoonID' AND id = '$chapter_ID'";
        $currentChapter = $this->getByCond($cond);
        $chapterName = $currentChapter['chapters'][0]['name'];


        // Tạo điều kiện mới để lấy next chapter
        $cond = "webtoon_id = '$WebtoonID' AND name >'" . $chapterName
            . "' ORDER BY name ASC LIMIT 1";

        $result = $this->getByCond($cond);

        return $result;
    }



    // Previous chapter
    public function previousChapter($chapter_ID, $WebtoonID)
    {
        // Xử lý lấy chapter hiện tại
        $cond = "webtoon_id = '$WebtoonID' AND id = '$chapter_ID'";
        $currentChapter = $this->getByCond($cond);
        $chapterName = $currentChapter['chapters'][0]['name'];


        // Tạo điều kiện mới để lấy previous chapter
        $cond = "webtoon_id = '$WebtoonID' AND name <'" . $chapterName
            . "' ORDER BY name DESC LIMIT 1";

        $result = $this->getByCond($cond);

        return $result;
    }





    //=======================================================Các hàm xử lý========================================================//


    public function add()
    {
        $id = $this->getid();
        $name = $_POST['name'];
        $webtoon_id = $_POST['webtoon_id'];

        $data = [
            'id' => $id,
            'webtoon_id' => $webtoon_id,
            'name' => $name
        ];

        // Thư mục upload = id
        $dir = $id;

        // Xử lý thêm vào db
        $chapterModel = $this->load->model("chapterModel");
        $result = $chapterModel->insert($this->table, $data);

        if (($result != 0) && $this->upload($webtoon_id, $dir)) {
            $message['msg'] = "Thêm chapter thành công";
            header("Location:" . BASE_URL . "/?url=chapter/add_Chapter/&id=$webtoon_id/&msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Thêm chapter thất bại";
            header("Location:" . BASE_URL . "/?url=chapter/add_Chapter/&id=$webtoon_id/&msg=" . urlencode(serialize($message)));
        }
    }

    // Lấy ra dữ liệu tất cả chapter
    public function getChapter($WebtoonID)
    {
        $cond = "webtoon_id = '$WebtoonID' ORDER BY name ASC";
        $chapterModel = $this->load->model("chapterModel");
        $data['chapters'] = $chapterModel->selectByCond($this->table, $cond);
        return $data;
    }


    // Lấy ra dữ liệu chapter dựa trên điều kiện
    public function getByCond($cond)
    {
        $chapterModel = $this->load->model("chapterModel");
        $data['chapters'] = $chapterModel->selectByCond($this->table, $cond);
        return $data;
    }


    // Xử lý sửa chapter
    public function edit($id)
    {
        $cond = "id = '$id'";
        $data = [
            'name' => $_POST['name'],
            'status' => $_POST['status']
        ];

        $chapterModel = $this->load->model("chapterModel");
        $result = $chapterModel->update($this->table, $data, $cond);

        if ($result != 0) {
            $message['msg'] = "Cập nhật chapter thành công";
            header("Location:" . BASE_URL . "/?url=chapter/edit_Chapter/" . $id . "/&msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật chapter thất bại";
            header("Location:" . BASE_URL . "/?url=chapter/edit_Chapter/" . $id . "/&msg=" . urlencode(serialize($message)));
        }
    }




    // Lưu chapter vào thư mục
    private function upload($webtoonDir, $dir)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Đường dẫn đến thư mục lưu trữ tập tin đã tải lên
            $targetDir = "public/Uploads/Comic/" . $webtoonDir . "/" . $dir . "/";

            // Kiểm tra xem thư mục đã tồn tại hay chưa
            if (!is_dir($targetDir)) {
                // Nếu chưa, tạo thư mục
                mkdir($targetDir, 0755, true);
            }

            $uploadedFiles = [];

            foreach ($_FILES["images"]["name"] as $key => $name) {
                $targetFile = $targetDir . basename($name);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Kiểm tra nếu là file ảnh thì mới cho phép upload
                if (getimagesize($_FILES["images"]["tmp_name"][$key])) {
                    if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFile)) {
                        $uploadedFiles[] = $targetFile;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            return true;
        }
    }


    // Xóa thư mục ảnh chapter
    private function delete($webtoonDir, $dir)
    {
        function rmdir_recursive($dirPath)
        {
            foreach (scandir($dirPath) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
                $path = $dirPath . '/' . $item;
                if (is_dir($path)) {
                    rmdir_recursive($path);
                } else {
                    unlink($path);
                }
            }
            rmdir($dirPath);
        }

        // Sử dụng hàm để xóa thư mục
        $dirPath = "public/Uploads/Comic/" . $webtoonDir . "/" . $dir;
        // echo $dirPath;
        rmdir_recursive($dirPath);
    }

    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 3; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'chapter' . $randomID;
    }


    public function increaseViews($webtoon_ID, $chapter_ID)
    {

        $cond = "webtoon_id = '$webtoon_ID' AND id = '$chapter_ID'";
        $chapterModel = $this->load->model("chapterModel");
        // Tìm chương có webtoon_id và id tương ứng
        $chapter = $chapterModel->selectByCond($this->table, $cond);

        if ($chapter) {
            // Lấy số lượt views hiện tại
            $currentViews = $chapter[0]['views'];

            // Tăng số lượt views
            $newViews = $currentViews + 1;

            // Cập nhật số lượt views mới
            $data = array('views' => $newViews);
            $condition = "id = '$chapter_ID'";
            return $chapterModel->update($this->table, $data, $condition);
        }

        return false; // Trả về false nếu không tìm thấy chương
    }
}

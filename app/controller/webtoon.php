<?php
class webtoon extends Controller
{
    private $table = 'webtoons';
    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }


    public function index()
    {
        $this->list_Webtoon();
    }

    public function webtoon_Main()
    {
        $id = $_GET['id'];
        $cond = "id = '$id'";
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->selectByCond($this->table, $cond);
        $this->load->view("Admin/Webtoon/webtoon", $data);
    }

    public function list_Webtoon()
    {
        $data = $this->list();
        $this->load->view("Admin/Webtoon/comicslist", $data);
    }


    public function add_Webtoon()
    {
        $this->load->view("Admin/nav");
        $this->load->view("Admin/webtoon/addWebtoon");
    }


    public function delete_Webtoon($id)
    {
        // Tên file là id
        $file = $id;

        // Điều kiện
        $cond = "id = '$id'";

        // Lấy tên bìa
        $webtoonModel = $this->load->model('webtoonModel');
        $getCover = $webtoonModel->selectByCond($this->table, $cond);
        $cover = $getCover[0]['cover'];

        // Xóa được thư mục,bìa thành công mới đến xóa trong db
        if ($this->deleteDir($file) && $this->deleteFile($cover)) {
            try {
                $webtoonModel->delete($this->table, $cond);
            } catch (Exception  $th) {
                $message['msg'] = "Xóa không thành công<br> Vui lòng kiểm tra lại";
                header("Location:" . BASE_URL . "/?url=admin/comic_List/&msg=" . urlencode(serialize($message)));
                exit;
            }
            header("Location:" . BASE_URL . "/?url=admin/comic_List");
        } else {
            $message['msg'] = "Xóa không thành công<br> Vui lòng kiểm tra lại11";
            header("Location:" . BASE_URL . "/?url=admin/comic_List/&msg=" . urlencode(serialize($message)));
        }
    }


    public function edit_Webtoon($id)
    {
        $cond = "id = '$id'";
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoonByID'] = $webtoonModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/nav");
        $this->load->view("Admin/Webtoon/editWebtoon", $data);
    }





    //==================================================================Các hàm xử lý==================================================================//





    public function add()
    {
        $id = $this->getid();
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Tên thư mục chứa chapter = id
        $newDir = $id;

        // Xử lý tạo tên bìa
        $uploadedFileName = $_FILES["cover"]["name"];
        $fileName = uniqid() . "_" . $uploadedFileName;

        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'cover' => $fileName
        ];

        // Không lưu được ảnh/ không tạo được thư mục => k lưu vào db
        if ($this->upload($fileName) && $this->createDir($newDir)) {
            // Thực hiện truy vấn db
            $webtoonModel = $this->load->model("webtoonModel");
            $result = $webtoonModel->insert($this->table, $data);

            if ($result != 0) {
                $message['msg'] = "Thêm truyện thành công";
                header("Location:" . BASE_URL . "/?url=webtoon/add_Webtoon/&msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Thêm truyện thất bại";
                header("Location:" . BASE_URL . "/?url=webtoon/add_Webtoon/&msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Thêm truyện thất bại";
            header("Location:" . BASE_URL . "/?url=webtoon/add_Webtoon/&msg=" . urlencode(serialize($message)));
        }
    }


    public function list()
    {
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->selectAll($this->table);
        return $data;
    }


    // Cập nhật
    public function edit($id)
    {
        // Lấy tên ảnh bìa
        $uploadedFileName = $_FILES["cover"]["name"];

        // Tạo tên duy nhất
        $fileName = uniqid() . "_" . $uploadedFileName;

        $cond = "id = '$id'";
        $data = [
            'name' => $_POST['name'],
            'cover' => $fileName,
            'status' => $_POST['status'],
            'description' => $_POST['description']
        ];

        $webtoonModel = $this->load->model("webtoonModel");
        $getCover = $webtoonModel->selectByCond($this->table, $cond);
        $filePath = "public/Uploads/Cover/Webtoon/" . $getCover[0]['cover'];

        if (file_exists($filePath)) {
            $result = $webtoonModel->update($this->table, $data, $cond);

            if ($result != 0) {
                unlink($filePath);
                $this->upload($fileName);

                $message['msg'] = "Cập nhật truyện thành công";
                header("Location:" . BASE_URL . "/?url=webtoon/edit_Webtoon/$id/&msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Cập nhật truyện thất bại";
                header("Location:" . BASE_URL . "/?url=webtoon/edit_Webtoon/$id/&msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Cập nhật truyện thất bại";
            header("Location:" . BASE_URL . "/?url=webtoon/edit_Webtoon/$id/&msg=" . urlencode(serialize($message)));
        }
    }


    // Lưu ảnh
    private function upload($fileName)
    {
        $path_uploads = "public/Uploads/Cover/Webtoon/";
        $target_file = $path_uploads . basename($fileName);

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            return true;
        } else {
            return false;
        }
    }

    // Tạo id
    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 3; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'webtoon' . $randomID;
    }

    // Tạo thư mục chứa ảnh
    private function createDir($newDir)
    {
        $dirPath = "public/Uploads/Comic";
        $path = $dirPath . '/' . $newDir;

        if (!is_dir($path)) {
            mkDir($path);
            return true;
        } else {
            return false;
        }
    }


    // Xử lý xóa
    private function deleteDir($dir)
    {
        $dirPath = "public/Uploads/Comic/" . $dir;

        if (is_dir($dirPath)) {
            return rmdir($dirPath);
        }
        return false;
    }
    private function deleteFile($cover)
    {
        $filePath = "public/Uploads/Cover/Webtoon/" . $cover;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }


    // Lấy ra id và tên
    public function get_Webtoon()
    {
        $collum = 'id,name';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->select($collum, $this->table);
        return $data;
    }

    public function getByCond($cond)
    {
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->selectByCond($this->table, $cond);
        return $data;
    }



    // Lấy ra truyện
    public function recent_Webtoon()
    {
        $cond = "1=1 ORDER BY date DESC";
        $collum = 'id,name,status,cover,date';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['recent_Webtoon'] = $webtoonModel->selectCollum($this->table, $collum, $cond);
        return $data;
    }

    public function recommended_Webtoon($number)
    {
        $cond = "1=1 ORDER BY date DESC LIMIT $number";
        $collum = 'id,name,status,cover,date';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['recommended_Webtoon'] = $webtoonModel->selectCollum($this->table, $collum, $cond);
        return $data;
    }
}

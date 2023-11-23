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

    public function list_Webtoon()
    {
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->selectAll($this->table);
        $this->load->view("Admin/header");
        $this->load->view("Admin/Webtoon/listWebtoon", $data);
        // $this->load->view("Admin/footer");
    }

    public function add_Webtoon()
    {
        $this->load->view("Admin/header");
        $this->load->view("Admin/webtoon/addWebtoon");
    }

    public function add()
    {
        $id = $this->getid();
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Lấy tên ảnh bìa
        $uploadedFileName = $_FILES["cover"]["name"];

        // Tạo tên duy nhất 
        $fileName = uniqid() . "_" . $uploadedFileName;

        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'cover' => $fileName
        ];

        // Không lưu được ảnh => Không lưu vào db
        if ($this->upload($fileName)) {
            // Thực hiện truy vấn db
            $webtoonModel = $this->load->model("webtoonModel");
            $result = $webtoonModel->insert($this->table, $data);

            if ($result != 0) {
                $message['msg'] = "Thêm truyện thành công";
                header("Location:" . BASE_URL . "/webtoon/add_Webtoon?msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Thêm truyện thất bại";
                header("Location:" . BASE_URL . "/webtoon/add_Webtoon?msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Thêm truyện thất bại";
            header("Location:" . BASE_URL . "/webtoon/add_Webtoon?msg=" . urlencode(serialize($message)));
        }
    }

    public function delete_Webtoon($id)
    {
        $cond = "id = '$id'";
        $webtoonModel = $this->load->model('webtoonModel');
        try {
            $webtoonModel->delete($this->table, $cond);
        } catch (Exception  $th) {
            $message['msg'] = "Xóa không thành công<br> Vui lòng kiểm tra Chapter";
            header("Location:" . BASE_URL . "/webtoon/list_Webtoon?msg=" . urlencode(serialize($message)));
            exit;
        }
        header("Location:" . BASE_URL . "/webtoon/list_Webtoon");
    }

    public function edit_Webtoon($id)
    {
        $cond = "id = '$id'";
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoonByID'] = $webtoonModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/header");
        $this->load->view("Admin/Webtoon/editWebtoon", $data);
    }

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
                header("Location:" . BASE_URL . "/Webtoon/?msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Cập nhật truyện thất bại";
                header("Location:" . BASE_URL . "/Webtoon/?msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Cập nhật truyện thất bại";
            header("Location:" . BASE_URL . "/Webtoon/?msg=" . urlencode(serialize($message)));
        }
    }

    protected function selectByCond($cond)
    {
        $webtoonModel = $this->load->model("webtoonModel");
        // $data['webtoons'] = $webtoonModel->selectAll($this->table);
        $data = $webtoonModel->selectAll($this->table);
    }

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

    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 3; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'webtoon' . $randomID;
    }
}

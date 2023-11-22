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
        $data = [
            'id' => $this->getid(),
            'name' => $_POST['name'],
            'cover' => $_POST['cover'],
            'description' => $_POST['description']
        ];

        $webtoonModel = $this->load->model("webtoonModel");
        $result = $webtoonModel->insert($this->table, $data);
        if ($result != 0) {
            $message['msg'] = "Thêm truyện thành công";
            header("Location:" . BASE_URL . "/webtoon/add_Webtoon?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Thêm truyện thất bại";
            header("Location:" . BASE_URL . "/webtoon/add_Webtoon?msg=" . urlencode(serialize($message)));
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

    private function getFile()
    {
        $targetDir = './Alooooo/';
        $targetFile = $targetDir . basename($_SERVER['HTTP_X_FILE_NAME']);

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $incomingData = file_get_contents('php://input');

        if ($incomingData !== false) {
            file_put_contents($targetFile, $incomingData, FILE_APPEND);

            echo 'Chunk uploaded successfully!';
        } else {
            echo 'Error receiving chunk data.';
        }
    }

    public function delete_Webtoon($id)
    {
        $cond = "id = '$id'";
        $webtoonModel = $this->load->model('webtoonModel');
        $webtoonModel->delete($this->table, $cond);
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
        $cond = "id = '$id'";
        $data = [
            'name' => $_POST['name'],
            'cover' => $_POST['cover'],
            'status' => $_POST['status'],
            'description' => $_POST['description']
        ];

        $webtoonModel = $this->load->model("webtoonModel");
        $result = $webtoonModel->update($this->table, $data, $cond);

        if ($result != 0) {
            $message['msg'] = "Cập nhật truyện thành công";
            header("Location:" . BASE_URL . "/Webtoon/?msg=" . urlencode(serialize($message)));
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
}

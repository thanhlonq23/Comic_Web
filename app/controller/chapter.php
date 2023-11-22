<?php
class chapter extends Controller
{
    private $table = 'chapters';
    private $webtoon;
    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }
    public function index()
    {
        $this->list_Chapter();
    }

    public function list_Chapter()
    {
        $chapterModel = $this->load->model("chapterModel");
        $data['chapters'] = $chapterModel->selectAll($this->table);
        $this->load->view("Admin/header");
        $this->load->view("Admin/Chapter/listChapter", $data);
        // $this->load->view("Admin/footer");
    }

    public function add_Chapter()
    {
        $data = $this->getWebtoon();
        $this->load->view("Admin/header");
        $this->load->view("Admin/chapter/addChapter", $data);
    }

    public function add()
    {
        $data = [
            'id' => $this->getid(),
            'webtoon_id' => $_POST['webtoon_id'],
            'name' => $_POST['name']
        ];

        $chapterModel = $this->load->model("chapterModel");
        $result = $chapterModel->insert($this->table, $data);
        if ($result != 0) {
            $message['msg'] = "Thêm chapter thành công";
            header("Location:" . BASE_URL . "/chapter/add_Chapter?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Thêm chapter thất bại";
            header("Location:" . BASE_URL . "/chapter/add_Chapter?msg=" . urlencode(serialize($message)));
        }
    }

    private function getWebtoon()
    {
        $table = 'webtoons';
        $collum = 'id,name';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->select($collum, $table);
        return $data;
    }
    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 4; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'chapter' . $randomID;
    }
    public function delete_Chapter($id)
    {
        $cond = "id = '$id'";
        $chapterModel = $this->load->model('chapterModel');
        $chapterModel->delete($this->table, $cond);
        header("Location:" . BASE_URL . "/Chapter/list_Chapter");
    }
    public function edit_Chapter($id)
    {
        $cond = "id = '$id'";
        $chapterModel = $this->load->model("chapterModel");
        $data['chapterByID'] = $chapterModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/header");
        $this->load->view("Admin/Chapter/editChapter", $data);
    }

    public function edit($id)
    {
        $cond = "id = '$id'";
        $data = [
            'name' => $_POST['name'],
            // 'cover' => $_POST['cover'],
            'status' => $_POST['status']
        ];

        $chapterModel = $this->load->model("chapterModel");
        $result = $chapterModel->update($this->table, $data, $cond);
        if ($result != 0) {
            $message['msg'] = "Cập nhật chapter thành công";
            header("Location:" . BASE_URL . "/Chapter/?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật chapter thất bại";
            header("Location:" . BASE_URL . "/Chapter/?msg=" . urlencode(serialize($message)));
        }
    }
}

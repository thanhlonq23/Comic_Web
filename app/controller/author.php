<?php
class author extends Controller
{
    private $table = "authors";
    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }
    public function index()
    {
        $this->list_Author();
    }

    public function list_Author()
    {
        $authorModel = $this->load->model("authorModel");
        $data['authors'] =  $authorModel->selectAll($this->table);

        $this->load->view("Admin/header");
        $this->load->view("Admin/author/listAuthor", $data);
        // $this->load->view("Admin/footer");

    }
    public function delete_Author($id)
    {
        $cond = "id = '$id'";
        $authorModel = $this->load->model('authorModel');
        $authorModel->delete($this->table, $cond);
        header("Location:" . BASE_URL . "/Author/list_Author");
    }

    public function add_Author()
    {
        $this->load->view("Admin/header");
        $this->load->view("Admin/author/addAuthor");
    }

    public function add()
    {
        $name = $_POST['name'];
        $data = [
            'id' => $this->getid(),
            'name' => $name
        ];

        $authorModel = $this->load->model("authorModel");
        $result = $authorModel->insert($this->table, $data);
        if ($result != 0) {
            $message['msg'] = "Thêm tác giả thành công";
            header("Location:" . BASE_URL . "/Author/add_Author?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Thêm tác giả thất bại";
            header("Location:" . BASE_URL . "/Author/add_Author?msg=" . urlencode(serialize($message)));
        }
    }

    public function edit_Author($id)
    {
        $cond = "id = '$id'";
        $authorModel = $this->load->model("authorModel");
        $data['authorByID'] = $authorModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/header");
        $this->load->view("Admin/author/editAuthor", $data);
    }

    public function edit($id)
    {
        $name = $_POST['name'];
        echo $name;
        $cond = "id = '$id'";
        $data = [
            'name' => $name
        ];

        $authorModel = $this->load->model("authorModel");
        $result = $authorModel->update($this->table, $data, $cond);
        if ($result != 0) {
            $message['msg'] = "Cập nhật tác giả thành công";
            header("Location:" . BASE_URL . "/Author/?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật tác giả thất bại";
            header("Location:" . BASE_URL . "/Author/?msg=" . urlencode(serialize($message)));
        }
    }

    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 4; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'author' . $randomID;
    }
}

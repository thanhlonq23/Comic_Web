<?php
class user extends Controller
{
    private $table = 'users';
    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }
    public function index()
    {
        $this->list_User();
    }

    public function list_User()
    {
        $userModel = $this->load->model("userModel");
        $data['users'] = $userModel->selectAll($this->table);
        $this->load->view("Admin/header");
        $this->load->view("Admin/User/listUser", $data);
    }
    public function delete_User($id)
    {
        $cond = "id = '$id'";
        $userModel = $this->load->model('userModel');
        $userModel->delete($this->table, $cond);
        header("Location:" . BASE_URL . "/?url=User/list_User");
    }
    public function edit_User($id)
    {
        $cond = "id = '$id'";
        $userModel = $this->load->model("userModel");
        $data['userByID'] = $userModel->selectByCond($this->table, $cond);

        $this->load->view("Admin/header");
        $this->load->view("Admin/User/editUser", $data);
    }

    public function edit($id)
    {
        $name = $_POST['name'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];

        $cond = "id = '$id'";
        $data = [
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'role' => $role,
            'password' => $password
        ];

        $userModel = $this->load->model("userModel");
        $result = $userModel->update($this->table, $data, $cond);
        if ($result != 0) {
            $message['msg'] = "Cập nhật người dùng thành công";
            header("Location:" . BASE_URL . "/?url=User/&msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật người dùng thất bại";
            header("Location:" . BASE_URL . "/?url=User/&msg=" . urlencode(serialize($message)));
        }
    }
}

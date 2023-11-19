<?php
// Trang chủ
class signup extends Controller
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("Auth/signup");
    }

    public function signup()
    {
        if ($this->checkPost()) {
            $username = $_POST['username'];
            $name = $_POST['name'];
            $password = md5($_POST['password']);
            $rePassword = md5($_POST['rePassword']);
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
        }

        $table = "users";
        $userModel = $this->load->model('userModel');
        $checkUser = $this->checkUsername($username, $userModel, $table);

        if (($password == $rePassword) && $checkUser) {
            $id =  $this->getid();
            $data = array(
                'id' => $id,
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'phoneNumber' => $phoneNumber
            );

            $result = $userModel->insert($table, $data);
            if ($result == true) {
                
                echo "Đăng kí thành công";
            } else {
                echo "Email không hợp lệ";
            }
        } else {
            echo "Tên đăng nhập hoặc mật khẩu không hợp lệ";
        }
    }

    private function checkUsername($username, $usersModel, $table)
    {
        $row = $usersModel->selectUser($table, $username);
        if ($row == 1) {
            return false;
        }
        return true;
    }

    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 6; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'user' . $randomID;
    }

    private function checkPost()
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rePassword']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['name'])) {
            return true;
        }
        return false;
    }
}

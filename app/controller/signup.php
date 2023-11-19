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
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rePassword = $_POST['rePassword'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        $checkPass = $this->checkPassword($password, $rePassword);
        $checkUser = $this->checkUsername($username);

        $table = "user";
        if ($checkPass && $checkUser) {
            $usersModel = $this->load->model('users');
            $usersModel->insert($table, $data);
        }
    }

    private function checkPassword($password, $rePassword)
    {
        if ($password != $rePassword) {
            return false;
        }
        return true;
    }

    private function checkUsername($username)
    {
        $usersModel = $this->load->model('users');
        $table = "user";
        $row = $usersModel->selectUser($table, $username);

        if ($row == 1) {
            return true;
        }
        return false;
    }
}

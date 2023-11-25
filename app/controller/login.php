<?php
// Trang chủ
class login extends Controller
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        Session::init();
        if (Session::get('login') == true) {
            header("Location:" . BASE_URL . "/?url=admin");
        }
        $this->load->view("auth/login");
    }

    public function auth_login()
    {
        $table_Admin = 'users';
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $loginModel = $this->load->model('loginModel');
        $row = $loginModel->login($table_Admin, $username, $password);

        if ($row == 1) {
            $result = $loginModel->getLogin($table_Admin, $username, $password);

            if ((strcasecmp($result[0]['username'], $username) == 0) && ($result[0]['password'] == $password) && ($result[0]['role'] == 'admin')) {
                Session::init();
                Session::set('login', true);
                Session::set('role', 'admin');
                header("Location:" . BASE_URL . "/?url=admin");
            } else {
                Session::init();
                Session::set('login', true);
                Session::set('role', 'user');
                header("Location:" . BASE_URL);
            }
        } else {
            header("Location:" . BASE_URL . "/?url=login");
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        header("Location:" . BASE_URL . "");
    }
}

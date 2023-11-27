<?php
// Trang chủ
class login extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->login();
    }


    // Trang đăng nhập
    public function login()
    {
        Session::init();
        if (Session::get('login') == true) {
            header("Location:" . BASE_URL . "/?url=admin");
        }
        $this->load->view("auth/login");
    }






    //=======================================================Các hàm xử lý========================================================//






    // Xác minh đăng nhập
    public function auth_login()
    {
        $table_Admin = 'users';
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $loginModel = $this->load->model('loginModel');

        // 2 Lớp
        // Kiểm tra xem có username username và password có đúng trong db không
        $row = $loginModel->login($table_Admin, $username, $password);

        if ($row != 0) {
            $result = $loginModel->getLogin($table_Admin, $username, $password);

            // Db so sánh k pb chữ hoa chữ thường
            // strcasecmp so sanh chuoi khong phan biet chu hoa chu thuong
            if ((strcasecmp($result[0]['username'], $username) == 0) && ($result[0]['password'] == $password) && ($result[0]['role'] == 'admin')) {
                Session::init();
                Session::set('login', true);
                Session::set('role', 'admin');
                header("Location:" . BASE_URL . "/?url=admin");
            } else if ((strcasecmp($result[0]['username'], $username) == 0) && ($result[0]['password'] == $password)) {
                Session::init();
                Session::set('login', true);
                Session::set('role', 'user');
                header("Location:" . BASE_URL);
            } else {
                $message['msg'] = "Đăng nhập thất bại";
                header("Location:" . BASE_URL . "/?url=login/&msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Đăng nhập thất bại";
            header("Location:" . BASE_URL . "/?url=login/&msg=" . urlencode(serialize($message)));
        }
    }


    // Đăng xuất
    public function logout()
    {
        Session::init();
        Session::destroy();
        header("Location:" . BASE_URL . "");
    }
}

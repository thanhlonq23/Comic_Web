<?php
// Trang chủ
class signup extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("Auth/signup");
    }


    // Trang đăng kí
    public function signup()
    {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = md5($_POST['password']);
        $rePassword = md5($_POST['rePassword']);
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        $table = "users";
        $userModel = $this->load->model('userModel');

        // Kiểm tra xem có bị trùng username trong db không
        $checkUser = $this->checkUsername($username, $userModel, $table);

        if (($password == $rePassword) && $checkUser) {
            $data = array(
                'id' => $this->getid(),
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
                // Email được để duy nhất không db
                echo "Email không hợp lệ";
            }
        } else {
            echo "Tên đăng nhập hoặc mật khẩu không hợp lệ";
        }
    }





    //=======================================================Các hàm xử lý========================================================//





    // Kiểm tra username có trùng trong db không
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
}

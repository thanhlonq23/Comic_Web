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
                // echo "Đăng kí thành công";
?>
                <script>
                    Swal.fire({
                        title: 'Đăng ký tài khoản thành công!',
                        text: 'Chọn Done để Đăng nhập',
                        icon: 'success',
                        confirmButtonColor: '#4CAF50',
                        confirmButtonText: 'Done',
                        allowOutsideClick: false, //Không được phép click ra ngoài popup
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?php echo BASE_URL ?>?url=login';
                        }
                    });
                </script>
            <?php
            } else {
                // Email được để duy nhất trong db
                echo "Email không hợp lệ";
            }
        } else {
            // echo "Tên đăng nhập hoặc mật khẩu không hợp lệ";
            ?>
            <script>
                Swal.fire({
                    title: 'Đăng ký tài khoản thất bại!',
                    text: 'Kiểm tra lại thông tin đăng ký',
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Check',
                    allowOutsideClick: false, //Không được phép click ra ngoài popup
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?php echo BASE_URL ?>?url=signup';
                    }
                });
            </script>
<?php
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

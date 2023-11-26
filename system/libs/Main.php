<?php
class Main
{
    public $url;
    public $controllerName = "home";
    public $methodName = "index";
    public $controllerPath = "./app/controller/";
    public $controller;

    public function __construct()
    {
        $this->getURL();
        if ($this->loadController() == true) {
            $this->callMethod();
        }
    }

    /*
        http://localhost/Comic_Web/?url=author/edit_Author/12

        Cắt chuỗi ra $url = [
            '0'=> author,
            '1'=> edit_Author,
            '2'=> 12
        ]

    */




    // Lấy ra url
    public function getURL()
    {
        // GET url
        $this->url = (isset($_GET['url'])) ? $_GET['url'] : null;

        // Nếu url không rỗng thì thực hiện cắt các thành phần để xử lý
        if ($this->url != null) {
            $this->url = rtrim($this->url, '/');
            $this->url  = explode('/', filter_var($this->url, FILTER_SANITIZE_URL)); // Lúc này $url = mảng liên tục
        } else {
            // Nếu url là null thì xóa biến url
            unset($this->url);
        }
    }


    // Phân tích url để gọi ra lớp controller
    public function loadController()
    {
        $status = true;

        // Xét mảng url[0] nếu không có giá trị thì thực hiện gọi giá trị mặc định được khai báo ở trên
        if (!isset($this->url[0])) {
            include $this->controllerPath . $this->controllerName . '.php';
            $this->controller = new $this->controllerName();
        } else {
            // Ngược lại nếu tồn tại thì gán url[0] cho biến controllerName
            $this->controllerName = $this->url[0];

            // Tạo đường dẫn đến lớp controller
            $fileName = $this->controllerPath . $this->controllerName . '.php';

            // Kiểm tra nếu tồn tại lớp controller đó thì gọi lên
            if (file_exists($fileName)) {
                include_once($fileName);
                $this->controller = new $this->controllerName();
            } else {
                $status = false;
                header("Location: " . BASE_URL . "/home/notFound");
            }
        }
        return $status;
    }


<<<<<<< HEAD
    // Phân tích url để gọi ra method trong lớp controller
=======
>>>>>>> fd09e1a (upload final main)
    // Phân tích url để gọi ra phương thức trong lớp controller
    public function callMethod()
    {
        // Nếu tồn tại url[2] => Tồn tại tham số => Tồn tại url[1] => Tồn tại phương thức
        if (isset($this->url[2])) {
            // Nếu đã tồn tại url[2] thì url[1] chắc chắn tồn tại => gán method = url[1]
            $this->methodName = $this->url[1];

            if (method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}($this->url[2]);
            } else {
                header("Location: " . BASE_URL . "/home/notFound");
            }
        } else {
            // Không tồn tại url[2] thì xét tiếp url[1]
            if (isset($this->url[1])) {
                $this->methodName = $this->url[1];

                // Nếu tồn tại method trong lớp controller thì gọi lên
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: " . BASE_URL . "/home/notFound");
                }
            } else {
                // Nếu không tồn tại url[1] thì gọi phương thức mặc định đã được khai báo
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: " . BASE_URL . "/home/notFound");
                }
            }
        }
    }
}

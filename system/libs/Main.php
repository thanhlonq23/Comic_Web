<?php
class Main
{
    public $url;
    public $controllerName = "index";
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

    public function getURL()
    {
        // GET url
        $this->url = (isset($_GET['url'])) ? $_GET['url'] : null;

        if ($this->url != null) {
            $this->url = rtrim($this->url, '/');
            // explode : Cắt chuỗi thành mảng liên kết
            $this->url  = explode('/', filter_var($this->url, FILTER_SANITIZE_URL)); // Lúc này $url = mảng lk
        } else {
            unset($this->url);
        }
    }

    public function loadController()
    {
        $status = true;
        if (!isset($this->url[0])) {
            include $this->controllerPath . $this->controllerName . '.php';
            $this->controller = new $this->controllerName();
        } else {
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath . $this->controllerName . '.php';

            if (file_exists($fileName)) {
                include $fileName;
                $this->controller = new $this->controllerName();
            } else {
                $status = false;
                header("Location: " . BASE_URL . "/index/notFound");
            }
        }
        return $status;
    }

    public function callMethod()
    {
        if (isset($this->url[2])) {
            $this->methodName = $this->url[1];

            if (method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}($this->url[2]);
            } else {
                header("Location: " . BASE_URL . "/index/notFound");
            }
        } else {
            if (isset($this->url[1])) {
                $this->methodName = $this->url[1];

                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: " . BASE_URL . "/index/notFound");
                }
            } else {
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: " . BASE_URL . "/index/notFound");
                }
            }
        }
    }
}

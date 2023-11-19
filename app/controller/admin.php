<?php
class admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Session::checkSession();
    }
    public function index()
    {
        $this->adminPage();
    }
    public function adminPage()
    {
        $this->checkRole();
        $this->load->view("Admin/header");
        $this->load->view("Admin/page");
        $this->load->view("Admin/footer");
    }

    public function checkRole()
    {
        if (Session::get('role') != 'admin') {
            echo "Bạn không có quyền truy cập trang admin";
            exit();
        }
    }
}

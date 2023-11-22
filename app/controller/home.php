<?php
// Trang chủ
class home extends Controller
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("User/HomePage/header");
        $this->load->view("User/HomePage/page");
        $this->load->view("User/HomePage/footer");
    }

    public function notFound()
    {
        $this->load->view("404");
    }
}

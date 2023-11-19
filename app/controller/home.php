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
        $this->load->view("HomePage/header");
        $this->load->view("HomePage/page");
        $this->load->view("HomePage/footer");
    }

    public function notFound()
    {
        $this->load->view("404");
    }
}

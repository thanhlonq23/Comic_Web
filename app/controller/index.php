<?php
// Trang chủ
class index extends DController
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function index()
    {
        $this->homePage();
    }

    public function homePage()
    {
        $this->load->view("header");
        $this->load->view("home");
        $this->load->view("footer");
    }

    public function notFound()
    {
        $this->load->view("header");
        $this->load->view("404");
        $this->load->view("footer");
    }
}

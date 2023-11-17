<?php
// Trang chủ
class login extends DController
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
        $this->load->view("header");
        $this->load->view("home");
        $this->load->view("footer");
    }


}

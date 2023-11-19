<?php
class user extends Controller
{
    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }
    public function index()
    {
        $this->user();
    }
    public function user()
    {
        $this->load->view("Admin/header");
        $this->load->view("Admin/page");
        $this->load->view("Admin/footer");
    }

    public function listUser()
    {
        $this->load->view("Admin/header");
        $this->load->view("Admin/page");
        $this->load->view("Admin/footer");
    }
}

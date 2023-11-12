<?php
class index extends DController
{
    public function __construct()
    {
        $data = array();
        parent::__construct();
    }

    public function homePage()
    {
        $this->Load->view("header");
        $homeModel = $this->Load->model("HomeModel");
        $data['category'] = $homeModel->category();
        $this->Load->view("home", $data);
        $this->Load->view("footer");
    }
}

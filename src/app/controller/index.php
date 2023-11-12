<?php
class index extends DController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function homePage()
    {
        $this->Load->view("header");
        $this->Load->view("home");
        $this->Load->model("Home");
        $this->Load->view("footer");
    }
}

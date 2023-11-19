<?php
class Controller
{
    protected $load = array();

    public function __construct()
    {
        $this->load = new Load();
    }
}

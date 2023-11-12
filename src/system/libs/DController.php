<?php
class DController
{
    protected $Load;
    // protected $Load = array();

    public function __construct()
    {
        $this->Load = new Load();
    }
}

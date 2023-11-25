<?php
class Load
{
    public function __construct()
    {
    }

    public function view($fileName, $data = null)
    {
        if ($data != null) {
            extract($data);
        }
        include_once 'app/views/' . $fileName . '.php';
    }

    public function model($fileName)
    {
        include_once 'app/models/' . $fileName . '.php';
        return new $fileName();
    }
}

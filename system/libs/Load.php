<?php
class Load
{
    public function __construct()
    {
    }

    public function view($fileName, $data = null)
    {
        // Kiểm tra có truyển data không thì 
        if ($data != null) {
            // Phân tách mảng ra thành các biến
            extract($data);
        }
        include_once 'app/views/' . $fileName . '.php';
    }

    // Gọi model
    public function model($fileName)
    {
        include_once 'app/models/' . $fileName . '.php';
        // Trả về lớp được khởi tạo
        return new $fileName();
    }
}

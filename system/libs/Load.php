<?php
class Load
{
    public function __construct()
    {
    }


    // Gọi views
    // fileName => Tên view Admin/Author/addAuthor
    // data gửi qua dạng mảng liên kết
    // Mangr liên kết là:
    /**
     * 
     * // Mảng liên kết (Yêu cầu gửi dạng này)
     * + Có thể gán key 
     * + phải gán dưới dạng mảng 2 chiều
     * 
     * 
     * $authors=[
     *  'ten'=> values1,
     *  'key2'=> values2
     * ]
     * 
     * 
     * 
     * 
     * $ten =321312;
     * 
     *  $data[key1] => values1
     * 
     * // Mảng liên tục
     * +  Tự gán 0-n
     * 
     * $data=[
     *  '0'=> values1,
     *  '1'=> values2
     * ]
     * 
     *  $data[0] => values1
     *  $data[1] => values2
     * 
     * 
     */
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

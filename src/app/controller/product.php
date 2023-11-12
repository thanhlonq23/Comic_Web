<?php
class product extends DController
{

    public function __construct()
    {
        parent::__construct();
        // echo 'This is Product';
    }

    public function chiTietSanPham($id,$slug)
    {
        echo 'Chi tiet san pham<br>';
        echo "ID: $id";
        echo "Slug: $slug";

    }
}

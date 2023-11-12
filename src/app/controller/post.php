<?php
class post extends DController
{

    public function __construct()
    {
        echo 'This is Post<br>';
    }

    public function chiTietBaiViet($id, $slug)
    {
        echo 'Chi tiet bai viet <br>';
        echo "ID: $id";
        echo "<br>Slug: $slug";
    }
}

<?php
class HomeModel
{
    public function __construct()
    {
        echo "this is Home Model";
    }


    public function category()
    {
        return $category = array(
            'cate1' => 'Phone',
            'cate2' => 'PC',
            'cate3' => 'Scan'
        );
    }
}

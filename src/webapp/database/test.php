<?php
require_once("Database.php");
require_once("../models/User.php");

// Hiện lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'comic_web'
];
$db = new database($config);
$user = new User("1", "Lonq", "3", "4", "2003-11-23", "6", "7", "8", "9");

/*
    Bước 1: $db->table(get_class($user)) ==> Trả về Object đó
    Bước 2: Object->insert() ==> Gọi ra phương thức từ Object đã lấy ra ở Bước 1
*/
$db->table(get_class($user))
    // ->insert($user->toArray());
    ->update($user->toArray());

<?php
class Session
{
    public static function init()
    {
        // Chỉ khởi tạo session khi chưa có session nào
        if (empty(session_id())) {
            session_start();
        }
    }

    // Lấy ra phiên session
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    // Set giá trị cho phiên
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    // Kiểm tra đăng nhập hay chưa
    public static function checkSession()
    {
        self::init();
        if (self::get('login') == false) {
            self::destroy();
            header("Location:" . BASE_URL . "/?url=login");
        }
    }

    // Phá hủy tất cả giá trị session
    public static function destroy()
    {
        session_destroy();
    }


    // Phá hủy giá trị được truyền vào
    public static function unset($key)
    {
        session_unset($key);
    }
}

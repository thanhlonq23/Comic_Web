<?php
class Session
{
    public static function init()
    {
        if (empty(session_id())) {
            // Chỉ gọi session_start() nếu session_id() là rỗng
            session_start();
        }
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function checkSession()
    {
        self::init();
        if (self::get('login') == false) {
            self::destroy();
            header("Location:" . BASE_URL . "/login");
        }
    }
    public static function destroy()
    {
        session_destroy();
    }

    public static function unset($key)
    {
        session_unset($key);
    }
}

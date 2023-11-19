<?php
class loginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE username=? AND password=?";
        return $this->db->affectedRows($sql, $username, $password);
    }

    public function getLogin($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE username=? AND password=?";
        return $this->db->selectUser($sql, $username, $password);
    }
}

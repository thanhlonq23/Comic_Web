<?php
class users extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select($tableCategory)
    {
        $sql = "SELECT * FROM $tableCategory";
        return $this->db->select($sql);
    }

    public function selectByID($tableCategory, $id)
    {
        $sql = 'SELECT * FROM ' . $tableCategory . ' WHERE id = :id';
        $data = array(':id' => $id);
        return $this->db->select($sql, $data);
    }
    public function selectUser($table, $username)
    {
        $sql = "SELECT username FROM $table WHERE username=?";
        return $this->db->affectedRows($sql, $username);
    }

    public function insert($tableCategory, $data)
    {
        return $this->db->insert($tableCategory, $data);
    }

    public function update($tableCategory, $data, $cond)
    {
        return $this->db->update($tableCategory, $data, $cond);
    }

    public function delete($tableCategory, $cond)
    {
        return $this->db->delete($tableCategory, $cond);
    }
}

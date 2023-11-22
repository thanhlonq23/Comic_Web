<?php
class Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectAll($table)
    {
        $sql = "SELECT * FROM $table";
        return $this->db->select($sql);
    }

    public function selectByID($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE id = :id';
        $data = array(':id' => $id);
        return $this->db->select($sql, $data);
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $cond)
    {
        return $this->db->update($table, $data, $cond);
    }

    public function delete($table, $cond)
    {
        return $this->db->delete($table, $cond);
    }
}

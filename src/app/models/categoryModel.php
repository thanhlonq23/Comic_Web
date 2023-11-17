<?php
class categoryModel extends DModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function category($tableCategory)
    {
        $sql = "SELECT * FROM $tableCategory";
        return $this->db->select($sql);
    }

    public function categoryByID($tableCategory, $id)
    {
        $sql = 'SELECT * FROM ' . $tableCategory . ' WHERE id = :id';
        $data = array(':id' => $id);
        return $this->db->select($sql, $data);
    }

    public function insertCategory($tableCategory, $data)
    {
        return $this->db->insert($tableCategory, $data);
    }

    public function updateCategory($tableCategory, $data, $cond)
    {
        return $this->db->update($tableCategory, $data, $cond);
    }

    public function deleteCategory($tableCategory, $cond)
    {
        return $this->db->delete($tableCategory, $cond);
    }
}

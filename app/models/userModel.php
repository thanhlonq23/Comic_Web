<?php
class userModel extends Model
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

    public function selectByCond($table, $cond)
    {
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
    }
    public function selectUser($table, $username)
    {
        $sql = "SELECT * FROM $table WHERE username=?";
        return $this->db->affectedRows($sql, $username);
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

    // Hàm tính tổng các categories_id theo webtoon_id
    public function countUsers($table)
    {
        $sql = "SELECT COUNT(*) AS totalUsers FROM $table";
        return $this->db->select($sql);
    }
}

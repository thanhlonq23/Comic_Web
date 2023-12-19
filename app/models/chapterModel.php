<?php
class chapterModel extends Model
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

    public function insertChapterForWebtoon($webtoon_id, $data)
    {
        // Thêm id của webtoon vào dữ liệu chapter
        $data['webtoon_id'] = $webtoon_id;

        // Thực hiện insert
        return $this->db->insert('chapters', $data);
    }

    // Tổng SL chương truyện
    public function countChapter($table, $cond)
    {
        $sql = "SELECT COUNT(*) AS totalChapters FROM $table WHERE $cond";
        return $this->db->select($sql);
    }
    

    public function sumViews($table)
    {
        $sql = "SELECT SUM(views) AS totalViews FROM $table";
        return $this->db->select($sql);
    }

}

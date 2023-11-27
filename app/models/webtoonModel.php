<?php
class webtoonModel extends Model
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

    public function select($collum, $table)
    {
        $sql = "SELECT $collum FROM $table";
        return $this->db->select($sql);
    }

    public function selectByCond($table, $cond)
    {
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
    }

    public function selectCollum($table, $collum, $cond)
    {
        $sql = "SELECT $collum FROM $table WHERE $cond";
        return $this->db->select($sql);
    }

    // public function insert($table, $data)
    // {
    //     return $this->db->insert($table, $data);
    // }

    public function insert($table, $data)
    {
        // Kiểm tra nếu đang insert vào bảng 'chapters'
        if ($table === 'chapters') {
            // Tạo mới đối tượng của chapterModel
            $chapterModel = new chapterModel();

            // Gọi hàm insertChapterForWebtoon từ chapterModel
            return $chapterModel->insertChapterForWebtoon($data['webtoon_id'], $data);
        } else {
            // Thực hiện insert cho các trường hợp khác
            return $this->db->insert($table, $data);
        }
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

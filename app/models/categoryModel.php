<?php
class categoryModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectAll($table)
    {
        // Viết truy vấn SQL để lấy tất cả dữ liệu từ bảng $table
        // Thực hiện truy vấn và trả về kết quả
        $sql = "SELECT * FROM $table";
        return $this->db->select($sql);
    }

    public function selectByCond($table, $cond)
    {
        // Viết truy vấn SQL để lấy dữ liệu từ bảng $table dựa trên điều kiện $cond
        // Thực hiện truy vấn và trả về kết quả
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
    }

    public function insert($table, $data)
    {
        // Viết truy vấn SQL để chèn dữ liệu vào bảng $table với dữ liệu từ mảng $data
        // Thực hiện truy vấn và trả về kết quả
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $cond)
    {
        // Viết truy vấn SQL để cập nhật dữ liệu trong bảng $table với dữ liệu từ mảng $data và điều kiện $cond
        // Thực hiện truy vấn và trả về kết quả
        return $this->db->update($table, $data, $cond);
    }

    public function delete($table, $cond)
    {
        // Viết truy vấn SQL để xóa dữ liệu từ bảng $table dựa trên điều kiện $cond
        // Thực hiện truy vấn và trả về kết quả
        return $this->db->delete($table, $cond);
    }

    public function getWebtoonsByCategory($categoryID)
    {
        $sql = "SELECT webtoons.* FROM webtoons
                INNER JOIN webtoons_categories
                ON webtoons.id = webtoons_categories.webtoons_id
                WHERE webtoons_categories.categories_id = '$categoryID'";

        return $this->db->select($sql);
    }

    public function addWebtoonToCategory($categoryID, $webtoonID)
    {
        $data = [
            'categories_id' => $categoryID,
            'webtoons_id' => $webtoonID
        ];

        return $this->db->insert('webtoons_categories', $data);
    }

    public function removeWebtoonFromCategory($categoryID, $webtoonID)
    {
        $cond = "categories_id = '$categoryID' AND webtoons_id = '$webtoonID'";
        return $this->db->delete('webtoons_categories', $cond);
    }

}

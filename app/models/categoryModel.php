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
        $sql = "SELECT * FROM $table";
        return $this->db->select($sql);
    }

    public function selectByCond($table, $cond)
    {
        // Viết truy vấn SQL để lấy dữ liệu từ bảng $table dựa trên điều kiện $cond
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
    }

    public function insert($table, $data)
    {
        // Viết truy vấn SQL để chèn dữ liệu vào bảng $table với dữ liệu từ mảng $data
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $cond)
    {
        // Viết truy vấn SQL để cập nhật dữ liệu trong bảng $table với dữ liệu từ mảng $data và điều kiện $cond
        return $this->db->update($table, $data, $cond);
    }

    public function delete($table, $cond)
    {
        // Viết truy vấn SQL để xóa dữ liệu từ bảng $table dựa trên điều kiện $cond
        return $this->db->delete($table, $cond);
    }

    public function selectCategoriesByWebtoon($webtoonID)
    {
        $sql = "SELECT categories.* FROM categories
            INNER JOIN webtoons_categories
            ON categories.id = webtoons_categories.categories_id
            WHERE webtoons_categories.webtoons_id = '$webtoonID'";

        return $this->db->select($sql);
    }


    public function getWebtoonsByCategory($categoryID)
    {
        // Viết truy vấn SQL để lấy ra thể loại của bộ truyện
        $sql = "SELECT webtoons.* FROM webtoons
                INNER JOIN webtoons_categories
                ON webtoons.id = webtoons_categories.webtoons_id
                WHERE webtoons_categories.categories_id = '$categoryID'";

        return $this->db->select($sql);
    }

    
    public function addCategoryToWebtoon($webtoonID, $categoryID)
    {
        $data = [
            'webtoons_id' => $webtoonID,
            'categories_id' => $categoryID
        ];
        //Add vô bảng categories_wentoons cột webtoons_id và categories giá trị wetoonsID và categoryID vì liên kết nhiều nhiều
        return $this->db->insert('webtoons_categories', $data);
    }

    
    // Xóa các liên kết với categories trong bảng webtoons_categories dựa trên webtoon_id
    public function removeCategoryFromWebtoon($webtoonID)
    {
        $condition = "webtoons_id = '$webtoonID'";
        return $this->db->deleteArray('webtoons_categories', $condition); // Đặt giá trị limit = $sumCategories để không giới hạn số lượng hàng bị xóa là bằng 1 mặc định trong database.php
    }






    
    // <=========================Phần chưa sử dụng=========================>

    // public function addWebtoonToCategory($categoryID, $webtoonID)
    // {
    //     // Viết truy vấn SQL để thiết lập mối quan hệ cho truyện và thể loại
    //     $data = [
    //         'categories_id' => $categoryID,
    //         'webtoons_id' => $webtoonID
    //     ];

    //     return $this->db->insert('webtoons_categories', $data);
    // }

    // public function removeWebtoonFromCategory($categoryID, $webtoonID)
    // {
    //     // Viết truy vấn SQL để xóa liên kết giữa truyện và thể loại
    //     $cond = "categories_id = '$categoryID' AND webtoons_id = '$webtoonID'";
    //     return $this->db->delete('webtoons_categories', $cond);
    // }
}

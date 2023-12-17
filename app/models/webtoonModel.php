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

    // Lấy ra truyện kèm số chapter
    public function selectWebtoonWithChapter($table)
    {
        $sql = "SELECT $table.*, COUNT(Chapters.id) AS countChapter
            FROM $table
            LEFT JOIN chapters ON $table.id = chapters.webtoon_id
            GROUP BY $table.id
            ";
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


    // Tổng SL truyện 
    public function countWebtoons($table)
    {
        $sql = "SELECT COUNT(*) AS totalWebtoons FROM $table";
        return $this->db->select($sql);
    }




    public function getCategoriesByWebtoon($webtoonID)
    {
        $sql = "SELECT categories.* FROM categories
            INNER JOIN webtoons_categories
            ON categories.id = webtoons_categories.categories_id
            WHERE webtoons_categories.webtoons_id = $webtoonID";

        return $this->db->select($sql);
    }


    // <Đã chuyển sang category>
    // public function selectCategoriesByWebtoon($webtoonID)
    // {
    //     $sql = "SELECT categories.* FROM categories
    //         INNER JOIN webtoons_categories
    //         ON categories.id = webtoons_categories.categories_id
    //         WHERE webtoons_categories.webtoons_id = '$webtoonID'";

    //     return $this->db->select($sql);
    // }

    // public function addCategoryToWebtoon($webtoonID, $categoryID)
    // {
    //     $data = [
    //         'webtoons_id' => $webtoonID,
    //         'categories_id' => $categoryID
    //     ];
    //     //Add vô bảng categories_wentoons cột webtoons_id và categories giá trị wetoonsID và categoryID vì liên kết nhiều nhiều
    //     return $this->db->insert('webtoons_categories', $data);
    // }


    // // Xóa các liên kết với categories trong bảng webtoons_categories dựa trên webtoon_id
    // public function removeCategoryFromWebtoon($webtoonID)
    // {
    //     $condition = "webtoons_id = '$webtoonID'";
    //     return $this->db->deleteArray('webtoons_categories', $condition); // Đặt giá trị limit = $sumCategories để không giới hạn số lượng hàng bị xóa là bằng 1 mặc định trong database.php
    // }

}

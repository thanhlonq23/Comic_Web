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

    public function getCategoriesByWebtoon($webtoonID)
    {
        $sql = "SELECT categories.* FROM categories
            INNER JOIN webtoons_categories
            ON categories.id = webtoons_categories.categories_id
            WHERE webtoons_categories.webtoons_id = '$webtoonID'";

        return $this->db->select($sql);
    }

    public function addCategoryToWebtoon($webtoonID, $categoryID)
    {
        $data = [
            'webtoons_id' => $webtoonID,
            'categories_id' => $categoryID
        ];
        //Add vô bảng caegories_wentoons cột webtoons_id và categories giá trị wetoonsID và categoryID vì liên kết nhiều nhiều
        return $this->db->insert('webtoons_categories', $data);
    }

    // public function removeCategoryFromWebtoon($webtoonID)
    // {
    //      // Thực hiện truy vấn xóa các liên kết với categories trong bảng webtoons_categories
    //      $sql = "DELETE FROM webtoons_categories WHERE webtoon_id = :webtoon_id";
    //     return $this->db->delete('webtoons_categories', $sql);
    // }

    public function removeCategoriesFromWebtoon($webtoonID)
    {
        // Lấy danh sách các categories của webtoon
        $categories = $this->getCategoriesByWebtoon($webtoonID);

        if ($categories) {
            $categoryIds = array_column($categories, 'id');
            $categoryIdsString = "'" . implode("','", $categoryIds) . "'";

            // Xóa các liên kết trong bảng webtoons_categories
            $sqlDelete = "DELETE FROM webtoons_categories WHERE webtoons_id = '$webtoonID' AND categories_id IN ($categoryIdsString)";
            $this->db->delete('webtoons_categories', $sqlDelete);
        }
    }
}

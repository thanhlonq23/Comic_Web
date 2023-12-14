<?php
class categoriesModel extends Model
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

    public function getCategoriesByWebtoon($webtoonID)
    {
        $sql = "SELECT categories.* FROM categories
            INNER JOIN webtoons_categories
            ON categories.id = webtoons_categories.categories_id
            WHERE webtoons_categories.webtoons_id = $webtoonID";

        return $this->db->select($sql);
    }

    public function selectCategoriesByWebtoon($webtoonID)
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

    public function removeCategoryFromWebtoon($webtoonID)
    {
        // // Tính tổng các giá trị categories_id
        // $sql = "SELECT SUM(categories.id) AS total_sum FROM categories
        //     INNER JOIN webtoons_categories
        //     ON categories.id = webtoons_categories.categories_id
        //     WHERE webtoons_categories.webtoons_id = '$webtoonID'";
        //     $result = $this->db->select($sql);

        // Xóa các liên kết với categories trong bảng webtoons_categories dựa trên webtoon_id
        $condition = "webtoons_id = '$webtoonID'";
        return $this->db->deleteArray('webtoons_categories', $condition); // Đặt giá trị limit = $sumCategories để không giới hạn số lượng hàng bị xóa là bằng 1 mặc định trong database.php
    }
}

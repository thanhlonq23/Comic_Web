<?php
require_once 'Connect.php';
class Database extends Connect
{
    private $table;
    private $statement;

    public function __construct($config)
    {
        parent::__construct($config);
        // connect to mysql
        $this->connection();
    }

    public function table($tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    // INSERT
    public function insert($data)
    {
        $insert_status = null;
        try {
            $keys = array_keys($data);
            $fields = implode(', ', $keys);
            $values = ':' . implode(', :', $keys);

            // Tạo câu truy vấn
            $sql = "INSERT INTO " . $this->table . "($fields) VALUES($values)";

            // Tạo đối tượng Statement
            $this->statement = $this->connection->prepare($sql);

            // Thực hiện truy vấn
            $insert_status = $this->statement->execute($data);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
        } finally {
            if ($insert_status == true) {
                echo '<br>Thêm dữ liệu thành công';
            } else {
                echo '<br>Thêm dữ liệu thất bại';
            }

            // Đóng kết nối CSDL
            if ($this->connection !== null)
                $this->connection = null;

            if ($this->table !== null)
                $this->table = null;

            if ($this->statement !== null)
                $this->statement = null;
        }
    }

    // SELECT
    public function select()
    {
    }

    // UPDATE
    public function update($data)
    {
        $insert_status = null;

        try {
            // Xử lý tách id
            $id = $data['ID'];
            unset($data['ID']);

            $keyStr = $this->keyToStr($data);

            // Kết hợp các key thành một chuỗi
            $resultString = implode(', ', $keyStr);

            // Tạo câu truy vấn
            $sql = "UPDATE " . $this->table . " SET $resultString WHERE id=:id";
            echo '<br>' . $sql;

            // Tạo đối tượng Statement
            $data['id'] = $id;
            $this->statement = $this->connection->prepare($sql);

            // Thực hiện truy vấn
            $insert_status = $this->statement->execute($data);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
        } finally {
            if ($insert_status == true) {
                echo '<br>Cập nhật dữ liệu thành công';
            } else {
                echo '<br>Cập nhật dữ liệu thất bại';
            }

            // Đóng kết nối CSDL
            if ($this->connection !== null)
                $this->connection = null;

            if ($this->table !== null)
                $this->table = null;

            if ($this->statement !== null)
                $this->statement = null;
        }
    }

    // DELETE
    public function delete()
    {
    }

    // Xử lý chuyển key từ arr -> chuỗi
    private function keyToStr($data)
    {
        $result = array_map(
            function ($key) {
                return "$key=:$key";
            },
            array_keys($data),
            $data
        );
        return $result;
    }
}

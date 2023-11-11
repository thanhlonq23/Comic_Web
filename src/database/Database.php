<?php
require_once 'Connect.php';
class Database extends Connect
{
    private $table;
    private $statement;

    public function __construct($config)
    {
        parent::__construct($config);
        // Connect database
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

            return $insert_status;
        }
    }

    // SELECT BY ID
    public function selectByID($id)
    {
        $select_status = null;

        try {
            // Tạo câu truy vấn
            $sql = "SELECT * FROM " . $this->table . " WHERE id=:id";

            // Tạo đối tượng Statement
            $this->statement = $this->connection->prepare($sql);

            // Truyền param
            $this->statement->bindParam(':id', $id);

            // Thực hiện truy vấn
            $select_status = $this->statement->execute();
            $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
        } finally {
            if ($select_status == true) {
                echo '<br>Lấy dữ liệu thành công';
            } else {
                echo '<br>Lấy dữ liệu thất bại';
            }

            // Đóng kết nối CSDL
            if ($this->connection !== null)
                $this->connection = null;

            if ($this->table !== null)
                $this->table = null;

            if ($this->statement !== null)
                $this->statement = null;

            return $result;
        }
    }

    // SELECT
    public function selectALL()
    {
        $select_status = null;

        try {
            // Tạo câu truy vấn
            $sql = "SELECT * FROM " . $this->table;

            // Tạo đối tượng Statement
            $this->statement = $this->connection->prepare($sql);

            // Thực hiện truy vấn
            $select_status = $this->statement->execute();
            $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
        } finally {
            if ($select_status == true) {
                echo '<br>Lấy dữ liệu thành công';
            } else {
                echo '<br>Lấy dữ liệu thất bại';
            }

            // Đóng kết nối CSDL
            if ($this->connection !== null)
                $this->connection = null;

            if ($this->table !== null)
                $this->table = null;

            if ($this->statement !== null)
                $this->statement = null;

            return $result;
        }
    }

    // UPDATE
    public function update($data)
    {
        $update_status = null;

        try {
            // Xử lý tách id
            $id = $data['ID'];
            unset($data['ID']);

            $keyStr = $this->keyToStr($data);

            // Kết hợp các key thành một chuỗi
            $resultKey = implode(', ', $keyStr);

            // Tạo câu truy vấn
            $sql = "UPDATE " . $this->table . " SET $resultKey WHERE id=:id";

            // Tạo đối tượng Statement
            $this->statement = $this->connection->prepare($sql);

            // Thực hiện truy vấn
            $data['id'] = $id;
            $update_status = $this->statement->execute($data);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
        } finally {
            if ($update_status == true) {
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

            return $update_status;
        }
    }

    // DELETE
    public function deleteByID($id)
    {
        $delete_status = null;

        try {
            // Tạo câu truy vấn
            $sql = "DELETE FROM " . $this->table . " WHERE id=:id";

            // Tạo đối tượng Statement
            $this->statement = $this->connection->prepare($sql);

            // Truyền param
            $this->statement->bindParam(':id', $id);

            // Thực hiện truy vấn
            $delete_status = $this->statement->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
        } finally {
            if ($delete_status == true) {
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

            return $delete_status;
        }
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

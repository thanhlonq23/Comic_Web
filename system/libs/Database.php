<?php
class Database extends PDO
{
    public function __construct($connect, $user, $pass)
    {
        parent::__construct($connect, $user, $pass);
    }

    public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC)
    {
        $pst = $this->prepare($sql);

        // Gán tham số cho từng giá trị
        foreach ($data as $key => $value) {
            $pst->bindParam($key, $value);
        }
        $pst->execute();
        return $pst->fetchAll($fetchStyle); // $fetchStyle phương thức mặc định trả về mảng
    }


    //
    public function selectUser($sql, $username, $password, $fetchStyle = PDO::FETCH_ASSOC)
    {
        $pst = $this->prepare($sql);
        $pst->execute(array($username, $password));
        return $pst->fetchAll($fetchStyle);
    }

    public function insert($table, $data)
    {
        try {
            $keys = implode(',', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO $table($keys) VALUES($values)";
            $pst = $this->prepare($sql);

            // Gán tham số cho từng giá trị
            foreach ($data as $key => $value) {
                $pst->bindValue(":$key", $value);
            }
            $pst->execute();
        } catch (\Throwable $th) {
            return 0;
        }
        return 1;
    }

    public function update($table, $data, $condition)
    {
        try {
            $updateKeys = null;

            // Xử lý tạo chuỗi cho update
            foreach ($data as $key => $value) {
                $updateKeys .= "$key=:$key,";
            }

            $updateKeys = rtrim($updateKeys, ",");

            $sql = "UPDATE $table SET $updateKeys WHERE $condition";
            $pst = $this->prepare($sql);

            // Gán tham số cho từng giá trị
            foreach ($data as $key => $value) {
                $pst->bindValue(":$key", $value);
            }
            $pst->execute();
        } catch (\Throwable $th) {
            return 0;
        }
        return 1;
    }

    public function delete($table, $condition, $limit = 1)
    {
        $sql = "DELETE FROM $table WHERE $condition LIMIT $limit";

        // exec() không trả về dữ liệu mà trả về số dòng ảnh hưởng
        return $this->exec($sql);
    }

    public function affectedRows($sql, $username, $password = null)
    {
        $pst = $this->prepare($sql);
        if ($password == null) {
            $pst->execute(array($username));
        } else {
            $pst->execute(array($username, $password));
        }
        return $pst->rowCount(); // Trả về số hàng đã ảnh hưởng
    }
}

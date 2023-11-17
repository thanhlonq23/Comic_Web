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

        foreach ($data as $key => $value) {
            $pst->bindParam($key, $value);
        }
        $pst->execute();
        return $pst->fetchAll($fetchStyle); // $fetchStyle phương thức mặc định trả về mảng
    }

    public function insert($table, $data)
    {
        try {
            $keys = implode(',', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO $table($keys) VALUES($values)";
            $pst = $this->prepare($sql);

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
            foreach ($data as $key => $value) {
                $updateKeys .= "$key=:$key,";
            }

            $updateKeys = rtrim($updateKeys, ",");

            $sql = "UPDATE $table SET $updateKeys WHERE $condition";
            $pst = $this->prepare($sql);

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
        return $this->exec($sql);
    }
}

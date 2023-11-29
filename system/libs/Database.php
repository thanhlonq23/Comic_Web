<?php
class Database extends PDO
{
    public function __construct($connect, $user, $pass)
    {
        // Lơp cha giống super() java
        parent::__construct($connect, $user, $pass);
    }

    public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC)
    {

        // $sql = "SELECT * FROM :id , :name";
        $pst = $this->prepare($sql);

        // $pst->bindParam($data['key'], $data['values']);
        // $pst->bindParam($data['key'], $data['values']);
        // $pst->bindParam($data['key'], $data['values']);


        // Gán tham số cho từng giá trị tự động
        foreach ($data as $key => $value) {
            $pst->bindParam($key, $value);
        }

        // Thực thi câu lệnh
        $pst->execute();

        // Lấy ra giá trị truy vấn
        // $pst->fetchAll() => trả về mảng liên tục
        return $pst->fetchAll($fetchStyle); // $fetchStyle phương thức trả về mảng liên kết
    }


    public function insert($table, $data)
    {

        // sql = 'INSERT INTO chapters(id,name,date) VALUES(1,AAA,2003) '
        // $table = 'chapters';
        /**
         * data=[
         *  'id'=>'1'
         *  'name'=>'aaa'
         *  'date'>'2003'
         * ]
         *
         * id,name,date
         *
         *
         */

        try {
            // Xử lý lấy key : (id,name,date)
            $keys = implode(',', array_keys($data));
            // $key = 'id,name,date'

            // sql = 'INSERT INTO chapters(id,name,date) VALUES(:id, :name, :date) '

            // Gán vào giữa nên phải nối ':' vào implode
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO $table($keys) VALUES($values)";

            // Khởi tạo prepare Statement (Phiên)
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

    public function deleteArray($table, $condition)
    {
        $sql = "DELETE FROM $table WHERE $condition";

        // exec() không trả về dữ liệu mà trả về số dòng ảnh hưởng
        return $this->exec($sql);
    }


    // Auth => Kiểm tra có tồn tại dữ liệu trùng hay không
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


    // Kiểm tra user
    public function selectUser($sql, $username, $password, $fetchStyle = PDO::FETCH_ASSOC)
    {
        $pst = $this->prepare($sql);
        $pst->execute(array($username, $password));
        return $pst->fetchAll($fetchStyle);
    }
}

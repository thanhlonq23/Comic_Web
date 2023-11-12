<?php
class Connect
{
    protected $connection;
    //=======================//
    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;

    public function __construct($config)
    {
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->dbname = $config['dbname'];
    }

    public function connection()
    {
        try {
            if (class_exists('PDO')) {
                $dsn = 'mysql:dbname=' . $this->dbname . '; host=' . $this->host;
                $options = [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // Set UTF-8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Tạo thông báo khi gặp lỗi
                ];

                $this->connection = new PDO($dsn, $this->user, $this->pass, $options);

                if ($this->connection) {
                    echo '  <script>
                    alert("Kết nối thành công");
                    </script>';
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Line: ' . $e->getLine() . '<br>';
            die();
        }
    }
}

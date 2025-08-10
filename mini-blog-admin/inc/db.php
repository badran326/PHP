<?php
    class db
    {
        private $host = "172.31.22.43";
        private $username = "Badr200625161";
        private $password = "94kB3--Axv";
        private $db_name = "Badr200625161";
        public $conn;

        public function getConnection() {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}"
                    , $this->username,
                    $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

?>
<?php
class user {
    private $conn;
    private $table = 'users';
    public function __construct($db) {
        $this->conn = $db;
    }

    public function exist($username) {
        $sql = "SELECT user_id FROM {$this->table} WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function register($username, $password, $userprofile)
    {
        if($this->exist($username)) {
            return false;
        }
        $hash = hash("sha512", $password);
        $sql = "INSERT INTO {$this->table} (username, password, userprofile) VALUES (:username, :password, :userprofile)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['username' => $username, 'password' => $hash, 'userprofile' => $userprofile]);
    }

    public function login($username, $password) {
        $hash = hash("sha512", $password);
        $sql = "SELECT * FROM {$this->table} WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":username" => $username, ":password" => $hash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $username)
    {
        $sql = "UPDATE {$this->table} SET username = :username WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['username' => $username, 'id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['user_id' => $id]);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
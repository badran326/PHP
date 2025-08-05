<?php
class user {
    private $conn;
    private $table = 'final_users';
    public function __construct($db) {
        $this->conn = $db;
    }

    public function exist($email) {
        $sql = "SELECT user_id FROM {$this->table} WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function register($email, $username, $password, $userprofile)
    {
        if($this->exist($email)) {
            return false;
        }
        $hash = hash("sha512", $password);
        $sql = "INSERT INTO {$this->table} (email, username, password, userprofile) VALUES (:email, :username, :password, :userprofile)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['email' => $email, 'username' => $username, 'password' => $hash, 'userprofile' => $userprofile]);
    }

    public function login($email, $password) {
        $hash = hash("sha512", $password);
        $sql = "SELECT * FROM {$this->table} WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":email" => $email, ":password" => $hash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($user_id, $username, $email, $userprofile)
    {
        $sql = "UPDATE {$this->table} SET username = :username, email = :email, userprofile = :userprofile WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['username' => $username, 'email' => $email, 'userprofile' => $userprofile, 'user_id' => $user_id]);
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
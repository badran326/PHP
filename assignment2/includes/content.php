<?php
    class Content
    {
        private $conn;
        private $table = 'content';
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAll()
        {
            $stmt = $this->conn->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update($id, $user_id, $name, $content, $coffee_type, $temperature, $size, $sweeteners, $flavored, $img )
        {
            $sql = "UPDATE {$this->table} SET user_id = :user_id, name = :name, coffee_type = :coffee_type, temperature = :temperature, size = :size, sweeteners = :sweeteners, flavored = :flavored, img = :img, content = :content  WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'user_id' => $user_id,
                'name' => $name,
                'coffee_type' => $coffee_type,
                'temperature' => $temperature,
                'size' => $size,
                'sweeteners' => $sweeteners,
                'flavored' => $flavored,
                'img' => $img,
                'content' => $content,
            ]);
        }

        public function addReview($user_id, $name, $coffee_type, $temperature, $size, $sweeteners, $flavored, $img, $content)
        {
            $sql = "INSERT INTO {$this->table} (user_id, name, coffee_type, temperature, size, sweeteners, flavored, img, content) VALUES (:user_id, :name, :coffee_type, :temperature, :size, :sweeteners, :flavored, :img, :content)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['user_id' => $user_id, 'name' => $name, 'coffee_type' => $coffee_type, 'temperature' => $temperature, 'size' => $size, 'sweeteners' => $sweeteners, 'flavored' => $flavored, 'img' => $img, 'content' => $content]);
        }

        public function delete($id) {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['id' => $id]);
        }

        public function find($id)
        {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>

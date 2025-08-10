<?php
    class BlogAdmin
    {
        private $conn;
        private $table = 'posts';
        public function __construct($db) {
            $this->conn = $db;
        }

        public function exist($id) {
            $sql = "SELECT id FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
        }

        public function getBlogs() {
            $stmt = $this->conn->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getBlog($id) {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addBlog($title, $content, $image) {
            $sql = "INSERT INTO {$this->table} (title, content, image) VALUES (:title, :content, :image)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['title' => $title, 'content' => $content, 'image' => $image]);
        }

        public function addBlogWithID($id, $title, $content, $image) {
            $sql = "INSERT INTO {$this->table} (id, title, content, image) VALUES (:id, :title, :content, :image)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['id' => $id, 'title' => $title, 'content' => $content, 'image' => $image]);
        }


        public function updateBlog($id, $title, $content, $image) {
            $sql = "UPDATE {$this->table} SET title = :title, content = :content, image = :image WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'title' => $title,
                'content' => $content,
                'image' => $image,
            ]);
        }

        public function deleteBlog($id) {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([":id" => $id]);
        }

    }
?>
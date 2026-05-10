<?php
require_once dirname(__DIR__) . '../config/Database.php';

class Gallery {
    private $conn;
    private $table = "gallery";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        return $result;
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id='$id' ";
        return $this->conn->query($query);
    }

    public function getByCategory($category) {
        $category = $this->conn->real_escape_string($category);
        $query = "SELECT * FROM $this->table WHERE category='$category' ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        return $result;
    }

    public function insert($title, $image, $category) {
        $title = $this->conn->real_escape_string($title);
        $image = $this->conn->real_escape_string($image);
        $category = $this->conn->real_escape_string($category);
        
        $query = "INSERT INTO $this->table (title, image, category) VALUES ('$title', '$image', '$category')";
        return $this->conn->query($query);
    }

    public function delete($id) {
        $id = $this->conn->real_escape_string($id);
        $query = "DELETE FROM $this->table WHERE id='$id'";
        return $this->conn->query($query);
    }

    public function update($id, $title, $category) {
    $id = $this->conn->real_escape_string($id);
    $title = $this->conn->real_escape_string($title);
    $category = $this->conn->real_escape_string($category);

    $query = "UPDATE $this->table 
              SET title='$title', category='$category' 
              WHERE id='$id'";

    return $this->conn->query($query);
    }
}
?>
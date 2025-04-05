<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUserByUserName($username) {
        $query = "SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function createUser($username, $password) {
        $query = "INSERT INTO users (username, password, role) VALUES (:username, :password, 'user')";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }

    public function createAdmin($username, $password) {
        $query = "INSERT INTO users (username, password, role) VALUES (:username, :password, 'admin')";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }
}
?>

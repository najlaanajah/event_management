<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":username", $username);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function create($username, $password)
    {
        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO users (username, password)
                VALUES (:username, :password)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }
}
?>
<?php

class DatabaseConnection {
    private $server = "localhost";
    private $port = "3307"; // Added the custom port
    private $username = "root";
    private $password = "";
    private $database = "coffee_bean";

    function startConnection() {
        try {
            $conn = new PDO("mysql:host={$this->server};port={$this->port};dbname={$this->database}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

?>

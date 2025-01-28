<?php

class DatabaseConnection {
    private $server = "localhost";
    private $port = "3307"; // Added the custom port
    private $username = "root";
    private $password = "";
    private $database = "coffee_bean";

    function startConnection() {
        $conn = new mysqli($this->server, $this->username, $this->password, $this->database, $this->port);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }    
        return $conn;
    }
}

?>

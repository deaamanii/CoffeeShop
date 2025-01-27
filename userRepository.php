<?php

include_once 'DatabaseConnection.php';

class UserRepository {
    private $connection;

    public function __construct() {
        $conn = new DatabaseConnection();
        $this->connection = $conn->startConnection();
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function checkUserExists($username, $email) {
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ? true : false;
    }

    public function insertUser($username, $email, $password, $role, $createdAt) {
        $conn = $this->connection;

        $sql = "INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)";

        $statement = $conn->prepare($sql);

        if(!$statement){
            return 'Error preparing statement: ' . $conn->error;
        }
        $statement->bind_param("sssss", $username, $email, $password, $role, $createdAt);

        if ($statement->execute()) {
            return true;
        } else {
            return 'Error executing statement: ' . $statement->error;
        }
    }

    public function getAllUsers() {
        $conn = $this->connection;

        $sql = "SELECT id, username, email, password, role, created_at FROM users";

        $result = $conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return 'Error: ' . $conn->error;
        }
    }

    public function getUserById($id) {
        $conn = $this->connection;

        $sql = "SELECT id, username, email, password, role, created_at FROM users WHERE id=?";

        $statement = $conn->prepare($sql);

        if (!$statement) {
            return 'Error preparing statement: ' . $conn->error;
        }

        $statement->bind_param("s", $id);
        $statement->execute();

        $result = $statement->get_result();

        return $result->fetch_assoc();
    
    }

    public function updateUser($id, $username, $email, $password, $role) {
        $conn = $this->connection;

        $sql = "UPDATE users SET username=?, email=?, password=?, role=? WHERE id=?";

        $statement = $conn->prepare($sql);

        if (!$statement) {
            return 'Error preparing statement: ' . $conn->error;
        }

        $statement->bind_param("sssss", $username, $email, $password, $role, $id);

        if ($statement->execute()) {
            return "Update was successful";
        } else {
            return "Error updating user: " . $statement->error;
        }
    }

    public function deleteUser($id) {
        $conn = $this->connection;

        $sql = "DELETE FROM users WHERE id=?";

        $statement = $conn->prepare($sql);

        if (!$statement) {
            return 'Error preparing statement: ' . $conn->error;
        }

        $statement->bind_param("s", $id);

        if ($statement->execute()) {
            return "Delete was successful";
        } else {
            return "Error deleting user: " . $statement->error;
        }
    }

    public function getAllUsersByRole($role) {
        $conn = $this->connection;

        $sql = "SELECT id, username, email, password, role, created_at FROM users WHERE role = ?";

        $statement = $conn->prepare($sql);

        if (!$statement) {
            return 'Error preparing statement: ' . $conn->error;
        }

        $statement->bind_param("s", $role);
        $statement->execute();

        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

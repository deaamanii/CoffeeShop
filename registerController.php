<?php
include_once 'DatabaseConnection.php';

header('Content-Type: application/json');

try {
    // Check request method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['regUsername'];
        $email = $_POST['email'];
        $password = $_POST['regPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Validate inputs
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo json_encode(['error' => 'All fields are required.']);
            exit();
        }

        if ($password !== $confirmPassword) {
            echo json_encode(['error' => 'Passwords do not match.']);
            exit();
        }

        // Hash password and save to database
        include_once 'DatabaseConnection.php';
        $dbConnection = new DatabaseConnection();
        $db = $dbConnection->startConnection();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'user')");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'Registration successful!']);
        } else {
            echo json_encode(['error' => 'Failed to register user.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request method.']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}

?>

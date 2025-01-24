<?php
include_once 'DatabaseConnection.php';

class UserRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$dbConnection = new DatabaseConnection();
$db = $dbConnection->startConnection();
$userRepository = new UserRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(['error' => 'Both username and password are required.']);
        exit();
    }

    $user = $userRepository->getUserByUsername($username);

    if ($user) {
        // Use password_verify to check the hashed password
        if (password_verify($password, $user['password'])) {
            echo json_encode(['success' => 'Login successful!']);
            // Redirect or perform actions after successful login
            exit();
        } else {
            echo json_encode(['error' => 'Invalid username or password.']);
            exit();
        }
    } else {
        echo json_encode(['error' => 'Invalid username or password.']);
        exit();
    }
}
?>

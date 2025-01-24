<?php
include_once 'DatabaseConnection.php';

session_start(); // Start the session

// Clear any previous session before logging in
if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    session_start(); // Start a fresh session
}

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

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(['error' => 'Both username and password are required.']);
        exit();
    }

    $user = $userRepository->getUserByUsername($username);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Start fresh session and set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            echo json_encode(['success' => 'Login successful!']);
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

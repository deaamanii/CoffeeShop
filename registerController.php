<?php
session_start();
include_once 'DatabaseConnection.php';
include_once 'UserRepository.php';

$dbConnection = new DatabaseConnection();
$db = $dbConnection->startConnection();
$userRepository = new UserRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit();
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit();
    }

    if ($userRepository->checkUserExists($username, $email)) {
        echo "Username or email already exists.";
        exit();
    }

    $role = "user"; // Vendos rolin e përdoruesit
    $createdAt = date("Y-m-d H:i:s"); // Vendos kohën e krijimit të përdoruesit
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $inserted = $userRepository->insertUser($username, $email, $hashedPassword, $role, $createdAt);

    if ($inserted === true) {
        $_SESSION['message'] = "Registration successful! Please log in.";
        header("Location: login.php");
    } else {
        echo $inserted; // Shfaq mesazhin e gabimit nga funksioni insertUser
    }
}
?>

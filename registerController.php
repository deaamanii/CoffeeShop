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
        $_SESSION['message_type'] = 'error';
        exit();
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        $_SESSION['message'] = 'Passwords do not match.';
        $_SESSION['message_type'] = 'error';
        header("Location: register.php");
        exit();
    }

    if ($userRepository->checkUserExists($username, $email)) {
        $_SESSION['message'] = 'Username or email already exists.';
        $_SESSION['message_type'] = 'error';
        header("Location: register.php");
    }

    $role = "user"; // Vendos rolin e përdoruesit
    $createdAt = date("Y-m-d H:i:s"); // Vendos kohën e krijimit të përdoruesit
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $inserted = $userRepository->insertUser($username, $email, $hashedPassword, $role, $createdAt);

    if ($inserted === true) {
        $_SESSION['message'] = "Registration successful! Please log in.";
        $_SESSION['message_type'] = 'success';
        header("Location: login.php");
    } else {
        $_SESSION['message'] = 'Registration failed. Please try again.';
        $_SESSION['message_type'] = 'error';
        header("Location: register.php");
        exit();
    }
}
?>

<?php
session_start();

include_once 'DatabaseConnection.php';
include_once 'UserRepository.php';

$dbConnection = new DatabaseConnection();
$db = $dbConnection->startConnection();
$userRepository = new UserRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   
    if (empty($username) || empty($password)) {
        $_SESSION['message'] = 'Both username and password are required.';
        $_SESSION['message_type'] = 'error';
        header("Location: login.php");
        exit();
    }
    $user = $userRepository->getUserByUsername($username);

    if ($user) {
        // Use password_verify to check the hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['message'] = 'Login successful!';
            $_SESSION['message_type'] = 'success';
            header("Location:index.php");
            exit();
        } else {
            $_SESSION['message'] = 'Invalid username or password.';
            $_SESSION['message_type'] = 'error';
            header("Location: login.php");
            exit();          
        }
    } else {
        $_SESSION['message'] = 'Invalid username or password.';
        $_SESSION['message_type'] = 'error';
        header("Location: login.php");
        exit();
    }
}
?>

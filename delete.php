<?php

$userId = isset($_GET['id']) ? $_GET['id'] : null;
include_once 'userRepository.php';

if ($userId === null) {
    header("location:dashboard.php");
    exit();
}

$userRepository = new UserRepository();
$deleteResult = $userRepository->deleteUser($userId);

if ($deleteResult === "Delete was successful") {
    header("location:dashboard.php");
} else {
    echo "<p>Error deleting user: $deleteResult</p>";
    echo "<a href='dashboard.php'>Go back to Dashboard</a>";
}

?>

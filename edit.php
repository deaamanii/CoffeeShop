<?php
$userId = isset($_GET['id']) ? $_GET['id'] : null;
include_once 'userRepository.php';

$userRepository = new UserRepository();
$user = null;

if ($userId !== null) {
    $user = $userRepository->getUserById($userId);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="editstyle.css">
</head>
<body>
    <h3>Edit User</h3>
    <?php if ($user !== null): ?>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" value="<?= isset($user['id']) ? $user['id'] : '' ?>" readonly><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>"><br>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?= isset($user['password']) ? $user['password'] : '' ?>"><br>

        <label for="role">Role:</label>
        <input type="text" id="role" name="role" value="<?= isset($user['role']) ? $user['role'] : '' ?>" readonly><br>

        <input type="submit" name="editBtn" value="Save"><br>
    </form>
    <?php else: ?>
    <p>User not found.</p>
    <?php endif; ?>

    <?php
    if (isset($_POST['editBtn']) && $user !== null) {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : ''; // Ensure email is captured
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : '';
    
        // Check for duplicate username or email
        $existingUsers = $userRepository->getAllUsers(); // Fetch all users
        $isDuplicateUsername = false;
        $isDuplicateEmail = false;
    
        foreach ($existingUsers as $checkUser) {
            if ($checkUser['username'] === $username && $checkUser['id'] != $id) {
                $isDuplicateUsername = true;
            }
            if ($checkUser['email'] === $email && $checkUser['id'] != $id) {
                $isDuplicateEmail = true;
            }
        }
    
        if ($isDuplicateUsername) {
            echo "<p>Error: Username already exists for another user.</p>";
        } elseif ($isDuplicateEmail) {
            echo "<p>Error: Email already exists for another user.</p>";
        } else {
            $updateResult = $userRepository->updateUser($id, $username, $email, $password, $role);
    
            if ($updateResult === "Update was successful") {
                header("location: dashboard.php");
            } else {
                echo "<p>Error updating user: $updateResult</p>";
            }
        }
    }
    ?>
</body>
</html>

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
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #F2E5D5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="background: #8D6E63; padding: 30px; border-radius: 12px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3); width: 420px; color: #3E2723;">
        <h3 style="text-align: center; color: #4E342E; font-size: 24px; font-family: 'Georgia', serif;">☕ Edit User</h3>
        <?php if ($user !== null): ?>
        <form action="" method="post" style="display: flex; flex-direction: column;">
            <label for="id" style="margin-top: 10px; font-weight: bold; color: #4E342E;">ID:</label>
            <input type="text" id="id" name="id" value="<?= isset($user['id']) ? $user['id'] : '' ?>" readonly
                style="width: 100%; padding: 10px; margin-top: 5px; border: none; border-radius: 5px; background-color: #D7CCC8; color: #5D4037; font-weight: bold; font-size: 14px;">

            <label for="username" style="margin-top: 10px; font-weight: bold; color: #4E342E;">Username:</label>
            <input type="text" id="username" name="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>"
                style="width: 100%; padding: 10px; margin-top: 5px; border: none; border-radius: 5px; background-color: #EFEBE9; color: #3E2723; font-size: 14px;">

            <label for="email" style="margin-top: 10px; font-weight: bold; color: #4E342E;">Email:</label>
            <input type="email" id="email" name="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>"
                style="width: 100%; padding: 10px; margin-top: 5px; border: none; border-radius: 5px; background-color: #EFEBE9; color: #3E2723; font-size: 14px;">

            <label for="password" style="margin-top: 10px; font-weight: bold; color: #4E342E;">Password:</label>
            <input type="text" id="password" name="password" value="<?= isset($user['password']) ? $user['password'] : '' ?>"
                style="width: 100%; padding: 10px; margin-top: 5px; border: none; border-radius: 5px; background-color: #EFEBE9; color: #3E2723; font-size: 14px;">

            <label for="role" style="margin-top: 10px; font-weight: bold; color: #4E342E;">Role:</label>
            <input type="text" id="role" name="role" value="<?= isset($user['role']) ? $user['role'] : '' ?>" readonly
                style="width: 100%; padding: 10px; margin-top: 5px; border: none; border-radius: 5px; background-color: #D7CCC8; color: #5D4037; font-weight: bold; font-size: 14px;">

            <input type="submit" name="editBtn" value="Save"
                style="margin-top: 15px; background: #6D4C41; color: white; border: none; padding: 12px; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; text-transform: uppercase;">
        </form>
        <?php else: ?>
        <p style="text-align: center; color: #D32F2F; font-weight: bold;">User not found.</p>
        <?php endif; ?>
    </div>

    <?php
    if (isset($_POST['editBtn']) && $user !== null) {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : '';

        $existingUsers = $userRepository->getAllUsers();
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
            echo "<p style='text-align: center; color: #D32F2F; font-weight: bold;'>Error: Username already exists for another user.</p>";
        } elseif ($isDuplicateEmail) {
            echo "<p style='text-align: center; color: #D32F2F; font-weight: bold;'>Error: Email already exists for another user.</p>";
        } else {
            $updateResult = $userRepository->updateUser($id, $username, $email, $password, $role);

            if ($updateResult === "Update was successful") {
                header("location: dashboard.php");
            } else {
                echo "<p style='text-align: center; color: #D32F2F; font-weight: bold;'>Error updating user: $updateResult</p>";
            }
        }
    }
    ?>
</body>
</html>

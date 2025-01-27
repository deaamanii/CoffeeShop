<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Coffee Bean</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <main>
    <form action="registerController.php" method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <label for="confirmPassword">Confirm Password</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required>

    <button type="submit" name="registerbtn">Register</button>
    </form>
        <p>
            <?php
            if (isset($_GET['error'])) {
                echo '<span style="color:red;">' . htmlspecialchars($_GET['error']) . '</span>';
            } elseif (isset($_GET['success'])) {
                echo '<span style="color:green;">' . htmlspecialchars($_GET['success']) . '</span>';
            }
            ?>
        </p>
    </main>
</body>
</html>

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Coffee Bean</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<?php
    include 'header.php';
    ?>
    <main class="mainContainer">
        <div class="auth-container">
            <div class="toggle-buttons">
                <button id="loginToggle" class="active">Log In</button>
                <button id="registerToggle">Register</button>
            </div>

            <!-- Login Form -->
            <div id="loginForm" class="form-container">
                <h2>Welcome to Coffee Bean</h2>
                <form id="loginFormElement">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Login</button>
                </form>
                <p id="errorMessage"></p>
            </div>

            <!-- Register Form -->
            <div id="registerForm" class="form-container hidden">
                <h2>Join Coffee Bean</h2>
                <form id="registerFormElement" action="registerController.php" method="POST">
                    <label for="regUsername">Username</label>
                    <input type="text" id="regUsername" name="regUsername" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="regPassword">Password</label>
                    <input type="password" id="regPassword" name="regPassword" required>
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <button type="submit" name="registerBtn">Register</button>
                </form>
                <p id="registerErrorMessage" style="color: red;"></p>
            </div>
            
        </div>
    </main>
    <script src="login.js"></script>
    <div class="footerWrapper">
        <footer class="footerContainer">
            <div class="footerContent">
                <p>&copy; 2024 Coffee Bean. All Rights Reserved.</p>
                <div class="footerLinks">
                    <a href="privacy.html">Privacy Policy</a>
                    <a href="terms.html">Terms of Service</a>
                    <a href="contactus.php">Contact Us</a>
                </div>
                <div class="footerSocial">
                    <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="Instagram"></a>
                    <a href="https://www.linkedin.com/"><img src="images/linkedin.png" alt="LinkedIn"></a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

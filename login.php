<?php

include 'header.php';

if (!isset($_SESSION['message_type'])) {
    $_SESSION['message_type'] = '';
}
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Coffee Bean</title>
    <link rel="stylesheet" href="login.css">
    <style>
        .message-success {
            color: green;
        }
        .message-error {
            color: red;
        }
    </style>
    <script src="script.js"></script>
</head>
<body>
<?php
    ?>
    <main class="mainContainer">
        <div class="auth-container">
            <div class="toggle-buttons">
                <button id="loginToggle" class="active" onclick="toggleForms('login')">Log In</button>
                <button id="registerToggle" onclick="toggleForms('register')">Register</button>
            </div>
            <?php
                if (isset($_SESSION['message'])) {
                    $message_class  = $_SESSION['message_type'] === 'success' ? 'message-success' : 'message-error';
                    echo "<p class='$message_class'>{$_SESSION['message']}</p>";
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
            ?>
            <!-- Login Form -->
            <div id="loginForm" class="form-container">
                <h2>Welcome to Coffee Bean</h2>
                <form method="post" action="loginController.php" id="loginFormElement">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" >
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Login</button>
                </form>
                <p id="errorMessage"></p>
            </div>

            <!-- Register Form -->
            <div id="registerForm" class="form-container hidden">
                <h2>Join Coffee Bean</h2>
                <form action="registerController.php" method="POST">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <button type="submit" name="registerBtn">Register</button>
                </form>
                <p id="registerErrorMessage" style="color: red;"></p>
            </div>
            
        </div>
    </main>
    <script>
        function toggleForms(formType) {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const loginToggle = document.getElementById('loginToggle');
        const registerToggle = document.getElementById('registerToggle');

            if (formType === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginToggle.classList.add('active');
                registerToggle.classList.remove('active');
            } else {
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                registerToggle.classList.add('active');
                loginToggle.classList.remove('active');
            }
        }
       
</script>
    
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

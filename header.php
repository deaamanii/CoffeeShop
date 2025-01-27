<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="headerContainer">
    <div class="logo">
        <a href="index.php"> 
            <img src="images/logo.png" alt="Logo">
        </a>
    </div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="menu.php">Menu</a>
        <a href="contactus.php">Contact Us</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href="logout.php">Log Out</a>
        <?php else: ?>
            <a href="login.php">Log In | Register</a>
        <?php endif; ?>
    </div>
    <div class="social-links">
        <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="Instagram"></a>
        <a href="https://www.linkedin.com/"><img src="images/linkedin.png" alt="LinkedIn"></a>
    </div>
</header>

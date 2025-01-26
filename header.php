<header class="headerContainer">
        <div class="logo">
            <a href="index.html"> 
                <img src="images/logo.png" alt="Logo">
            </a>
        </div>
        <div>
            <a href="index.php">Home</a>
            <a href="aboutus.php">About Us</a>
            <a href="menu.php">Menu</a>
            <a href="contactus.php">Contact Us</a>
            <a href="login.php">Log In | Register</a>
            <?php
            session_start();
            if(isset($_SESSION['role'])&& $_SESSION['role']== 'admin'){
                echo '<a href="dashboard.php">Dashboard</a>';
            }
            ?>
        </div>
        <div class="social-links">
            <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="Instagram"></a>
            <a href="https://www.linkedin.com/"><img src="images/linkedin.png" alt="LinkedIn"></a>
        </div>
    </header>
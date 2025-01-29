<?php
include 'DatabaseConnection.php'; // Lidhja me databazën

// Krijo një instancë të klasës DatabaseConnection
$db = new DatabaseConnection();
$conn = $db->startConnection();

// Merr imazhet për slider-in nga databaza
$sql = "SELECT * FROM slider";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Bean</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'header.php'; // Përfshin navbar-in
    ?>
    
    <main class="main-container">
        <!-- Slider dinamik nga databaza -->
        <div class="slider-container">
            <div class="slides">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="slide">
                        <img src="<?php echo $row['image_url']; ?>" alt="Coffee Image">
                    </div>
                <?php } ?>
            </div>
            <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>

        <!-- Përmbajtja kryesore -->
        <div class="content-container">
            <h1>Let's Talk Coffee</h1>
            <p>At Coffee Bean, we combine quality, ambiance, and affordability to deliver an exceptional experience. Whether you're here to study, catch up with friends, or simply unwind, we’ve got the perfect blend for you.</p>
            <p>"We believe that coffee is more than just a drink – it’s a moment of sharing, warmth, and community."</p>
            <a href="menu.php" class="menu-button">Look at Menu</a>
        </div>
    </main>

    <script src="script.js"></script>

    <!-- Footer Section -->
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

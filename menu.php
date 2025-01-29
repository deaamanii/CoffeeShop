<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Coffee Bean</title>
    <link rel="stylesheet" href="menu.css">
</head>

<body>
<?php
session_start();

    include 'header.php';
    ?>
<?php


include 'DatabaseConnection.php'; // Lidhja me databazën

$db = new DatabaseConnection();
$conn = $db->startConnection();

// Kontrollo nëse është klikuar "Shto në Shportë"
if (isset($_GET["action"]) && $_GET["action"] == "add" && isset($_GET["id"])) {
    $productId = $_GET["id"];

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = []; // Krijo shportën nëse nuk ekziston
    }

    $_SESSION["cart"][] = $productId; // Shto produktin në shportë
    header("Location: menu.php"); // Rifreskon faqen për të shmangur ri-shtimin e produktit
    exit();
}

$sql = "SELECT products.*, users.username FROM products 
        JOIN users ON products.created_by = users.id 
        ORDER BY products.created_at DESC";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Coffee Bean</title>
    <link rel="stylesheet" href="menu.css"> <!-- Përfshin stilizimin -->
</head>
<body>

<h1>Menu</h1>
<a href="cart.php" class="cart-button">🛒 Products in your Cart (<?= count($_SESSION['cart'] ?? []) ?>)</a>


<div class="menu">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="menu-item">';
            echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
            echo '<h3>' . $row["name"] . '</h3>';
            echo '<p>' . $row["description"] . '</p>';
            echo '<p><strong>Price:</strong> ' . $row["price"] . '€</p>';
            echo '<p><em>Added by: ' . $row["username"] . '</em></p>';
            if (isset($_SESSION["user_id"])) {
                echo '<a href="cart.php?action=add&id=' . $row["id"] . '" class="buy-btn">🛒 Add to Cart</a>';
            } else {
                echo '<p><a href="login.php" class="login-to-cart">🔒 Log in to Add to Cart</a></p>';
            }                       
            echo '</div>';
    } 
}else {
        echo "<p>No products available.</p>";
    }
    ?>
</div>

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

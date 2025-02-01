<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit();
}
include 'DatabaseConnection.php'; 

$db = new DatabaseConnection();
$conn = $db->startConnection();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cart is Empty | Coffee Bean</title>
        <link rel="stylesheet" href="checkout.css"> 
    </head>
    <body>

    <div class="empty-cart-container">
       
        <h2 class="empty-cart-title">Your Cart is Empty!</h2>
        <p class="cart-message">It looks like you haven't added any products yet.</p>
        <a class="back-button" href="menu.php">🔙 Go Back to Menu</a>
    </div>

    </body>
    </html>
    <?php
    exit();
}

$cartItems = $_SESSION['cart'];
$cartProducts = [];

foreach ($cartItems as $productId) {
    $query = "SELECT * FROM products WHERE id = $productId";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $cartProducts[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["cart"] = []; 
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order Complete | Coffee Bean</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4e9dd;
                text-align: center;
                padding: 20px;
            }

            .thank-you-container {
                max-width: 600px;
                margin: auto;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .thank-you-icon {
                font-size: 50px;
                color: #4CAF50;
            }

            .thank-you-message {
                font-size: 24px;
                font-weight: bold;
                color: #5a3827;
                margin: 10px 0;
            }

            .back-to-menu {
                display: inline-block;
                padding: 10px 15px;
                margin-top: 20px;
                text-decoration: none;
                background-color: #5a3827;
                color: white;
                border-radius: 5px;
                font-weight: bold;
            }

            .back-to-menu:hover {
                opacity: 0.8;
            }
        </style>
    </head>
    <body>

    <div class="thank-you-container">
        <div class="thank-you-icon">✅</div>
        <p class="thank-you-message">Thank you for your purchase! 🛍️</p>
        <a href="menu.php" class="back-to-menu">🔙 Go Back To Menu</a>
    </div>

    </body>
    </html>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>

<div class="checkout-container">
    <h1>Checkout 🛒</h1>

    <table class="cart-table">
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price (€)</th>
        </tr>
        <?php foreach ($cartProducts as $product) : ?>
            <tr>
                <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= number_format($product['price'], 2) ?>€</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3 class="total">Total: 
        <?php 
        $total = array_sum(array_column($cartProducts, 'price'));
        echo number_format($total, 2) . "€"; 
        ?>
    </h3>

    <form method="POST">
        <button type="submit" class="pay-button">💳 Pay</button>
    </form>

    <br>
    <a href="cart.php" class="back-button">🔙 Go Back to Cart</a>
</div>

</body>
</html>

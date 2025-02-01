<?php
session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (isset($_GET["action"]) && $_GET["action"] == "add" && isset($_GET["id"])) {
    $product_id = $_GET["id"];

    if (!in_array($product_id, $_SESSION["cart"])) {
        $_SESSION["cart"][] = $product_id;
    }

    header("Location: cart.php");
    exit();
}

include 'DatabaseConnection.php';
$db = new DatabaseConnection();
$conn = $db->startConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart | Coffee Bean</title>
    <link rel="stylesheet" href="cart.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4e9dd;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #5a3827;
        }

        .cart-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #5a3827;
            color: white;
        }

        .remove-btn {
            text-decoration: none;
            color: red;
            font-weight: bold;
        }

        .remove-btn:hover {
            color: darkred;
        }

        .checkout-btn, .continue-btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }

        .continue-btn {
            background-color: #5a3827;
        }

        .checkout-btn:hover, .continue-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h1>🛒 Cart</h1>

    <?php
     if (empty($_SESSION["cart"])) {
        echo "<p>Your cart is empty.</p>";       
    } else {
        echo "<table>";
        echo "<tr><th>Image</th><th>Product</th><th>Price</th><th>Action</th></tr>";

        $total = 0;
        foreach ($_SESSION["cart"] as $product_id) {
            $query = "SELECT * FROM products WHERE id = $product_id";
            $result = mysqli_query($conn, $query);
            $product = mysqli_fetch_assoc($result);
            
            if ($product) {
                echo "<tr>";
                echo "<td><img src='{$product['image']}' width='50'></td>";
                echo "<td>{$product['name']}</td>";
                echo "<td>{$product['price']}€</td>";
                echo "<td><a class='remove-btn' href='remove_from_cart.php?id={$product_id}'>❌ Delete</a></td>";
                echo "</tr>";

                $total += $product['price'];
            }
        }
        echo "</table>";

        echo "<h2>Total: " . number_format($total, 2) . " €</h2>";
    }
    ?>
    <a href="menu.php" class="continue-btn">🔙 Continue Shopping</a>
    <a href="checkout.php" class="checkout-btn">🛍️ Finish Shopping</a>
</div>

</body>
</html>

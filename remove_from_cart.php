<?php
session_start();

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
    if (($key = array_search($product_id, $_SESSION["cart"])) !== false) {
        unset($_SESSION["cart"][$key]);
    }
}

header("Location: cart.php");
exit();
?>

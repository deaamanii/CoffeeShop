<?php
session_start();
include 'DatabaseConnection.php'; // Lidhja me databazën

$db = new DatabaseConnection();
$conn = $db->startConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = floatval($_POST["price"]);
    $created_by = $_SESSION["user_id"]; // ID e përdoruesit që po shton produktin

    // Kontrollo dhe ngarko foton
    if (!empty($_FILES["image"]["name"])) {
        $image_name = basename($_FILES["image"]["name"]);
        $image_path = "images/" . $image_name; // Tani ruhet në dosjen e duhur
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    } else {
        $image_path = "images/default.jpg"; // Foto default nëse mungon
    }

    // Ruajtja në databazë
    $sql = "INSERT INTO products (name, description, price, image, created_by, created_at) 
            VALUES ('$name', '$description', $price, '$image_path', '$created_by', NOW())";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php"); // Kthehet te dashboardi pas shtimit të produktit
        exit();
    } else {
        echo "<p style='color:red;'>Gabim: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto Produkt</title>
</head>
<body>
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required><br>
        
        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Price (€):</label>
        <input type="number" name="price" step="0.01" required><br>

        <label>Image:</label>
        <input type="file" name="image"><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>

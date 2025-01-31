<?php
session_start();
include 'DatabaseConnection.php'; // Lidhja me databazën

$db = new DatabaseConnection();
$conn = $db->startConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["product_name"]);
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
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4E342E; /* Ngjyra kafe */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #3E2723; /* Ngjyrë kafe më e errët */
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            text-align: left;
            color: #5D4037; /* Ngjyrë kafe e mesme */
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #A1887F; /* Kufizim i butë kafe */
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="file"] {
            border: none;
        }

        .btn {
            background: #795548; /* Ngjyra kafe mesatare */
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #5D4037; /* Ngjyra kafe më e errët */
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Add New Product</h2>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required></textarea>

            <label for="price">Price (€):</label>
            <input type="number" id="price" name="price" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image">

            <button type="submit" class="btn">Add Product</button>
        </form>
    </div>

</body>
</html>

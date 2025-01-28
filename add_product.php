<?php
session_start();
include 'db_connect.php'; // Lidhja me databazën

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $created_by = $_SESSION["user_id"]; // Merr ID e përdoruesit nga sesioni

    // Ngarkimi i fotos
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $image_path = "uploads/" . basename($image_name);
    move_uploaded_file($image_tmp, $image_path);

    // Ruajtja në databazë
    $sql = "INSERT INTO products (name, description, price, image, created_by) 
            VALUES ('$name', '$description', '$price', '$image_path', '$created_by')";

    if (mysqli_query($conn, $sql)) {
        echo "Produkti u shtua me sukses!";
    } else {
        echo "Gabim: " . mysqli_error($conn);
    }
}
?>

<form action="add_product.php" method="POST" enctype="multipart/form-data">
    <label>Emri i Produktit:</label>
    <input type="text" name="name" required><br>
    
    <label>Përshkrimi:</label>
    <textarea name="description" required></textarea><br>

    <label>Çmimi:</label>
    <input type="number" name="price" step="0.01" required><br>

    <label>Foto:</label>
    <input type="file" name="image" required><br>

    <button type="submit">Shto Produktin</button>
</form>

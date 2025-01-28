<?php
session_start();
include 'DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->startConnection();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = floatval($_POST["price"]);

    // Kontrollo nëse është ngarkuar një imazh i ri
    if (!empty($_FILES["image"]["name"])) {
        $image_name = basename($_FILES["image"]["name"]);
        $image_path = "images/" . $image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    } else {
        $image_path = $product["image"]; // Mban të njëjtin imazh nëse nuk ndryshohet
    }

    $sql = "UPDATE products SET name='$name', description='$description', price=$price, image='$image_path' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color:red;'>Gabim gjatë përditësimit: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifiko Produktin</title>
</head>
<body>
    <h2>Edit Product</h2>
    <?php if ($product): ?>
    <form action="edit_product.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" required><br>
        
        <label>Description:</label>
        <textarea name="description" required><?= $product['description'] ?></textarea><br>

        <label>Price (€):</label>
        <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>" required><br>

        <label>Image:</label><br>
        <img src="<?= $product['image'] ?>" width="100"><br>
        <label>Replace image:</label>
        <input type="file" name="image"><br>

        <button type="submit">Save Changes</button>
    </form>
    <?php else: ?>
        <p style='color:red;'>Product not found!</p>
    <?php endif; ?>
</body>
</html>

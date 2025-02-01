<?php
session_start();
include 'DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->startConnection();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        die("<p style='color:red;'>Product not found!</p>");
    }
} else {
    die("<p style='color:red;'>Invalid product ID!</p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = floatval($_POST["price"]);

    if (!empty($_FILES["image"]["name"])) {
        $image_name = basename($_FILES["image"]["name"]);
        $image_path = "images/" . $image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    } else {
        $image_path = $product["image"];
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
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4E342E; 
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
            color: #3E2723; 
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            text-align: left;
            color: #5D4037; 
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #A1887F; 
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="file"] {
            border: none;
        }

        .product-image {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn {
            background: #795548; 
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
            background: #5D4037;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Edit Product</h2>
        <form action="edit_product.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <label for="product_name">Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>

            <label for="price">Price (€):</label>
            <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>

            <label>Current Image:</label>
            <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">

            <label for="image">Replace image:</label>
            <input type="file" id="image" name="image">

            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>

</body>
</html>

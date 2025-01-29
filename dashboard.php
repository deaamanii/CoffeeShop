<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include_once 'userRepository.php';

$userRepository = new UserRepository();
$admins = $userRepository->getAllUsersByRole('admin');
$regularUsers = $userRepository->getAllUsersByRole('user');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Coffee Bean Admin</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

   <!-- Navbar -->
   <div style="background: #6D4C41; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
        <h2 style="color: #fff; margin: 0; font-family: 'Georgia', serif;">☕ Coffee Bean</h2>
        <nav>
            <a href="index.php" style="color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold;">Home</a>
            <a href="aboutus.php" style="color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold;">About Us</a>
            <a href="menu.php" style="color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold;">Menu</a>
            <a href="contactus.php" style="color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold;">Contact Us</a>
            <a href="dashboard.php" style="color: #FFD54F; text-decoration: none; margin-right: 20px; font-weight: bold;">Dashboard</a>
            <a href="logout.php" style="color: #FF7043; text-decoration: none; font-weight: bold;">Logout</a>
        </nav>
    </div>

    <!-- Header (Tani Navbar është mbi këtë pjesë) -->
    <div class="header" style="background: #795548; color: white; text-align: center; padding: 20px 0; font-size: 24px; font-weight: bold;">
        Coffee Bean Admin Dashboard
    </div>

    <div class="container">
        <h2>Admin</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PASSWORD</th>
                <th>EMAIL</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Role</th>
            </tr>
            <?php
            foreach ($admins as $admin) {
                echo "
                   <tr>
                       <td>{$admin['id']}</td>
                       <td>{$admin['username']}</td>
                       <td>{$admin['password']}</td>
                       <td>{$admin['email']}</td>
                       <td><a href='edit.php?id={$admin['id']}'>Edit</a></td>
                       <td><a href='delete.php?id={$admin['id']}'>Delete</a></td>
                       <td>{$admin['role']}</td>
                   </tr>
                   ";
            }
            ?>
        </table>

        <h2>Regular Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PASSWORD</th>
                <th>EMAIL</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Role</th>
            </tr>
            <?php
            foreach ($regularUsers as $user) {
                echo "
                   <tr>
                       <td>{$user['id']}</td>
                       <td>{$user['username']}</td>
                       <td>{$user['password']}</td>
                       <td>{$user['email']}</td>
                       <td><a href='edit.php?id={$user['id']}'>Edit</a></td>
                       <td><a href='delete.php?id={$user['id']}'>Delete</a></td>
                       <td>{$user['role']}</td>
                   </tr>
                   ";
            }
            ?>
        </table>

        <h2>Products</h2>
        <a href="add_product.php" class="btn" style="display: inline-block; padding: 10px 15px; background-color: #4CAF50; 
    color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-bottom: 15px;">
    ➕ Add Product
</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price (€)</th>
                <th>Image</th>
                <th>Added By</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
           require_once 'DatabaseConnection.php'; // Siguron që përfshihet vetëm një herë

            $db = new DatabaseConnection();
            $conn = $db->startConnection();
            
            $sql = "SELECT products.*, users.username FROM products 
                    JOIN users ON products.created_by = users.id 
                    ORDER BY products.created_at DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['price']}</td>
                        <td><img src='{$row['image']}' width='50' height='50'></td>
                        <td>{$row['username']}</td>
                        <td><a href='edit_product.php?id={$row['id']}'>Edit</a></td>
                        <td><a href='delete_product.php?id={$row['id']}'>Delete</a></td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='8'>No products available.</td></tr>";
            }
            ?>
        </table>
    
    </div>
</body>
</html>

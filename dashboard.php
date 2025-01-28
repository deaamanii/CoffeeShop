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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgb(120, 123, 126);
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: rgb(192, 191, 193);
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a {
            color: rgb(120, 123, 126);
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            background-color: rgb(192, 191, 193);
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Coffee Bean Admin Dashboard</h1>
    </div>
    <div class="container">
        <h2>Admins</h2>
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

<?php
session_start();
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
    </div>
</body>
</html>

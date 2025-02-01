<?php
session_start();
include 'DatabaseConnection.php'; 

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    die("Nuk keni akses për të fshirë produktet!");
}

$db = new DatabaseConnection();
$conn = $db->startConnection();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); 


    $sql = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn); 
        header("Location: dashboard.php?delete=success"); 
        exit();
    } else {
        echo "<p style='color:red;'>Gabim: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color:red;'>ID e produktit mungon!</p>";
}
?>

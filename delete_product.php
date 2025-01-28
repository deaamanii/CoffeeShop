<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    die("Nuk keni akses për të fshirë produktet!");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fshi produktin nga databaza
    $sql = "DELETE FROM products WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        // Ridrejto adminin në dashboard pas fshirjes
        header("Location: dashboard.php?delete=success");
        exit();
    } else {
        echo "Gabim: " . mysqli_error($conn);
    }
} else {
    echo "ID e produktit mungon!";
}
?>

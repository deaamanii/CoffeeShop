<?php
session_start();
include 'DatabaseConnection.php'; // Lidhja me databazën

// Kontrollo nëse përdoruesi është admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    die("Nuk keni akses për të fshirë produktet!");
}

$db = new DatabaseConnection();
$conn = $db->startConnection();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // Siguro që ID është numër për siguri

    // Ekzekuto fshirjen
    $sql = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn); // Mbyll lidhjen me databazën
        header("Location: dashboard.php?delete=success"); // Ridrejto adminin te dashboard
        exit();
    } else {
        echo "<p style='color:red;'>Gabim: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color:red;'>ID e produktit mungon!</p>";
}
?>

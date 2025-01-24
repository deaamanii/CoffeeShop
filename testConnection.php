<?php
require_once 'DatabaseConnection.php'; // Include the database connection file

$db = new DatabaseConnection(); // Instantiate the class
$conn = $db->startConnection(); // Start the connection

if ($conn) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
?>

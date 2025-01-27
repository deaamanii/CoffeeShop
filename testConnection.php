<?php
require_once 'DatabaseConnection.php'; 

$dbConnection = new DatabaseConnection();
$db = $dbConnection->startConnection(); 

if ($db) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include 'DatabaseConnection.php';
$db = new DatabaseConnection();
$conn = $db->startConnection();

// Përditësimi i një review ekzistues
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_review'])) {
    $review_id = intval($_POST['review_id']);
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $review_text = $conn->real_escape_string($_POST['review']);
    $rating = intval($_POST['rating']);

    $sql = "UPDATE reviews SET customer_name='$customer_name', review='$review_text', rating=$rating WHERE id=$review_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Review updated successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error updating review: " . $conn->error . "</p>";
    }
}

// Merr të gjitha opinionet nga databaza
$sql_reviews = "SELECT * FROM reviews";
$result_reviews = $conn->query($sql_reviews);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Manage Reviews</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Manage Reviews</h2>

    <table border="1">
        <tr>
            <th>Customer Name</th>
            <th>Review</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result_reviews->num_rows > 0) {
            while ($row = $result_reviews->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['review']) . "</td>";
                echo "<td>" . $row['rating'] . " ★</td>";
                echo "<td>
                    <form method='POST'>
                        <input type='hidden' name='review_id' value='" . $row['id'] . "'>
                        <input type='text' name='customer_name' value='" . $row['customer_name'] . "' required>
                        <textarea name='review'>" . $row['review'] . "</textarea>
                        <input type='number' name='rating' min='1' max='5' value='" . $row['rating'] . "' required>
                        <button type='submit' name='update_review'>Update</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No reviews found.</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="dashboard.php">⬅ Return to Dashboard</a>
</body>
</html>

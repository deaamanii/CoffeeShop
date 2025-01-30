<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<?php
include 'DatabaseConnection.php';

$db = new DatabaseConnection(); // Create an instance of the class
$conn = $db->startConnection(); // Call the function to get the connection



// Nëse forma është dorëzuar, përditëso databazën
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image_url = $conn->real_escape_string($_POST['image_url']);

    $sql = "UPDATE about_us SET title='$title', content='$content', image_url='$image_url' WHERE id=1";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Update Successfully!</p>";
    } else {
        echo "<p style='color: red;'>Wrong: " . $conn->error . "</p>";
    }
}

// Merr të dhënat aktuale nga databaza
$sql = "SELECT title, content, image_url FROM about_us WHERE id=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - About Us</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="admin-container">
        <h2>Manage About Us</h2>
        <form method="POST">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>"><br><br>

            <label for="content">Content:</label><br>
            <textarea id="content" name="content"><?php echo $row['content']; ?></textarea><br><br>

            <label for="image_url">URL Image:</label><br>
            <input type="text" id="image_url" name="image_url" value="<?php echo $row['image_url']; ?>"><br><br>

            <button type="submit">Update</button>
        </form>
    </div>

    <a href="dashboard.php">⬅ Return to Dashboard</a>
</body>
</html>

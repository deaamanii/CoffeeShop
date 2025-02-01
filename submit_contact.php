<?php
include 'DatabaseConnection.php';
$db = new DatabaseConnection();
$conn = $db->startConnection();

$success = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0e5d8;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
        }
        h1 {
            color: #6b4226;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #6b4226;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #4b2e1a;
        }
    </style>
</head>
<body>

    <div class="message-box">
        <?php if ($success): ?>
            <h1>🎉 Success!</h1>
            <p>Your message has been submitted successfully.</p>
        <?php else: ?>
            <h1>❌ Error</h1>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <a href="contactus.php" class="btn">Back to Contact Page</a>
    </div>

</body>
</html>

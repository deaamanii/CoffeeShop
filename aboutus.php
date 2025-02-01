<?php
include_once 'DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->startConnection();

$sql = "SELECT title, content, image_url FROM about_us LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $image = $row['image_url'];
} else {
    $title = "About Us";
    $content = "No content available.";
    $image = "images/foto.jpg"; 
}

$sql_reviews = "SELECT customer_name, review, rating FROM reviews";
$result_reviews = $conn->query($sql_reviews);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Coffee Bean</title>
    <link rel="stylesheet" href="aboutus.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section class="intro-section">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $content; ?></p>
    </section>

    <div class="container">
        <div class="card">
            <h3>Subscribe To Save</h3>
            <p>Never run out of your favorite coffees and save 10% on every order, with free shipping over $30.</p>
            <a href="login.php"><button class="btn">Log In</button></a>
        </div>
        <div class="card">
            <h3>100% Satisfaction Guaranteed</h3>
            <p>If you're not 100% satisfied with your coffee, let us know.</p>
            <a href="contactus.php"><button class="btn">Contact Us</button></a>
        </div>
        <div class="card">
            <h3>Our Coffees</h3>
            <p>Browse our list of coffees including a lot of coffee drinks!</p>
            <a href="menu.php"><button class="btn">Menu</button></a>
        </div>
    </div>

    <section class="highlight-section">
        <h2>Why Choose Us?</h2>
        <p>"Coffee Bean" was created with passion to offer an unforgettable coffee experience. We offer a wide range of high-quality coffees, from espresso and cappuccino to special coffee blends with different flavors. You can visit our coffee shop in the heart of the city, on Main Street, where the warm and modern atmosphere will make you feel right at home.</p>
        <img src="<?php echo $image; ?>" alt="Cozy Coffee Shop" class="highlight-image">
    </section>
    
    <section class="reviews-section">
        <h2>What Our Customers Say</h2>
        <div class="reviews-container">
            <?php
            if ($result_reviews->num_rows > 0) {
                while ($row = $result_reviews->fetch_assoc()) {
                    echo "<div class='review-card'>";
                    echo "<p>\"" . $row["review"] . "\"</p>";
                    echo "<h4>- " . $row["customer_name"] . "</h4>";
                    echo "<div class='stars'>";
                    for ($i = 1; $i <= 5; $i++) {
                        echo ($i <= $row["rating"]) ? "<span class='star'>&#9733;</span>" : "<span class='star'>&#9734;</span>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available.</p>";
            }
            ?>
        </div>
    </section>
</main>

<div class="footerWrapper">
    <footer class="footerContainer">
        <div class="footerContent">
            <p>&copy; 2024 Coffee Bean. All Rights Reserved.</p>
            <div class="footerLinks">
                <a href="privacy.html">Privacy Policy</a>
                <a href="terms.html">Terms of Service</a>
                <a href="contactus.php">Contact Us</a>
            </div>
            <div class="footerSocial">
                <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="Instagram"></a>
                <a href="https://www.linkedin.com/"><img src="images/linkedin.png" alt="LinkedIn"></a>
            </div>
        </div>
    </footer>
</div>

</body>
</html>

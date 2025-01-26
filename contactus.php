<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Coffee Bean</title>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <!-- Header -->
    <?php
    include 'header.php';
    ?>
<!-- Main Content -->
<main>
    <h1>Contact Us</h1>
    <form id="contactForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Your name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Your email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" placeholder="Your message" rows="4" required></textarea>
        
        <button type="submit">Send</button>
    </form>

    <blockquote class="quote">"Coffee is a hug in a mug."</blockquote>

    <div class="working-hours">
        <h2>Working Hours</h2>
        <p>Monday - Friday: 8:00 AM - 11:00 PM</p>
        <p>Saturday - Sunday: 9:00 AM - 10:00 PM</p>
    </div>

    <div class="contact-info">
        <h2>Contact Information</h2>
        <p>Phone: +355 68 123 4567</p>
        <p>Email: info@coffeebean.com</p>
    </div>

    <div id="map-container" style="width:100%;height:400px;margin:20px 0;">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2934.58544469684!2d21.17014097661873!3d42.64894767116745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549ec0d5603ad7%3A0x1ba2ce0329d66240!2sRruga%20B%2C%20Prishtina!5e0!3m2!1sen!2s!4v1732891604966!5m2!1sen!2s" 
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</main>

<!-- Footer Section -->
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
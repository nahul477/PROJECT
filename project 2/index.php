<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    $message = "You are not logged in. Please log in.";
} else {
    $message = "You are logged in as " . $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare System - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <style>
            h1 {
                text-align: left;
            }
        </style>
        <h1>BABYCARE SYSTEM</h1>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="diseases.html">DISEASES</a></li>
                <li><a href="food-nutrition.html">FOOD & NUTRITION</a></li>
                <li><a href="vaccination.php">VACCINATION</a></li>
                <?php
                if (!isset($_SESSION['username'])) {
                    echo '<li><a href="login.html">LOGIN</a></li>';
                } else {
                    echo '<li class="logout"><form method="post" action="logout.php"><input type="submit" value="LOGOUT"></form></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    
    <section>
        <h2>Home</h2>
        <p><?php echo $message; ?></p>

        <p>Welcome to BabyCare System. We are dedicated to providing comprehensive information and resources for the health and well-being of your baby.</p>

        <p>Explore our sections to learn about common diseases, essential food and nutrition, and the vaccination schedule for your little one. Whether you are a new parent or an experienced caregiver, we've got you covered.</p>

        <p>Feel free to browse through the wealth of information we have curated to ensure your baby's health and happiness. If you have any questions or concerns, don't hesitate to reach out.</p>

        <div class="image-container">
            <img src="baby1.jpg" alt="Image 1">
            <p>Image 1 Description</p>

            <img src="baby1.jpg" alt="Image 2">
            <p>Image 2 Description</p>
        </div>
    </section>
    
    <footer>
        <p>DONE BY NAHUL S</p>
        <p>21-UCA-047</p>
    </footer>
</body>
</html>

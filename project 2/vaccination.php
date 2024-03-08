<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    echo '<script>alert("Please log in first."); window.location.href = "login.html";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare System - Vaccination</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome to BabyCare System</h1>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="diseases.html">DISEASES</a></li>
                <li><a href="food-nutrition.html">FOOD & NUTRITION</a></li>
                <li><a href="vaccination.html">VACCINATION</a></li>
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
        <h2>Vaccination Form</h2>
        <form action="submit.php" method="POST" enctype="multipart/form-data">
            <div id="photoUploadContainer">
                <label for="babyName">Baby Photo:</label>
                <label for="photoUpload" class="uploadButton">Choose File</label>
                <input type="file" id="photoUpload" name="photoUpload" accept="image/*" class="inputfile" onchange="updateFileName()">
                <span id="fileName"></span>
            </div>
            
            <label for="babyName">Baby Name:</label>
            <input type="text" id="babyName" name="babyName" required>
                     
            <label for="babyAge">Baby Age:</label>
            <input type="number" id="babyAge" name="babyAge" required>
            
            <label for="motherName">Mother's Name:</label>
            <input type="text" id="motherName" name="motherName" required>
            
            <label for="fatherName">Father's Name:</label>
            <input type="text" id="fatherName" name="fatherName" required>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
            
            <label for="bloodGroup">Blood Group:</label>
            <input type="text" id="bloodGroup" name="bloodGroup" required>
            
            <label>Vaccination Taken:</label>
            <input type="radio" id="vaccinationTaken1" name="vaccinationTaken" value="Yes" required>
            <label for="vaccinationTaken1">Yes</label>
            <input type="radio" id="vaccinationTaken2" name="vaccinationTaken" value="No" required>
            <label for="vaccinationTaken2">No</label>
            
            <input type="submit" value="Submit">
        </form>
    </section>
    
    <footer>
        <p>&copy; 2024 BabyCare System. All Rights Reserved.</p>
    </footer>

    <script>
        function updateFileName() {
            var fileInput = document.getElementById('photoUpload');
            var fileNameSpan = document.getElementById('fileName');

            if (fileInput.files.length > 0) {
                fileNameSpan.textContent = fileInput.files[0].name;
            } else {
                fileNameSpan.textContent = '';
            }
        }
    </script>
</body>
</html>

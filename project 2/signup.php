<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "babycare";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $babyname = $_POST["babyname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Insert user data into database
    $sql = "INSERT INTO users (babyname,username, password) VALUES ('$babyname','$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the login page with a success message
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

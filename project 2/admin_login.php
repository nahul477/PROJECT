<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "babycare";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful
        $_SESSION['username'] = $_POST['username']; // Store username in session
        header("Location: index.php"); // Redirect to index page
        exit(); // Stop further execution
    } else {
        // Login failed
        echo "<script>alert('Login failed. Please check your username and password.'); window.location.href = 'admin_login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

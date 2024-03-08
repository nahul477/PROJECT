<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "babycare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username and password are set
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the password is correct (you should use password_hash and password_verify for secure password handling)
            if ($password === $row['password']) {
                // Set session variable for successful login
                $_SESSION['username'] = $row['username'];
                // Redirect to index.php after successful login
                header("Location: index.php"); // Change the destination if needed
                exit(); // Make sure to exit after header redirection
            } else {
                $_SESSION['error'] = "Incorrect password!";
            }
        } else {
            $_SESSION['error'] = "User not found!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... your existing head content ... -->
</head>
<body>
    <!-- ... your existing body content ... -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php
            if (isset($_SESSION['error'])) {
                echo 'alert("' . $_SESSION['error'] . '");';
                echo 'window.location.href = "login.html";';
                unset($_SESSION['error']); // Clear the error message after displaying
            }
            ?>
        });
    </script>
</body>
</html>

<?php
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

// File upload handling
$targetDir = "babyphoto/";
$targetFile = $targetDir . basename($_FILES["photoUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

// Check if file is an image
$check = getimagesize($_FILES["photoUpload"]["tmp_name"]);
if($check === false) {
    echo "<script>alert('File is not an image.'); window.location.href = 'vaccination.html';</script>";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($targetFile)) {
    echo "<script>alert('Sorry, file already exists.'); window.location.href = 'vaccination.html';</script>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["photoUpload"]["size"] > 500000) {
    echo "<script>alert('Sorry, your file is too large.'); window.location.href = 'vaccination.html';</script>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href = 'vaccination.html';</script>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = 'vaccination.html';</script>";
// If everything is ok, try to upload file and insert into database
} else {
    if (move_uploaded_file($_FILES["photoUpload"]["tmp_name"], $targetFile)) {
        $babyName = $_POST['babyName'];
        $babyAge = $_POST['babyAge'];
        $motherName = $_POST['motherName'];
        $fatherName = $_POST['fatherName'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $bloodGroup = $_POST['bloodGroup'];
        $vaccinationTaken = $_POST['vaccinationTaken'];
        $photoPath = $targetFile;

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO baby_details (babyName, babyAge, motherName, fatherName, address, phoneNumber, bloodGroup, vaccinationTaken, photoPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssssss", $babyName, $babyAge, $motherName, $fatherName, $address, $phoneNumber, $bloodGroup, $vaccinationTaken, $photoPath);

        // Execute the statement
        if ($stmt->execute()) {
            // Display a JavaScript alert
            echo "<script>alert('New record created successfully.'); window.location.href = 'index.html';</script>";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'vaccination.html';</script>";
    }
}

$conn->close();
?>

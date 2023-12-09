<?php
// Connect to the database (adjust these details based on your database setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
$roomNumber = (int)$_POST['room_number']; // Ensure it's an integer
$checkInDate = mysqli_real_escape_string($conn, $_POST['check_in_date']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$type = mysqli_real_escape_string($conn, $_POST['type']);

// Use prepared statement
$stmt = $conn->prepare("INSERT INTO reservations (name, contact_number, room_number, check_in_date, gender, type) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisss", $name, $contactNumber, $roomNumber, $checkInDate, $gender, $type);

if ($stmt->execute()) {
    // If successful
    $successMessage = "Reservation successful! Thank you for reserving.";
    $conn->close();
    header("Location: index.php?message=" . urlencode($successMessage));
    exit();
} else {
    // If there's an error
    $errorMessage = "Error: " . $stmt->error;
    die($errorMessage); // Output the error for debugging
}

<?php
// Connect to the database (adjust these details based on your database setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dormitory";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$contactNumber = $_POST['contact_number'];
$roomNumber = $_POST['room_number'];
$checkInDate = $_POST['check_in_date'];
$gender = $_POST['gender'];
$type = $_POST['type'];

// SQL query to insert data into the reservations table
$sql = "INSERT INTO reservations (name, contact_number, room_number, check_in_date, gender, type) VALUES ('$name', '$contactNumber', '$roomNumber', '$checkInDate', '$gender', '$type')";

if ($conn->query($sql) === TRUE) {
    echo "Reservation successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

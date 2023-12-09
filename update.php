<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"]) && isset($_POST["data"])) {
    $id = $_POST["id"];
    $data = json_decode($_POST["data"], true);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE reservations SET name=?, contact_number=?, room_number=?, check_in_date=?, gender=?, type=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $data['name'], $data['contactNumber'], $data['roomNumber'], $data['checkInDate'], $data['gender'], $data['type'], $id);

    $response = array();

    if ($stmt->execute()) {
        $response["success"] = true;
    } else {
        $response["success"] = false;
        $response["error"] = "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request.";
}
?>

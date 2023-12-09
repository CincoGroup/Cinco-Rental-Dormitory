<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the reservations table (replace with your actual table name)
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<h2>Welcome Admin! Manage Your Reservations</h2>';
    echo '<p>Details about the reservations you have access to.</p>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Contact Number</th>';
    echo '<th>Room Number</th>';
    echo '<th>Check-in Date</th>';
    echo '<th>Gender</th>';
    echo '<th>Type</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr id='row_" . $row['id'] . "'>";
        echo "<td contenteditable='false'>" . $row['name'] . "</td>";
        echo "<td contenteditable='false'>" . $row['contact_number'] . "</td>";
        echo "<td contenteditable='false'>" . $row['room_number'] . "</td>";
        echo "<td contenteditable='false'>" . $row['check_in_date'] . "</td>";
        echo "<td contenteditable='false'>" . $row['gender'] . "</td>";
        echo "<td contenteditable='false'>" . $row['type'] . "</td>";
        echo "<td>";
        echo "<button onclick='editRow(this, " . $row['id'] . ")'>Edit</button>";
        echo "<button onclick='saveRow(this, " . $row['id'] . ")'>Save</button>";
        echo "<button onclick='deleteRow(" . $row['id'] . ")'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo '</tbody>';
    echo '</table>';
    echo '<button onclick="logout()">Logout</button>';
}

$conn->close();
?>
<!-- Repeat the above row for each record -->

<script>
    function editRow(button, id) {
        // Toggle contenteditable for each cell in the row
        const row = button.parentNode.parentNode;
        toggleEditable(row, true);
    }

    function saveRow(button, id) {
        // Implement logic to save the changes made to the corresponding row in the database
        // Using AJAX for asynchronous request
        const row = button.parentNode.parentNode;
        const cells = row.getElementsByTagName("td");

        // Prepare the data to be sent to the server for update
        const rowData = {
            name: getCellValue(cells, 0),
            contactNumber: getCellValue(cells, 1),
            roomNumber: getCellValue(cells, 2),
            checkInDate: getCellValue(cells, 3),
            gender: getCellValue(cells, 4),
            type: getCellValue(cells, 5)
        };

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // If the update was successful, toggle contenteditable to false
                    toggleEditable(row, false);
                } else {
                    alert("Error saving record: " + response.error);
                }
            }
        };
        xhr.send("id=" + id + "&data=" + JSON.stringify(rowData));
    }

    function deleteRow(id) {
        // Implement logic to delete the corresponding row from the database
        // Using AJAX for asynchronous request
        const confirmation = confirm("Are you sure you want to delete this record?");
        if (confirmation) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Remove the row from the table
                        const row = document.getElementById("row_" + id);
                        row.parentNode.removeChild(row);
                    } else {
                        alert("Error deleting record: " + response.error);
                    }
                }
            };
            xhr.send("id=" + id);
        }
    }

    function toggleEditable(row, isEditable) {
        // Toggle contenteditable for each cell in the row
        const cells = row.getElementsByTagName("td");
        for (let i = 0; i < cells.length - 1; i++) {
            cells[i].contentEditable = isEditable;
        }
    }

    function getCellValue(cells, index) {
        // Get the text content of the cell at the specified index
        return cells[index].textContent.trim();
    }
    function logout() {
        window.location.href = 'login.php';
    }
</script>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

td {
    background-color: #fff;
}

td[contenteditable="true"]:focus {
    background-color: #e6f7ff;
    outline: 2px solid #007bff;
}

button {
    cursor: pointer;
    padding: 5px;
    margin: 2px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 3px;
}

button:hover {
    background-color: #0056b3;
}
.logout-button {
    cursor: pointer;
    padding: 8px 15px; /* Adjust padding for a slightly bigger button */
    margin: 10px 0 0 auto; /* Move the button to the right */
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 3px;
}

.logout-button:hover {
    background-color: #0056b3;
}
</style>

<?php
session_start();
// Include your database connection file
include 'db_connection.php';

// Retrieve search criteria from POST request
$city = $_POST['city'];
$date = $_POST['date'];
$duration = $_POST['duration']; // Corrected variable assignment
$courtType = $_POST['courtType'];

// Prepare SQL statement to fetch courts based on search criteria
$sql = "SELECT * FROM courts WHERE city = ? AND court_type = ? AND date = ? AND duration = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("ssss", $city, $courtType, $date, $duration); // Updated parameter binding
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store search results
$courts = array();

// Fetch court data and store it in the array
while ($row = $result->fetch_assoc()) {
    $courts[] = $row;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

// Send JSON response with search results
header('Content-Type: application/json');
echo json_encode($courts);
?>

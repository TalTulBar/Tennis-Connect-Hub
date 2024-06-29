<?php
session_start();
include 'db_connection.php';

$city = $_POST['city'];
$date = $_POST['date'];
$level = $_POST['level'];

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to fetch coaches based on search criteria
$sql = "SELECT * FROM coaches WHERE city = ? AND training_date = ? AND difficulty_level = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation is successful
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameters to the SQL query
$stmt->bind_param("sss", $city, $date, $level);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store search results
$coaches = array();

// Fetch coach data and store it in the array
while ($row = $result->fetch_assoc()) {
    $coaches[] = $row;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

// Send JSON response with search results
header('Content-Type: application/json');
echo json_encode($coaches);
?>

<?php
// Include your database connection file
include 'db_connection.php';

// Retrieve search criteria from POST request
$city = $_POST['city'];
$level = $_POST['level'];
$gameType = $_POST['gameType'];

// Prepare SQL statement to fetch players based on search criteria
$sql = "SELECT * FROM players WHERE city = ?  AND level_of_play = ? AND game_type = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation is successful
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sss", $city,  $level, $gameType); 

$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store search results
$players = array();

// Fetch player data and store it in the array
while ($row = $result->fetch_assoc()) {
    $players[] = $row;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

// Send JSON response with search results
header('Content-Type: application/json');
echo json_encode($players);
?>

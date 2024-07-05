<?php
session_start();
// Include your database connection file
include 'db_connection.php';

$response = array('success' => false, 'message' => '');

// Retrieve partner data from POST request
$fullName = $_POST['full_name'];
$phoneNumber = $_POST['phone_number'];
$email = $_POST['email'];
$levelOfPlay = $_POST['level_of_play'];
$playerid = $_SESSION['id_number'];
// Check if the partner already exists in the database
$checkSql = "SELECT * FROM my_partners WHERE full_name = ? AND phone_number = ? AND email = ? AND level_of_play = ? AND player_id = ?";
$checkStmt = $conn->prepare($checkSql);

if ($checkStmt === false) {
    $response['message'] = 'Error preparing statement: ' . $conn->error;
    echo json_encode($response);
    exit;
}

$checkStmt->bind_param("sssss", $fullName, $phoneNumber, $email, $levelOfPlay, $playerid);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    $response['message'] = $fullName.  ' Partner already exists.';
} else {
    // Prepare SQL statement to insert new partner
    $sql = "INSERT INTO my_partners (full_name, phone_number, email, level_of_play, player_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $response['message'] = 'Error preparing statement: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("sssss", $fullName, $phoneNumber, $email, $levelOfPlay, $playerid);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = $fullName. ' Partner added successfully!';
    } else {
        $response['message'] = $fullName.  ' Error adding partner.';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the check statement and database connection
$checkStmt->close();
$conn->close();

echo json_encode($response);
?>

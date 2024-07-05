<?php
session_start();
include 'db_connection.php';
$userid = $_SESSION['id_number'];
$sql = "SELECT full_name, phone_number, email, level_of_play FROM my_partners WHERE player_id = $userid";
$result = $conn->query($sql);

$partners = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $partners[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($partners);
?>

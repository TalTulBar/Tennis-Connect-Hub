<?php
$servername = "localhost";
$username = "isarbelbh_arbel";
$password = "Arbel456789!";
$dbname = "isarbelbh_sports_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

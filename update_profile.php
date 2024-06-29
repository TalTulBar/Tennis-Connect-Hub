<?php
// Include your database connection file
include 'db_connection.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $city = $_POST['city'];

    // Validate form data
    if (empty($fullName) || empty($phoneNumber) || empty($email) || empty($level) || empty($city)) {
        $response = array(
            'success' => false,
            'message' => 'Please fill in all required fields.'
        );
    } elseif (!ctype_digit($phoneNumber)) {
        $response = array(
            'success' => false,
            'message' => 'Enter a valid phone number.'
        );
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = array(
            'success' => false,
            'message' => 'Invalid email address.'
        );
    } else {
        // Prepare and execute the SQL statement to update user data in the database
        $sql = "UPDATE players SET full_name=?, phone_number=?, email=?, level_of_play=?, city=? WHERE id_number=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $response = array(
                'success' => false,
                'message' => 'Error preparing SQL statement: ' . $conn->error
            );
        } else {
            $stmt->bind_param("ssssss", $fullName, $phoneNumber, $email, $level, $city, $_SESSION['id_number']);

            if ($stmt->execute()) {
                // Update session variables with new information
                $_SESSION['full_name'] = $fullName;
                $_SESSION['phone_number'] = $phoneNumber;
                $_SESSION['email'] = $email;
                $_SESSION['level_of_play'] = $level;
                $_SESSION['city'] = $city;

                $response = array(
                    'success' => true,
                    'message' => 'Your profile has been updated!'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error updating profile: ' . $stmt->error
                );
            }

            $stmt->close();
        }
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Make sure to exit after sending the response
} else {
    // Invalid request method
    $response = array(
        'success' => false,
        'message' => 'Invalid request method.'
    );

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

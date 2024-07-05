<?php
// Include your database connection file
include 'db_connection.php';

// Initialize response array
$response = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate form data
    if (empty($email) || empty($password)) {
        $response['success'] = false;
        $response['message'] = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email pattern
        $response['success'] = false;
        $response['message'] = 'Invalid email address';
    } else {
        // Prepare and execute the SQL statement to retrieve user data from the database
        $sql = "SELECT * FROM players WHERE email  = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            // Check for errors
            $response['success'] = false;
            $response['message'] = 'Error preparing statement: ' . $conn->error;
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // User found, verify password
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['id_number'] = $user['id_number'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['phone_number'] = $user['phone_number'];
                    $_SESSION['level_of_play'] = $user['level_of_play'];
                    $_SESSION['city'] = $user['city'];
                    if (isset($_SESSION['email'])){
                        $response['success'] = true;
                        $response['message'] = 'Login successful';
                    }
                    
                } else {
                    // Password is incorrect
                    $response['success'] = false;
                    $response['message'] = 'Incorrect password';
                }
            } else {
                // User not found
                $response['success'] = false;
                $response['message'] = 'User does not exist';
            }

            $stmt->close();
        }
    }

    $conn->close();
} else {
    // If the form is not submitted, return an error response
    $response['success'] = false;
    $response['message'] = 'Invalid request';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

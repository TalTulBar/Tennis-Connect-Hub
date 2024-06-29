<?php
// Include your database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $gameType = $_POST['gameType'];
    $level = $_POST['level'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form data
    if (empty($id) || empty($fullName) || empty($phoneNumber) || empty($email) || empty($level) || empty($city) || empty($password) || empty($confirmPassword)) {
        // Handle validation errors (e.g., display an error message)
        $response = array(
            'success' => false,
            'message' => 'Please fill in all required fields.'
        );
    } elseif (!ctype_digit($id) ) {
        // Check if ID number is exactly 9 digits long and contains only digits
        $response = array(
            'success' => false,
            'message' => 'Enter a valid 9-digit ID number.'
        );
    } elseif (!ctype_digit($phoneNumber)) {
        // Check if phone number contains only digits
        $response = array(
            'success' => false,
            'message' => 'Enter a valid phone number.'
        );
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email pattern
        $response = array(
            'success' => false,
            'message' => 'Invalid email address.'
        );
    } elseif ($password !== $confirmPassword) {
        // Check if password and confirm password match
        $response = array(
            'success' => false,
            'message' => 'Password and confirm password do not match.'
        );
    } else {
        // Hash the password before storing it in the database for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL statement to insert user data into the database
        $sql = "INSERT INTO players (id_number, full_name, phone_number, email,game_type,level_of_play, city, password) VALUES (?, ?, ?,?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            // Handle SQL statement preparation error
            $response = array(
                'success' => false,
                'message' => 'Error preparing SQL statement: ' . $conn->error
            );
        } else {
            $stmt->bind_param("ssssssss", $id, $fullName, $phoneNumber, $email,$gameType, $level, $city, $hashedPassword);

            if ($stmt->execute()) {
                
                // User created successfully
                session_start();
                $_SESSION['id_number'] =  $id;
                $_SESSION['full_name'] =  $fullName;
                $_SESSION['email'] =$email;
                $_SESSION['phone_number'] = $phoneNumber;
                $_SESSION['gameType'] = $gameType;
                $_SESSION['level_of_play'] = $level;
                $_SESSION['city'] =  $city;

                $response = array(
                    'success' => true,
                    'message' => 'Your account has been created! You can now login.'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error creating user: ' . $stmt->error
                );
            }

            $stmt->close();
        }
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
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

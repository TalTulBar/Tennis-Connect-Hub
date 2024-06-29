<?php
require 'vendor/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

require 'db_connection.php';
session_start();

$orderId = $_GET['token'] ?? '';
$courtName = $_GET['court_name'] ?? '';
$price = $_GET['price'] ?? '';

// // Verify that courtName and price are not empty
// if (empty($courtName) || empty($price)) {
//     echo "Error: Court name or price is empty.";
//     exit;
// }

$request = new OrdersCaptureRequest($orderId);
$request->prefer('return=representation');



try {
   
$clientId = 'AWWRnLh7repXbkz0LZaFRjNawYdjKeHkwTMG-iNBqlzlCa38nN3fE1pAARvhibolvZy_oQgx9FZmzVMt';
$clientSecret = 'ED-EGw-PnDWbJchadAk64JxyX_UJeOoDsaE--xu7DmQBZ-Ck4EnTWVNxGIPBCp8pSDIA5wo7Y-U7C0sV';

    $environment = new SandboxEnvironment($clientId, $clientSecret);
    $client = new PayPalHttpClient($environment);

    // Execute PayPal capture request
    $response = $client->execute($request);

    // Check if payment is completed
    if ($response->result->status === 'COMPLETED') {
        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO reservations (order_id,product_name, price) VALUES (?, ?,?)");
        $stmt->bind_param("sss", $orderId,$courtName, $price);

        if ($stmt->execute()) {
            header('Location: success.php');
            exit; // Ensure to exit after header redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and database connection
        $stmt->close();
    } else {
        echo "Payment not completed.";
    }
} catch (Exception $ex) {
    // Log the error and display a message
    error_log($ex->getMessage(), 3, 'error.log');
    echo "An error occurred while capturing the PayPal order.";
}

// Close database connection
$conn->close();
?>

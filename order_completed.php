<?php
include 'db_connection.php';

require __DIR__ . '/vendor/autoload.php';
use PayPalCheckoutSdkOrders\OrdersCaptureRequest;
use PayPalCheckoutSdkCore\PayPalHttpClient;
use PayPalCheckoutSdkCore\SandboxEnvironment;

$clientId = 'Af5HyRel4Wg0WuHTTSgboABaqipKEQA8ZdsuRess0iZDIk1IP8YmlAW7LAt1EzZ7zpRbAuIUUUFUNqSn';
$clientSecret = 'EKUCzeKFDMybztt7O8FdWYiAjO0Isb9ovb3hftjuphFdJA_FU5ycc00NtMuY1fXl8z-oLvd5hZmhFGWY';

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

$orderId = $_GET['token'];

$request = new OrdersCaptureRequest($orderId);
$request->prefer('return=representation');

try {
    $response = $client->execute($request);
    $courtName = $_GET['court_name'];
    $price = $_GET['price'];
    
    $stmt = $conn->prepare("INSERT INTO reservations (court_name, price, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("sd", $courtName, $price);
    $stmt->execute();
    
    header('Location: success.php');
} catch (Exception $ex) {
    error_log($ex->getMessage(), 3, '/path/to/your/error.log');
    echo "An error occurred while completing the PayPal order.";
    exit(1);
}
?>

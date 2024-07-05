<?php
require __DIR__ . '/vendor/autoload.php';
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

include 'db_connection.php';

$clientId = 'AWWRnLh7repXbkz0LZaFRjNawYdjKeHkwTMG-iNBqlzlCa38nN3fE1pAARvhibolvZy_oQgx9FZmzVMt';
$clientSecret = 'ED-EGw-PnDWbJchadAk64JxyX_UJeOoDsaE--xu7DmQBZ-Ck4EnTWVNxGIPBCp8pSDIA5wo7Y-U7C0sV';

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

$data = json_decode(file_get_contents('php://input'), true);

session_start();

$price = $data['price'];
$courtName = $data['court_name'];
$userId = $_SESSION['id_number'];


// Validate price and courtName
if (empty($courtName) || empty($price)) {
    echo json_encode(['error' => 'Court name or price is empty.']);
    exit;
}

$request = new OrdersCreateRequest();
$request->prefer('return=representation');
$request->body = [
    "intent" => "CAPTURE",
    "purchase_units" => [
        [
            "amount" => [
                "value" => $price,
                "currency_code" => "USD" 
            ]
        ]
    ],
   "application_context" => [
    "return_url" => "http://isarbelbh.mtacloud.co.il/success.php",
"cancel_url" => "http://isarbelbh.mtacloud.co.il/"

    ]
];
$sql = "INSERT INTO reservations (user_id,court_name, price, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error, 3, 'error.log');
    echo json_encode(['error' => 'Database error during preparation.']);
    exit;
}

$stmt->bind_param("sss", $userId,$courtName, $price);
//$stmt->execute();

if ($stmt->execute()) {       
    session_start();
    $_SESSION['user_id'] = $userId;
    $_SESSION['price'] = $price;
    $_SESSION['court_name'] = $courtName;
}
else {
    error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error, 3, 'error.log');
    echo json_encode(['error' => 'An error occurred while sending to DB.']);
    $stmt->close();};
$stmt->close();



try {
    $response = $client->execute($request);

    $order_id = $response->result->id;

    session_start();
    $_SESSION['user_id'] = $userId;
    $_SESSION['price'] = $price;
    $_SESSION['court_name'] = $courtName;

    $approvalUrl = null;
    foreach ($response->result->links as $link) {
        if ($link->rel == 'approve') {
            $approvalUrl = $link->href;
            break;
        }
    }

    echo json_encode(['approvalUrl' => $approvalUrl, 'order_id' => $order_id]);
} catch (HttpException $ex) {
    error_log($ex->getMessage(), 3, '/path/to/your/error.log');
    echo json_encode(['error' => 'An error occurred while creating the PayPal order.']);
    exit(1);
}
?>


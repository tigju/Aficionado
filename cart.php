<?php

$hostname = 'localhost'; // specify host domain or IP, i.e. 'localhost' or '127.0.0.1' or server IP 'xxx.xxxx.xxx.xxx'
$database = 'project'; // specify database name
$db_user = 'root'; // specify username
$db_pass = 'root';
$port = 8889;

$conn = new mysqli("$hostname" , "$db_user" , "$db_pass", "$database", "$port");
//$conn = new mysqli("$hostname" , "$db_user" , "$db_pass", "$database");
// Check connection
if ($conn->connect_error) {
  die("Failed to connect to MySQL: " . $conn->connect_error);
  exit();
}   

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve cart data
    $cartData = json_decode($_POST["cart"], true);
    $u_id = $_SESSION["user_id"];
 
    $insertOrderQuery = "INSERT INTO `orders`(`user_id`, `order_date`) VALUES ($u_id, NOW())";
    if ($conn->query($insertOrderQuery) === TRUE) {
        // Get the order ID
        $orderId = $conn->insert_id;
        // create order line 
        $orderLine = 1;

        // Insert ordered items into "Items" table
        foreach ($cartData as $item) {
            $itemId = intval($item["id"]);
            $name = $conn->real_escape_string($item["productName"]);
            $price = floatval($item["price"]);
             $itemQuery = "INSERT INTO `order_lines`(`order_id`, `order_line`, `product_id`, `product_name`, `quantity`, `price`) VALUES ('$orderId','$orderLine','$itemId','$name', 1, '$price')";
            error_log("Item Query: " . $itemQuery);
            error_log("order_id: " . $orderId . ", order_line: " . $orderLine . ", product_id: " . $itemId);

            $conn->query($itemQuery);
            $orderLine++;
        }

        $response = array("message" => "Order received successfully", "cart" => $cartData[0]["productName"]);
        echo json_encode($response); // Echo valid JSON response
    } else {
        $response = array("message" => "Error placing order");
        echo json_encode($response); // Echo valid JSON response for error
    }
}

$conn->close();
?>
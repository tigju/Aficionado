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

$user_name = $_SESSION['username'];
$user_id = $_SESSION['user_id'];


$userInfoQuery = "SELECT `first_name`, `last_name`, `street`, `city`, `state`, `zip`, `country` FROM `user` WHERE `user_id` = '$user_id'";
$res = $conn->query($userInfoQuery);

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $userInfoData = array(
        "first_name" => $row["first_name"],
        "last_name" => $row["last_name"],
        "street" => $row["street"],
        "city" => $row["city"],
        "state" => $row["state"],
        "zip" => $row["zip"],
        "country" => $row["country"]
    );
}

// Retrieve order history
$orderHistoryQuery = "SELECT `o`.`id`, `o`.`order_date`, `ol`.`product_name`, `ol`.`quantity`, `ol`.`price`
    FROM `user` `u`
    JOIN `orders` `o` ON `u`.`user_id` = `o`.`user_id`
    JOIN `order_lines` `ol` ON `o`.`id` = `ol`.`order_id`
    WHERE `u`.`user_id` = '$user_id'";
$res = $conn->query($orderHistoryQuery);


$orderHistoryData = array();

while ($row = $res->fetch_assoc()) {
    $order_id = $row["id"];
    $order_date = $row["order_date"];
    $product_name = $row["product_name"];
    $quantity = $row["quantity"];
    $price = $row["price"];

    if (!isset($orderHistoryData[$order_id])) {
        $orderHistoryData[$order_id] = array(
            "order_id" => $order_id,
            "order_date" => $order_date,
            "total_price" => 0,
            "order_lines" => array()
        );
    }

    $orderHistoryData[$order_id]["total_price"] += $price;

    $orderHistoryData[$order_id]["order_lines"][] = array(
        "product_name" => $product_name,
        "quantity" => $quantity,
        "price" => $price
    );
}

$responseData = array(
    "userInfo" => $userInfoData,
    "orderHistory" => array_values($orderHistoryData) // Re-index the array
);


header("Content-Type: application/json");
echo json_encode($responseData);


// $userInfo = "SELECT `u`.`first_name`,
//                     `u`.`last_name`, 
//                     `u`.`street`, 
//                     `u`.`city`,
//                     `u`.`state`, 
//                     `u`.`zip`, 
//                     `u`.`country`, 
//                     `o`.`id`, 
//                     `o`.`order_date`, 
//                     `ol`.`product_name`, 
//                     `ol`.`quantity`, 
//                     `ol`.`price` 
//             FROM `user` `u` 
//             JOIN `orders` `o` 
//                 ON `o`.`user_id` = `u`.`user_id` 
//             JOIN `order_lines` `ol` 
//                 ON `ol`.`order_id` = `o`.`id` 
//             WHERE `u`.`user_id` = '$user_id';";

// $userInfoHtml = ""; // Initialize user info HTML
// $orderHistoryHtml = ""; // Initialize order history HTML

// $res = $conn->query($userInfo);


// // Check if there are any rows in the result
// if ($res->num_rows > 0) {
//     // Retrieve user information once
//     $row = $res->fetch_assoc();
//     $userFirstName = $row["first_name"];
//     $userLastName = $row["last_name"];
//     $userStreet = $row["street"];
//     $userCity = $row["city"];


//     // Build user info HTML
//     $userInfoHtml = "<h1>Welcome, $userFirstName $userLastName</h1>";
//     $userInfoHtml .= "<p>Address: $userStreet, $userCity</p>";
  
//     $currentOrderId = null;
//     $currentOrderTotal = 0;

//     // Loop through each row in the result set
//     while ($row = $res->fetch_assoc()) {
//         $orderId = $row["id"];
//         $orderDate = $row["order_date"];
//         $productName = $row["product_name"];
//         $quantity = $row["quantity"];
//         $price = $row["price"];
        

//         if ($currentOrderId !== $orderId) {
//         // Close previous order if there was one
//           if ($currentOrderId !== null) {
//               $orderHistoryHtml .= "<tr><td colspan='5'>Total:</td><td>$currentOrderTotal</td></tr>";
//           }
          
//           // Start a new order
//           $currentOrderId = $orderId;
//           $currentOrderTotal = 0;
          
//           $orderHistoryHtml .= "<tr>";
//           $orderHistoryHtml .= "<td>Order ID: $orderId</td>";
//           $orderHistoryHtml .= "<td>Order Date: $orderDate</td>";
//           $orderHistoryHtml .= "</tr>";
//         }
//       // Update current order total
//       $currentOrderTotal += $price * $quantity;

//       // Add order line to the current order
//       $orderHistoryHtml .= "<tr>";
//       $orderHistoryHtml .= "<td>$productName</td>";
//       $orderHistoryHtml .= "<td>$quantity</td>";
//       $orderHistoryHtml .= "<td>$price</td>";
//       $orderHistoryHtml .= "<td>$quantity</td>";
//       $orderHistoryHtml .= "<td>$price</td>";
//       $orderHistoryHtml .= "</tr>";
//     }

//     // Close the last order
//     if ($currentOrderId !== null) {
//         $orderHistoryHtml .= "<tr><td colspan='5'>Total:</td><td>$currentOrderTotal</td></tr>";
//     }
// }

// // Create an array with the data to return as JSON
// $responseData = array(
//     "userInfo" => $userInfoHtml,
//     "orderHistory" => $orderHistoryHtml
// );

// // Send the data as JSON response
// header("Content-Type: application/json");
// echo json_encode($responseData);


$conn->close();
?>
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

//print("<br />Successfully connected to database:<strong> ".$database."</strong><br />");
//print("Using host:<strong> ".$hostname."</strong><br />");
//print("As the user:<strong> ".$db_user."</strong><br />");

session_start();

$username = $_POST['uname'];
$pass = md5($_POST['psw']);
$sql = "SELECT `id`, `email`, `password` FROM `login_info` WHERE `email` = '$username'";
$res = $conn->query($sql);


if ($res->num_rows > 0) {
  // output data of each row
  while($row = $res->fetch_assoc()) {
    if($pass != $row["password"]) {
      $_SESSION['login_error'] = "Incorrect username or password";
      header("Location: login_form.php");
    } else {
      $_SESSION['success_message'] = "logged in successfully";
      $_SESSION['username'] = $username;
      $_SESSION['user_id'] = $row['id'];
      header("Location: main.php");
    }
  }
} else {
    // Redirect to the main page
    $_SESSION['login_error'] = "You don't have an account";
    header("Location: login_form.php");
    exit(); // Make sure to exit after sending the header
}

// echo $username;
// $select = "SELECT * FROM `login_info` WHERE `email` = '$username'";
// $res = $conn->query($select)
// if ( $res->num_rows > 0) {
//   echo "Hello". $username;
// } else {
//   echo "Error: " . $select . "<br>" . $conn->error;
// }

$conn->close();

?>
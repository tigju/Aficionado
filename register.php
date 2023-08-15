<?php

$hostname = 'localhost'; // specify host domain or IP, i.e. 'localhost' or '127.0.0.1' or server IP 'xxx.xxxx.xxx.xxx'
$database = 'project'; // specify database name
$db_user = 'root'; // specify username
$db_pass = 'root';
$port = 8889;

$conn = mysqli_connect("$hostname" , "$db_user" , "$db_pass", "$database", "$port");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}    

print "<br />Successfully connected to database:<strong> ".$database."</strong><br />";
print "Using host:<strong> ".$hostname."</strong><br />";
print "As the user:<strong> ".$db_user."</strong><br />";

session_start();

$first = $_POST['fname'];
$last = $_POST['lname'];
$email = $_POST['email'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$pass = md5($_POST['psw']);
// $rpass = md5($_POST['rpsw']);
$date = date('Y-m-d H:i:s');

$select = "SELECT `email` FROM `login_info` WHERE `email` = '$email'";
$res = $conn->query($select);

if ($res->num_rows > 0) {
  $_SESSION['register_error'] = "Account already exists!";
      header("Location: register_form.php");  
      exit();
}
//   // output data of each row
//   // while($row = $res->fetch_assoc()) {
//   //   if($email == $row["email"]) {
//     echo "user exists!";
//       $_SESSION['register_error'] = "User with this email already exists!";
//       header("Location: register_form.php");
//       exit();
//     // } 
//   // }
// }

$insertLoginInfo = "INSERT INTO `login_info`(`email`, `password`) VALUES ('$email','$pass')";

if ($conn->query($insertLoginInfo) === TRUE) {
  echo "New record created successfully in login info table";
  $userId = $conn->insert_id;
} else {
  echo "Error: " . $insertLoginInfo . "<br>" . $conn->error;
}

$insertUser = "INSERT INTO `user`(`user_id`,`first_name`, `last_name`, `street`, `city`, `state`, `zip`, `country`) VALUES ('$userId', '$first','$last','$street','$city ','$state', '$zip', 'United States')";

if ($conn->query($insertUser) === TRUE) {
  echo "New record created successfully in user table";
  $_SESSION['register_success'] = "Registration sucessful, you can log in now.";
  header("Location: login_form.php");
  
} else {
  echo "Error: " . $insertUser . "<br>" . $conn->error;
}

$conn->close();

?>
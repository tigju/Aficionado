<?php
session_start();

if(isset($_SESSION['username'])) {
    $uname = $_SESSION['username'];
    $welcome = "Welcome back, ". $uname;
} else {
    header("Location: login_form.php"); // Redirect to your login page
    exit();
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Aficionado</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js.js"></script>
</head>

<body>
    
    <header class="header">
        <a href="#" class="logo"><img src="images/aficionado3.png" alt="logo">
        <nav class="navbar">
            <a href="main.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="main.php#about">About</a>
            <a href="main.php#contact">Contact</a>
            <a href="#">My Account</a>
        </nav>
        <?php
            if (!empty($welcome)) {
                echo "<span class='welcome'>$welcome</span>";
            }
            if (!empty($uname)) {
                echo "<a href='logout.php' id='logout' class='logout btn'>Logout</a>";
            } else {
                echo "<a href='login_form.php' class='login btn'>Login</a>";
            }
        ?>
        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>
        <div class="search-form">
            <input type="search" id="search-box" placeholder="Search...">
            <label for="search-box" class="fas fa-search"></label>
        </div>
        <div class="cart-items-container">

        </div>
    </header>
    <section class="account" id="account">
        <h1 class="heading">My <span>account</span></h1>
        <div id="user-info"></div>
        <div class="orders-container">
            <h3>Order <span>history</span></h3>
            <div id="order-history"></div>
        </div>
    </section>
    
    <section class="footer">
        <div class="shar">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>
        <div class="links">
            <a href="main.php#home">Home</a>
            <a href="main.php#about">About</a>
            <a href="menu.php">Menu</a>
            <a href="main.php#contact">Contact</a>
            <a href="#">My Account</a>
        </div>
        <div class="cre" >2023 | all rights reserved</div>
    </section>  
</body>

</html>
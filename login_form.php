<?php
session_start();

$errorMessage = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : "";
unset($_SESSION['login_error']); // Clear the error message after displaying it
$successMessage = isset($_SESSION['register_success']) ? $_SESSION['register_success'] : "";
unset($_SESSION['register_success']);

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

</head>

<body>

    <header class="header">
        <a href="main.php" class="logo"><img src="images/aficionado3.png" alt="logo">
            <nav class="navbar">
                <a href="main.php">Home</a>
                <a href="main.php#about">About</a>
                <a href="menu.php">Menu</a>
                <a href="main.php#contact">Contact</a>
            </nav>
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
                <!-- <div class="cart-item">
                    <span class="fas fa-times"></span>
                    <img src="images/logo.png" alt="">
                    <div class="content">
                        <h3>cart item 1</h3>
                        <div class="price">$5.00</div>
                    </div>
                </div>


                <div class="cart-item">
                    <span class="fas fa-times"></span>
                    <img src="images/logo.png" alt="">
                    <div class="content">
                        <h3>cart item 2</h3>
                        <div class="price">$6.00</div>
                    </div>
                </div>
                <a href="#" class="btn">Checkout</a> -->
            </div>
    </header>
    <section class="login" id="login">
        <div class="row">
            <form name="login" action="login.php" method="POST">
                <h3>Log In</h3>
                <?php
                    if (!empty($errorMessage)) {
                        echo "<p style='color: red;'>$errorMessage</p>"; // Display the error message if it's not empty
                    }
                
                    if (!empty($successMessage)) {
                        echo "<p style='color: green;'>$successMessage</p>"; 
                    }
                ?>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="Email" name="uname" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-key"></span>
                    <input type="password" placeholder="Password" name="psw" required>
                </div>
                <input type="submit" value="Log In" class="btn">
                <div class='no-acc'>Dont have account? <a href='register_form.php'>Register here</a></div>
            </form>    
        </div>
        
    </section>
    <script src="js.js"></script>
</body>

</html>
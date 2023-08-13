<?php
session_start();

if(isset($_SESSION['username'])) {
    $uname = $_SESSION['username'];
    $welcome = "Welcome back, ". $uname;
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

</head>

<body>

    <header class="header">
        <a href="#" class="logo"><img src="images/aficionado3.png" alt="logo" >
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="menu.php">Menu</a>
                <a href="#contact">Contact</a>
                <a href="account.php">My Account</a>
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
                <!-- <a href="#" id="checkout" class="btn" style="display: none">Checkout</a> -->
            </div>

    </header>
    <section class="home" id="home">
        <div class="content">
            <h3>Fresh Coffee</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error neque quas saepe officia accusantium facere quidem esse inventore quasi asperiores minus magnam voluptas, sunt enim. Tenetur delectus culpa aliquam iure?</p>
            <a href="menu.php" class="btn">get yours now</a>
        </div>
    </section>
    <section class="about" id="about">
        <h1 class="heading"><span>About</span> us</h1>
        <div class="row">
            <div class="image">
                <img src="images/logo.png" alt="">
            </div>
            <div class="content">
                <h3>What makes our coffee special?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla recusandae sequi illo eaque nesciunt quaerat at aliquid minima, id tempora dolorum nam! Impedit eligendi neque harum perspiciatis. Enim, blanditiis similique!</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis, architecto. Laudantium, facilis corporis! Perspiciatis nemo, facilis recusandae provident repellendus eos voluptates ipsum error hic? Dolore excepturi harum possimus repellendus quos.</p>
                <a class="btn">Learn more</a>
            </div>
        </div>
    </section>

    <!--contact section-->
    <section class="contact" id="contact">
        <h1 class="heading"><span>Contact</span> us </h1>
        <div class="row">
    
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4326.18702696619!2d-73.95464172481577!3d40.631534963270425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0e68bf8bc1%3A0x487ac68137fac784!2sBrooklyn%20College!5e0!3m2!1sen!2sus!4v1691633280310!5m2!1sen!2sus"
                width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
    
            <form action="">
                <h3>Contact us</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="name">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="email">
                </div>
                
                <input type="submit" value="Contact now" id="contact" class="btn">
            </form>
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
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="menu.php">Menu</a>
            <a href="#contact">Contact</a>
            <a href="account.php">My Account</a>
        </div>
        <div class="cre" >2023 | all rights reserved</div>
    </section>
    <script src="js.js"></script>
</body>

</html>
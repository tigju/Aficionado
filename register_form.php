<?php
session_start();

$errorMessage = isset($_SESSION['register_error']) ? $_SESSION['register_error'] : "";
unset($_SESSION['register_error']); // Clear the error message after displaying it

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
                <a href="menu.php">Products</a>
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
    <section class="signup" id="signup">
        <div class="row">   
            <form name="signup" action="register.php" method="POST">
                <h3>Sign Up</h3>
                <?php
                    if (!empty($errorMessage)) {
                        echo "<p style='color: red;'>$errorMessage</p>"; // Display the error message if it's not empty
                    }
                ?>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="First name" name="fname" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="Last name" name="lname" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-house"></span>
                    <input type="text" placeholder="Street" name="street" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-house"></span>
                    <input type="text" placeholder="City" name="city" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-house"></span>
                    <select name="state">
                        <option value="">- State -</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span class="fas fa-hashtag"></span>
                    <input type="number" placeholder="Zip Code" name="zip" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-key"></span>
                    <input type="password" placeholder="Password" name="psw" required>
                </div>
                <div class="inputBox">
                    <span class="fas fa-key"></span>
                    <input type="password" placeholder="Repeat Password" name="rpsw" required>
                </div>
                <input type="submit" value="Sign Up" class="btn">
            </form>
        </div>
    </section>
    <script src="js.js"></script>
</body>

</html>
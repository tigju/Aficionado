let productItem = [{
    id: 1,
    productName: "Turkish style coffee",
    price: "5.00",
    photo: "images/turkish.jpg"
},
{
    id: 2,
    productName: "Ethiopian Coffee",
    price: "6.00",
    photo: "images/ethiopian.jpeg"
},
{
    id: 3,
    productName: "Brazilian Style",
    price: "5.50",
    photo: "images/brazilian.jpeg"
},
{
    id: 4,
    productName: "Jamaican Blue Mountain",
    price: "7.00",
    photo: "images/jamaican.jpeg"
},
{
    id: 5,
    productName: "Café de Olla (Mexican)",
    price: "7.55",
    photo: "images/mexican.jpeg"
},
{
    id: 6,
    productName: "Rwandan Coffee",
    price: "5.75",
    photo: "images/rwanda.jpeg"
},
{
    id: 7,
    productName: "Sumatra Coffee",
    price: "6.75",
    photo: "images/samarta.jpeg"
},
{
    id: 8,
    productName: "Latte",
    price: "9.75",
    photo: "images/latte.jpeg"
},
{
    id: 9,
    productName: "Hawaiian Kona Coffee",
    price: "6.00",
    photo: "images/hawaii.jpeg"
}];


document.addEventListener('DOMContentLoaded', function() {


    localStorage.setItem("products", JSON.stringify(productItem));
    if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", "[]");
    }


    // global vars
    let products = JSON.parse(localStorage.getItem("products"));
    let cart = JSON.parse(localStorage.getItem("cart"));
    let navbar = document.querySelector('.navbar');
    let cartItems = document.querySelector('.cart-items-container');
    let searchForm = document.querySelector('.search-form');
    const productsContainer = document.querySelector("#menu .box-container");
    let logout = document.getElementById('logout');
   

    // Event Listeners
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('fa-times')) {
            const parentElement = event.target.closest('.cart-item');
            // console.log(parentElement);
            if (parentElement) {
                const parentId = parentElement.dataset.id;
                console.log(parentId);
                removeItemFromCart(parentId);
                showCart();
            }
        }
        else if (event.target.classList.contains('add-to-cart')) {
            const parentElement = event.target.closest('.box');
            if (parentElement) {
                const parentId = parentElement.dataset.id;
                // console.log(parentId);
                let toCart = document.createElement('span')
                toCart.classList.add("temp-to-cart");
                toCart.innerHTML = "<br>Added to cart"
                parentElement.appendChild(toCart);
                addItemToCart(parentId);
                showCart();

                setTimeout(removeMessage, 3000);
            }
        }

        else if (event.target.id == 'contact') {
            window.alert("Thanks for contacting us!<br>We will get back to you soon.");
        }

        if (event.target.id == "checkout") {
            if (!(document.querySelector('.welcome'))) {
                window.location.href = "login_form.php";
            }
            else {
                window.alert("Your order was placed!")
                window.location.href = "account.php";
                const dataToSend = {
                    cart: cart,
                    
                };

                const cartData = dataToSend.cart;
                console.log("Sending data:", cartData);
                fetch("cart.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: new URLSearchParams({ cart: JSON.stringify(cartData) }),
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Response from PHP:", data.message);
                        console.log("Cart Data:", data.cart);
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
                
                clearCart();
                showCart();
            }
        }
    });



    if (logout) {
        logout.addEventListener('click', function () {
        clearCart(); // Call the function to clear the cart
        showCart();
        });
    }

    document.querySelector('#menu-btn').onclick = () => {
        navbar.classList.toggle('active');
        searchForm.classList.remove('active');
        cartItems.classList.remove('active');
    }


    document.querySelector('#search-btn').onclick = () => {
        searchForm.classList.toggle('active');
        navbar.classList.remove('active');
        cartItems.classList.remove('active');
    }


    document.querySelector('#cart-btn').onclick = () => {
        cartItems.classList.toggle('active');
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
    }

    window.onscroll = () => {
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
        // cartItems.classList.remove('active');
    }


    // functions
    // add item to array
    function addItemToCart(productId) {
        let product = products.find(function(product){
            return product.id == productId;
        });

        if(cart.length == 0) {
            cart.push(product);
        } else {
            let res = cart.find(element => element.id == productId);
            if (res === undefined) {
                cart.push(product);
            }
        }

        localStorage.setItem("cart", JSON.stringify(cart));
    }

        // addItemToCart(1);
        // addItemToCart(2);
        // addItemToCart(3);

    // remove product from cart

    function removeItemFromCart(productId) {

        cart = cart.filter(item => item.id != productId);
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    // removeItemFromCart("one");


    function getTotal() {
        let temp = cart.map(function(item){
            return parseFloat(item.price);
        });

        let sum = temp.reduce(function(prev, next) {
            return prev + next;
        }, 0);

        return sum;
    }

    function clearCart() {
        localStorage.removeItem('cart'); // Remove the cart data from local storage
        cart = [] 
    }


    // this i to show the menu
    function renderProductMenu() {
        //Iterate javascript products array
        if (productsContainer) {
            products.forEach(function (item) {
            // console.log(item.id);
            const boxElement = document.createElement('div');
            boxElement.dataset.id = item.id;
            boxElement.classList.add("box");
            const prodImage = document.createElement('img');
            prodImage.src = item.photo
            boxElement.appendChild(prodImage)
            const h3tag = document.createElement('h3');
            h3tag.innerText = item.productName;
            boxElement.appendChild(h3tag);
            const priceDiv = document.createElement('div');
            priceDiv.classList.add("price");
            priceDiv.innerText = '$' + item.price
            boxElement.appendChild(priceDiv);
            const aTag = document.createElement('a');
            aTag.classList.add("btn", "add-to-cart");
            aTag.innerText = 'Add to Cart';
            boxElement.appendChild(aTag);

            productsContainer.appendChild(boxElement);

            });
        }
        
    }

    // this i to show the menu
    function showCart() {
        cartItems.innerHTML = '';
        //Iterate javascript shopping cart array
        let productHTML = "";
        if(cart.length > 0) {
            cart.forEach(function (item) {
                productHTML +=
                    '<div class="cart-item" data-id='+item.id +'>' +
                    '<span class="fas fa-times"></span>' +
                    '<img src="' + item.photo + '">' +
                    '<div class="content">' +
                    '<h3>' + item.productName + '</h3>' +
                    '<div class="price">$' + item.price + '</div>' +
                    '</div></div>';
            });
            productHTML += '<div class="foot"> Total: <span id="total">$' + getTotal() + '</span>';
            productHTML += '<a href="#" id="checkout" class="btn">Checkout</a>';
        } else {
            productHTML += '<h3>Cart is Empty</h3><a href="#" id="checkout" class="btn" style="display: none">Checkout</a>'
        };
        

        cartItems.innerHTML = productHTML;
    }


    // function clearElement(element) {
    //     while (element.firstChild) {
    //         element.removeChild(element.firstChild)
    //     }
    // }
    function fetchUserDataAndOrderHistory() {
        fetch("account_data.php")
            .then(response => response.json())
            .then(data => {
                // Update user info
                const userInfoDiv = document.getElementById("user-info");
                userInfoDiv.innerHTML = `<h1>Welcome, ${data.userInfo.first_name} ${data.userInfo.last_name}</h1>
                                         <p>Address: ${data.userInfo.street}, ${data.userInfo.city}</p>`;

                // Update order history
                const orderHistoryDiv = document.getElementById("order-history");
                orderHistoryDiv.innerHTML = data.orderHistory.map(order => `
                    <div class="order">
                        
                        <span class="ord_num">Order ID: ${order.order_id}&emsp;Order Date: ${order.order_date.split(' ')[0] }</span><br>

                        ${order.order_lines.map(orderLine => `
                                        
                                            <span>${orderLine.product_name}&emsp;</span>
                                            <span>Quantity: ${orderLine.quantity}&emsp;</span>
                                            <span>Price: $ ${orderLine.price}</span><br>
                            `).join('')}
                            
                            
                            <br><span class='total-price'>Total Price: $ ${order.total_price}</span>
                        
                    </div>`).join('');
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    function removeMessage() {
        const messageElement = document.querySelector(".temp-to-cart"); // Adjust the selector as needed
        if (messageElement) {
            messageElement.remove();
        }
    }

    // Call the function to fetch and display data
    fetchUserDataAndOrderHistory();


    showCart();
    renderProductMenu();

});
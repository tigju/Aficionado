let productItem = [{
    id: 1,
    productName: "Coffee 1",
    price: "5.00",
    photo: "images/1595970.webp"
},
{
    id: 2,
    productName: "Coffee 2",
    price: "6.00",
    photo: "images/1595970.webp"
},
{
    id: 3,
    productName: "Coffee 3",
    price: "5.50",
    photo: "images/1595970.webp"
},
{
    id: 4,
    productName: "Coffee 4",
    price: "7.00",
    photo: "images/1595970.webp"
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
                addItemToCart(parentId);
                showCart();
            }
        }

        else if (event.target.id == 'contact') {
            window.alert("Thanks for contacting us!<br>We will get back to you soon.");
        }

        if (event.target.id == "checkout") {
            window.alert("Your order was placed!")
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

    // function ShowProductMenu() {
    //     //Iterate javascript shopping cart array
    //     let productHTML = "";
    //     products.forEach(function (item) {
    //         productHTML +=
    //             '<div class="box">' +
    //             '<img src="' + item.photo + '">' +
    //             '<h3>' + item.productName + '</h3>' +
    //             '<div class="price">$' + item.price + '</div>' +
    //             '<a href="#" class="btn add-to-cart">Add to cart</a>' +
    //             '</div>';


    //     });
    //     document.querySelector('.box-container').innerHTML = productHTML;
    // }

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


    function clearElement(element) {
        while (element.firstChild) {
            element.removeChild(element.firstChild)
        }
    }


    showCart();
    renderProductMenu();

});
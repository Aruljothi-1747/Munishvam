<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WWW.Grandma'sGold.com</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">  -->

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="dist/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="dist/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="dist/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->
    <!-- Navbar start -->

    <div class="container  ">
        <nav class="navbar navbar-light bg-white navbar-expand-lg " style="Padding-top: 35px;">
            <!-- Right Side: Navbar Toggler -->
            <a class="navbar-toggler " id="navbar-icon" style="margin-left: 0!important;">
                <span class="fa fa-bars text-primary"></span>
            </a>
            <div id="navbar-sidebar" class="position-fixed bg-white end-0 top-0 vh-100 shadow-lg p-0"
                style="width: 300px; transform: translateX(100%); transition: transform 0.3s;">

                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Main Menu</h4>
                        <button id="close-navbar-sidebar" class="btn-close"></button>
                    </div>
                    <div class="row">
                        <!-- User Information Column -->
                        <div class="col-md-4">
                            @auth
                            <p>{{ Auth::user()->name }}</p>
                            @else
                            <p>Guest</p>
                            @endauth
                        </div>

                        <!-- Order Details Column -->
                        <div class="col-md-4">
                            <a href="order-details.html" class="dropdown-item" style="padding: 10px;">
                                <i class="fas fa-shopping-cart"></i> Order Details
                            </a>
                        </div>

                        <!-- Account and Login Column -->
                        <div class="col-md-4">
                            @auth
                            <a href="{{ route('App.AccountDetails', ['id' => Auth::user()->id]) }}"
                                class="dropdown-item" style="padding:10px;">
                                <i class="fas fa-user"></i> My Account
                            </a>
                            <a class="my-auto" onclick="showLogoutModal(event)" style="padding:10px;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            @else
                            <a href="{{ route('user.login') }}" class="dropdown-item" style="padding:10px;">
                                <i class="fas fa-user"></i> My Account
                            </a>
                            <a href="{{ route('user.login') }}" style="padding:10px;" class=" my-auto">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <div id="navbar-backdrop" class="backdrop" style="z-index: 1030;"></div>
            <!-- Center: Brand Name -->
            <a href="#" class="mx-auto text-center">
                <h1 class="text-primary display-8 m-0">Grandma'sGold</h1>
            </a>
            <!-- <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Grandma'sGold</h1></a> -->
            <a href="#" class="me-auto  cart-icon" style="margin-right: 0!important;" id="cart-icon">
                <i class="fa fa-shopping-bag fa-2x"></i>
            </a>


            <div id="cart-sidebar" class="position-fixed bg-white end-0 top-0 vh-100 shadow-lg p-4"
                style="width: 300px; transform: translateX(100%); transition: transform 0.3s;">

                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Cart Details</h4>
                        <button id="close-cart-sidebar" class="btn-close"></button>
                    </div>
                    <div id="cart-items1">
                        <p>Your cart is empty.</p>
                    </div>
                    <div id="cart-footer" class="mt-4 ">
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Total:</h5>
                            <h5 id="cart-total">$0</h5>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">Checkout</button>
                    </div>
                </div>
            </div>
            <div id="cart-backdrop" class="backdrop" style="z-index: 1040;"></div>

            <div class="collapse navbar-collapse " id="navbarCollapse">
                <div class="navbar-nav mx-auto">

                    <a href="{{ route('app.cashew_Layout') }}" class="nav-item nav-link active">Home</a>

                </div>
                <div class="d-flex m-3 me-0">

                    <a href="#" class="position-relative me-4 my-auto" data-bs-toggle="dropdown">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px">3</span>
                    </a>

                    <div id="cart-sidebar-2"
                        class="dropdown-menu position-fixed bg-white end-0 top-0 vh-100 shadow-lg p-4"
                        style="width: 300px; transform: translateX(100%); transition: transform 0.3s; margin-left:900px;">

                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Cart Details</h4>
                                <button id="close-cart-sidebar" class="btn-close"></button>
                            </div>
                            <div id="cart-items">
                                <p>Your cart is empty.</p>
                            </div>
                            <div id="cart-footer" class="mt-4 ">
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Total:</h5>
                                    <h5 id="cart-total">$0</h5>
                                </div>
                                <button class="btn btn-primary w-100 mt-3">Checkout</button>
                            </div>
                        </div>
                    </div>

                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let cartTotal = 0;

                        // Function to update the total price
                        function updateTotal() {
                            const cartTotalElement = document.getElementById("cart-total");
                            cartTotalElement.innerText = `₹${cartTotal}`;
                        }

                        // Add to Cart functionality
                        document.querySelectorAll(".add-to-cart").forEach(button => {
                            button.addEventListener("click", function() {
                                const productId = this.dataset.id;
                                const productName = this.dataset.name;
                                const productPrice = parseFloat(this.dataset.price);

                                // Get both cart containers
                                const cartItems = document.getElementById("cart-items");
                                const cartItems1 = document.getElementById("cart-items1");

                                // Function to add product to a specific cart
                                function addToCart(cartContainer) {
                                    let cartEmptyMessage = cartContainer.querySelector("p");
                                    if (cartEmptyMessage) {
                                        cartEmptyMessage
                                            .remove(); // Remove "Your cart is empty" message
                                    }

                                    // Check if the item already exists in the cart
                                    const existingItem = cartContainer.querySelector(
                                        `[data-id="${productId}"]`);
                                    if (existingItem) {
                                        alert("This item is already in the cart!");
                                        return;
                                    }

                                    // Create product row with remove functionality
                                    const productRow = document.createElement("div");
                                    productRow.className =
                                        "d-flex justify-content-between align-items-center mb-3";
                                    productRow.innerHTML = `
                    <div>
                        <h6 class="mb-0">${productName}</h6>
                        <small class="text-muted">₹${productPrice}</small>
                    </div>
                    <button class="btn btn-danger btn-sm remove-item" data-id="${productId}">Remove</button>
                `;
                                    productRow.dataset.id = productId;
                                    cartContainer.appendChild(productRow);

                                    // Update the cart total
                                    cartTotal += productPrice;
                                    updateTotal();

                                    // Remove from cart functionality
                                    productRow.querySelector(".remove-item").addEventListener(
                                        "click",
                                        function() {
                                            productRow.remove();

                                            // Check if cart is empty and update message
                                            if (cartContainer.children.length === 0) {
                                                cartContainer.innerHTML =
                                                    '<p>Your cart is empty.</p>';
                                            }

                                            // Update the total
                                            cartTotal -= productPrice;
                                            updateTotal();
                                        });
                                }

                                // Check if both carts are empty and add item to the first available cart
                                if (cartItems.children.length === 1) {
                                    addToCart(cartItems); // Add to cart-items if it's empty
                                } else if (cartItems1.children.length === 1) {
                                    addToCart(cartItems1); // Add to cart-items1 if it's empty
                                } else {
                                    alert("Both carts are already filled!");
                                }

                                // Change the button state to "Added"
                                this.innerHTML =
                                    '<i class="fa fa-check me-2 text-success"></i>Added';
                                this.classList.remove("btn-outline-secondary");
                                this.classList.add("btn-success");
                                this.disabled = true;
                            });
                        });

                        // Close cart sidebar functionality
                        document.getElementById("close-cart-sidebar").addEventListener("click", function() {
                            document.getElementById("cart-sidebar").style.transform =
                                "translateX(100%)";
                        });

                        // Checkout functionality with form validation
                        document.getElementById("checkout-btn").addEventListener("click", function() {
                            if (cartTotal === 0) {
                                alert("Your cart is empty. Please add items to proceed with checkout.");
                                return;
                            }

                            // You can add further validation here, such as checking for the user's address or payment details.
                            alert("Proceeding to checkout!");
                        });
                    });
                    </script>
                    <a href="#" class="my-auto" data-bs-toggle="dropdown">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                    <div class="dropdown-menu position-fixed bg-white end-0 top-0 vh-100 shadow-lg p-4"
                        style="width: 300px; transform: translateX(100%); transition: transform 0.3s; margin-left:900px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Main Menu</h4>
                            <button id="close-cart-sidebar" class="btn-close"></button>
                        </div>
                        @auth
                        <p>{{ Auth::user()->name }}</p>
                        @else
                        <p>Guest</p>
                        @endauth
                        <a href="order-details.html" class="dropdown-item" style="padding: 10px;">
                            <i class="fas fa-shopping-cart"></i> Order Details
                        </a>
                        @auth
                        <a href="{{ route('app.accountdetails', ['id' => Auth::user()->id]) }}" class="dropdown-item"
                            style="padding:10px;">
                            <i class="fas fa-user"></i> My Account
                        </a>
                        @else
                        <a href="{{ route('user.login') }}" class="dropdown-item" style="padding:10px;">
                            <i class="fas fa-user"></i> My Account
                        </a>
                        @endauth
                        @auth
                        <a href="#" class="my-auto text-decoration-none">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        @else
                        <a href="{{ route('user.login') }}" style="padding:10px;" class="my-auto">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        @endauth
                    </div>


                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    <section class="content">
        @yield('maincontent')
    </section>

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i
                                class="fas fa-copyright text-light me-2"></i>WWW.Grandma'sGold.com</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">Grandma'sGold</a> Distributed By
                    <a class="border-bottom" href="https://themewagon.com">Grandma'sGold</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="dist/lib/easing/easing.min.js"></script>
    <script src="dist/lib/waypoints/waypoints.min.js"></script>
    <script src="dist/lib/lightbox/js/lightbox.min.js"></script>
    <script src="dist/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="dist/js/main.js"></script>
    <script>
    // Cart Sidebar
    const cartIcon = document.getElementById('cart-icon');

    const cartSidebar = document.getElementById('cart-sidebar');
    const closeCartSidebar = document.getElementById('close-cart-sidebar');
    const cartBackdrop = document.getElementById('cart-backdrop');

    cartIcon.addEventListener('click', (e) => {
        e.preventDefault();
        cartSidebar.style.transform = 'translateX(0)';
        cartBackdrop.style.display = 'block';
    });

    closeCartSidebar.addEventListener('click', () => {
        cartSidebar.style.transform = 'translateX(100%)';
        cartBackdrop.style.display = 'none';
    });

    cartBackdrop.addEventListener('click', () => {
        cartSidebar.style.transform = 'translateX(100%)';
        cartBackdrop.style.display = 'none';
    });

    // Navbar Sidebar
    const navbarIcon = document.getElementById('navbar-icon');
    const navbarSidebar = document.getElementById('navbar-sidebar');
    const closeNavbarSidebar = document.getElementById('close-navbar-sidebar');
    const navbarBackdrop = document.getElementById('navbar-backdrop');

    navbarIcon.addEventListener('click', (e) => {
        e.preventDefault();
        navbarSidebar.style.transform = 'translateX(0)';
        navbarBackdrop.style.display = 'block';
    });

    closeNavbarSidebar.addEventListener('click', () => {
        navbarSidebar.style.transform = 'translateX(100%)';
        navbarBackdrop.style.display = 'none';
    });

    navbarBackdrop.addEventListener('click', () => {
        navbarSidebar.style.transform = 'translateX(100%)';
        navbarBackdrop.style.display = 'none';
    });
    </script>
    <style>
    .cart-icon {
        display: block;
    }

    /* Hide on large screens (≥992px) */
    @media (min-width: 992px) {
        .cart-icon {
            display: none;
        }
    }
    </style>

</body>

</html>



<div id="cart-sidebar" class="position-fixed bg-white end-0 top-0 vh-100 shadow-lg p-4"
    style="width: 350px; transform: translateX(100%); transition: transform 0.3s;">
    <div class="cart-header d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-primary">Shopping Cart</h4>
        <button id="close-cart-sidebar" class="btn-close"></button>
    </div>
    <div id="cart-items" class="cart-items-container">
        <!-- Placeholder for dynamic items -->
        <p class="empty-cart-message text-center text-muted">Your cart is empty.</p>
    </div>
    <div id="cart-footer" class="mt-4">
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Total:</h5>
            <h5 id="cart-total" class="text-success">₹0.00</h5>
        </div>
        <button class="btn btn-primary w-100">Proceed to Checkout</button>
    </div>
</div>
<div id="cart-backdrop" class="backdrop" style="z-index: 1040; display: none;"></div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const cartSidebar = document.getElementById("cart-sidebar");
    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    // Add to Cart functionality
    document.querySelectorAll(".add-to-cart").forEach((button) => {
        button.addEventListener("click", function() {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productPrice = parseFloat(this.dataset
                .price); // Ensure price is numeric
            const productImage = this.dataset.product_image;

            // Check if the product is already in the cart
            if (cartItems.querySelector(`.product-${productId}`)) {
                alert("This product is already in your cart.");
                return;
            }

            // Add product to cart
            const productRow = document.createElement("div");
            productRow.className =
                `d-flex justify-content-between align-items-center mb-3 product-row product-${productId}`;

            productRow.innerHTML = `
                      <div class="product-info d-flex align-items-center">
                    <img src="${productImage}" alt="${productName}" class="cart-product-image me-2" style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                        <h6 class="mb-0">${productName}</h6>
                        <small class="product-price text-muted" data-price="${productPrice}">₹${productPrice.toFixed(2)}</small>
                    </div>
                    </div>
                   <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary btn-sm quantity-decrease">-</button>
                    <input type="text" value="1" class="form-control text-center mx-2 product-quantity" style="width: 50px;" readonly>
                    <button class="btn btn-outline-secondary btn-sm quantity-increase">+</button>
                    </div>
                   <button class="btn btn-danger btn-sm remove-item" data-id="${productId}">
                    <i class="fas fa-trash-alt"></i>
                   </button>
                      `;

            cartItems.appendChild(productRow);

            // Remove the "Your cart is empty" message if present
            const emptyMessage = cartItems.querySelector(".empty-cart-message");
            if (emptyMessage) emptyMessage.remove();

            // Update button to show added state
            this.innerHTML = '<i class="fa fa-check me-2 text-success"></i>Added';
            this.classList.replace("btn-outline-secondary", "btn-success");
            this.disabled = true;

            // Add event listeners for the new product row
            addProductRowListeners(productRow);

            // Update the total price
            updateTotal();
        });
    });

    // Add event listeners for product row
    function addProductRowListeners(row) {
        // Increase quantity
        row.querySelector(".quantity-increase").addEventListener("click", function() {
            const quantityInput = row.querySelector(".product-quantity");
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotal();
        });

        // Decrease quantity
        row.querySelector(".quantity-decrease").addEventListener("click", function() {
            const quantityInput = row.querySelector(".product-quantity");
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotal();
            }
        });

        // Remove item
        row.querySelector(".remove-item").addEventListener("click", function() {
            const productId = this.dataset.id;

            // Reset the Add to Cart button
            const addButton = document.querySelector(
                `.add-to-cart[data-id="${productId}"]`);
            if (addButton) {
                addButton.innerHTML =
                    '<i class="fa fa-shopping-cart me-2 text-primary"></i>Add to Cart';
                addButton.classList.replace("btn-success", "btn-outline-secondary");
                addButton.disabled = false;
            }

            // Remove the product row
            row.remove();

            // Show empty message if cart is empty
            if (cartItems.children.length === 0) {
                cartItems.innerHTML =
                    '<p class="empty-cart-message text-center text-muted">Your cart is empty.</p>';
            }

            // Update the total price
            updateTotal();
        });
    }

    // Function to update the total price
    function updateTotal() {
        let total = 0;
        const cartRows = cartItems.querySelectorAll(".product-row");

        cartRows.forEach((row) => {
            const price = parseFloat(row.querySelector(".product-price").dataset.price);
            const quantity = parseInt(row.querySelector(".product-quantity").value);
            total += price * quantity;
        });

        cartTotal.textContent = `₹${total.toFixed(2)}`;
    }

    // Close cart sidebar
    document.getElementById("close-cart-sidebar").addEventListener("click", function() {
        cartSidebar.style.transform = "translateX(100%)";
    });
});
</script>
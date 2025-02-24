<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WWW.Munishvam.com</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <nav class="navbar navbar-light bg-white navbar-expand-lg " style="Padding-top: 35px;">
            <!-- Right Side: Navbar Toggler -->
            <a class="navbar-toggler " id="navbar-icon" style="margin-left: 0!important;">
                <span class="fa fa-bars text-primary"></span>
            </a>
            <div id="navbar-sidebar" class="position-fixed bg-white end-0 top-0 vh-100 shadow-lg p-4"
                style="width: 300px; transform: translateX(100%); transition: transform 0.3s;">

                <div class="d-flex justify-content-between align-items-center">
                    <h4>Main Menu</h4>
                    <button id="close-navbar-sidebar" class="btn-close"></button>
                </div>
                @auth
                <p>{{ Auth::user()->name }}</p>
                @else
                <p>Guest</p>
                @endauth
                @auth
                <a href="{{ route('app.accountdetails', ['id' => Auth::user()->id]) }}" class="dropdown-item"
                    style="padding: 10px;">
                    <i class="fas fa-shopping-cart"></i> Order Details
                </a>
                @else
                <a href="{{ route('otp.login') }}" class="dropdown-item" style="padding:10px;">
                    <i class="fas fa-user"></i> Order Details
                </a>
                @endauth

                @auth
                <a href="{{ route('app.accountdetails', ['id' => Auth::user()->id]) }}" class="dropdown-item"
                    style="padding:10px;">
                    <i class="fas fa-user"></i> My Account
                </a>
                @else
                <a href="{{ route('otp.login') }}" class="dropdown-item" style="padding:10px;">
                    <i class="fas fa-user"></i> My Account
                </a>
                @endauth
                @auth
                <a href="{{ route('logout') }}" class="dropdown-item" style="padding:10px;"
                    onclick="return confirmLogout(event)">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <script>
                function confirmLogout(event) {
                    // Show a confirmation alert
                    if (confirm("Are you sure you want to log out?")) {
                        return true; // Proceed with the logout
                    } else {
                        event.preventDefault(); // Cancel the logout
                        return false;
                    }
                }
                </script>
                @else
                <a href="{{ route('otp.login') }}" style="padding:10px;" class="dropdown-item">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>

                @endauth

            </div>
            <div id="navbar-backdrop" class="backdrop" style="z-index: 1030;"></div>
            <!-- Center: Brand Name -->
            <a href="#" class="mx-auto text-center">
                <h1 class="text-primary display-8 m-0">Munishvam</h1>
            </a>
            <!-- <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Munishvam</h1></a> -->
            <a href="#" class="me-auto  cart-icon" style="margin-right: 0!important;" id="cart-icon">

                <i class="fa fa-shopping-cart fa-2x"></i>
            </a>

            <style>
            /* Sidebar styles */
            #cart-sidebar {
                width: 350px;
                overflow-y: auto;
                padding-bottom: 80px;
                position: fixed;
                top: 0;
                right: 0;
                background: #fff;
                z-index: 1050;
                transition: transform 0.3s ease-in-out;
            }

            .cart-header {
                border-bottom: 1px solid #e0e0e0;
            }

            .cart-items-container {
                max-height: 400px;
                overflow-y: auto;
            }

            .product-row {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }

            .product-info {
                display: flex;
                flex-grow: 1;
                margin-right: 10px;
            }

            .product-info img {
                width: 60px;
                height: 60px;
                object-fit: cover;
                margin-right: 10px;
                border-radius: 8px;
                border: 1px solid #ddd;
            }

            .product-details {
                flex-grow: 1;
            }

            .product-name {
                margin: 0;
                font-size: 16px;
                font-weight: 600;
                color: #333;
            }

            .product-price {
                font-size: 14px;
                color: #28a745;
                margin-top: 5px;
            }

            .quantity-controls {
                display: flex;
                align-items: center;
            }

            .quantity-controls input {
                width: 50px;
                text-align: center;
                margin: 0 5px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .remove-item {
                color: #ff6c6c;
                border: none;
                background: none;
                cursor: pointer;
                font-size: 14px;
            }

            .empty-cart-message {
                color: #888;
                text-align: center;
            }
            </style>

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
                <!-- <div id="cart-footer" class="mt-4">
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Total:</h5>
                        <h5 id="cart-total" class="text-success">₹0.00</h5>
                    </div>
                    <button class="btn btn-primary w-100">Proceed to Checkout</button>
                </div> -->
            </div>

            <div id="cart-backdrop" class="backdrop" style="z-index: 1040; display: none;"></div>



            <div class="collapse navbar-collapse " id="navbarCollapse">
                <div class="navbar-nav mx-auto">

                    <a href="{{ route('app.cashew_layout') }}" class="nav-item nav-link active">Home</a>

                </div>
                <div class="d-flex m-3 me-0">

                    <a href="#" class=" me-4 my-auto" id="cart-icon1">
                        <i class="fa fa-shopping-cart fa-2x"></i>

                    </a>
                    <a href="#" class="my-auto" id="navbar-icon1">
                        <i class="fas fa-user fa-2x"></i>
                    </a>



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
                                class="fas fa-copyright text-light me-2"></i>WWW.Munishvam.com</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">Munishvam</a> Distributed By
                    <a class="border-bottom" href="https://themewagon.com">Munishvam</a>
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
    const cartIcon1 = document.getElementById('cart-icon1');


    const cartSidebar = document.getElementById('cart-sidebar');
    const closeCartSidebar = document.getElementById('close-cart-sidebar');
    const cartBackdrop = document.getElementById('cart-backdrop');

    cartIcon.addEventListener('click', (e) => {
        e.preventDefault();
        cartSidebar.style.transform = 'translateX(0)';
        cartBackdrop.style.display = 'block';
    });
    cartIcon1.addEventListener('click', (e) => {
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
    const navbarIcon1 = document.getElementById('navbar-icon1');

    const navbarSidebar = document.getElementById('navbar-sidebar');
    const closeNavbarSidebar = document.getElementById('close-navbar-sidebar');
    const navbarBackdrop = document.getElementById('navbar-backdrop');

    navbarIcon.addEventListener('click', (e) => {
        e.preventDefault();
        navbarSidebar.style.transform = 'translateX(0)';
        navbarBackdrop.style.display = 'block';
    });
    navbarIcon1.addEventListener('click', (e) => {
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
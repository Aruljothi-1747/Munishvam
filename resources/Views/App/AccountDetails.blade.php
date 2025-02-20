<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
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
    <div class="container account-container">
        <h2 class="account-header">My Account</h2>

        <ul class="nav nav-pills mb-4" id="accountTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="orders-tab" data-toggle="pill" href="#orders" role="tab">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="profile-tab" data-toggle="pill" href="#profile" role="tab">Profile</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link logout-link" onclick="return confirmLogout(event)">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('app.cashew_Layout') }}" class="nav-link logout-link">
                    Back to<i class="fas fa-home-alt"></i>
                </a>
            </li>
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
        </ul>
        <div class="tab-content" id="accountTabContent">
            <!-- Orders Tab -->
            <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <h5 class="mt-4 mb-3">Your Orders</h5>
                <div class="order-list">
                    @foreach ($orders as $order)
                    <section class="vh-10 gradient-custom-2">
                        <div class="container py-2 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-12">
                                    <div class="card card-stepper" style="border-radius: 16px;">
                                        <div class="card-header p-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="text-muted mb-2"> Order ID <span
                                                            class="fw-bold text-body">1222528743</span></p>
                                                    <p class="text-muted mb-0"> Place On <span
                                                            class="fw-bold text-body">{{ $order->order_date ?? 'N/A' }}</span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0"> <a style="color: rgb(103, 157, 6);" href="#">View
                                                            Details</a> </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="d-flex flex-row mb-4 pb-2">
                                                <div class="flex-fill">
                                                    <h5 class="bold">{{ $order->product->ProductName ?? 'N/A' }} </h5>
                                                    <p class="text-muted"> Qt: 1 item</p>
                                                    <h4 class="mb-3"> ₹
                                                        {{ number_format(($order->total_price ?? 1), 2) }} <span
                                                            class="small text-muted">
                                                        </span></h4>
                                                    <!-- <p class="text-muted">Tracking Status on: <span
                                                            class="text-body">11:30pm, Today</span></p> -->
                                                </div>
                                                <div>
                                                    @if ($order->product->ProductLogo)
                                                    <img src="{{ asset('ProductLogos/' . $order->product->ProductLogo) }}"
                                                        alt="Product Image"
                                                        style=" max-height: 100px; object-fit: cover;border-radius: 10px;">
                                                    @else
                                                    <img src="{{ asset('images/default-product-image.jpg') }}"
                                                        alt="Default Product Image"
                                                        style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                    @endif
                                                </div>
                                            </div>
                                            <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                                                <li class="step0 {{ in_array($order->status, ['Pending', 'Shipped', 'In Transit', 'Delivered']) ? 'active' : '' }} text-center"
                                                    id="step1">
                                                    <span style="margin-left: 22px; margin-top: 12px;">PLACED</span>
                                                </li>
                                                <li class="step0 {{ in_array($order->status, ['Shipped', 'In Transit', 'Delivered']) ? 'active' : '' }} text-center"
                                                    id="step2">
                                                    <span>SHIPPED</span>
                                                </li>
                                                <li class="step0 {{ $order->status == 'Delivered' ? 'active' : '' }} text-muted text-end"
                                                    id="step3">
                                                    <span style="margin-right: 20px;">DELIVERED</span>
                                                </li>
                                            </ul>


                                        </div>
                                        <div class="card-footer p-4">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-normal mb-0"><a style="color: rgb(103, 157, 6);"
                                                        href="#!">Invoice</a></h5>
                                                <div class="border-start h-100"></div>
                                                <h5 class="fw-normal mb-0"><a style="color: rgb(103, 157, 6);"
                                                        href="#!">Cancel</a></h5>
                                                <div class="border-start h-100"></div>
                                                <h5 class="fw-normal mb-0"><a style="color: rgb(103, 157, 6);"
                                                        href="#!">Pre-pay</a></h5>
                                                <div class="border-start h-100"></div>
                                                <h5 class="fw-normal mb-0"><a style="color: rgb(103, 157, 6);" href="#!"
                                                        class="text-muted"><i class="fas fa-ellipsis-v"></i></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endforeach
                    <style>
                    gradient-custom-2 {
                        /* fallback for old browsers */
                        background: #a1c4fd;

                        /* Chrome 10-25, Safari 5.1-6 */
                        background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

                        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                        background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
                    }

                    #progressbar-1 {
                        color: #455A64;
                    }

                    #progressbar-1 li {
                        list-style-type: none;
                        font-size: 13px;
                        width: 33.33%;
                        float: left;
                        position: relative;
                    }

                    #progressbar-1 #step1:before {
                        content: "1";
                        color: #fff;
                        width: 29px;
                        margin-left: 18px;
                    }

                    #progressbar-1 #step2:before {
                        content: "2";
                        color: #fff;
                        width: 29px;
                    }

                    #progressbar-1 #step3:before {
                        content: "3";
                        color: #fff;
                        width: 29px;
                        margin-right: 20px;
                        text-align: center;
                    }

                    #progressbar-1 li:before {
                        line-height: 29px;
                        display: block;
                        font-size: 12px;
                        background: #455A64;
                        border-radius: 50%;
                        margin: auto;
                    }

                    #progressbar-1 li:after {
                        content: '';
                        width: 121%;
                        height: 2px;
                        background: #455A64;
                        position: absolute;
                        left: 0%;
                        right: 0%;
                        top: 15px;
                        z-index: -1;
                    }

                    #progressbar-1 li:nth-child(2):after {
                        left: 50%
                    }

                    #progressbar-1 li:nth-child(1):after {
                        left: 25%;
                        width: 121%
                    }

                    #progressbar-1 li:nth-child(3):after {
                        left: 25%;
                        width: 50%;
                    }

                    #progressbar-1 li.active:before,
                    #progressbar-1 li.active:after {
                        background: #679d06;
                    }

                    .card-stepper {
                        z-index: 0
                    }
                    </style>
                </div>


            </div>
            <!-- Profile Tab -->
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form action="{{ route('App.AccountDetailsUpdate', $customer->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" style="color:black;">Full Name</label>
                        <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="name" name="Name"
                            value="{{  $customer->Name }}" required>
                        @error('Name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="id" value="{{ $customer->id }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="phone" style="color:black;">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="Phonenumber"
                                    value="{{ $customer->Phonenumber }}">
                                @error('Phonenumber')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Pincode" style="color:black;">Pincode</label>
                        <input type="text" class="form-control" name="Pincode" id="Pincode"
                            oninput="debouncedFetchLocationData()" maxlength="6" value="{{ $customer->Pincode}}">
                        @error('Pincode')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="District">District</label>
                                <input type="text" class="form-control" id="District" name="District"
                                    value="{{ $customer->District}}" placeholder="District">
                                @error('District')
                                <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="State">State</label>
                                <input type="text" class="form-control" id="State" name="State" placeholder="State"
                                    value="{{ $customer->State}}">
                                @error('State')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="DoorNo">Door No</label>
                                <input type="text" class="form-control" id="DoorNo" name="DoorNo"
                                    value="{{ $addressParts[1] ?? '' }}" placeholder="Enter Door No" required>
                                @error('DoorNo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="Village/Town">Village/Town</label>
                                <input type="text" class="form-control" id="Village/Town" name="Village_Town"
                                    value="{{ $addressParts[3] ?? '' }}" placeholder="Enter Village/Town" required>
                                @error('Village_Town')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="landmark">Landmark</label>
                                <input type="text" class="form-control" id="landmark" name="landmark"
                                    value="{{ $addressParts[0] ?? '' }}" placeholder="Enter landmark" required>
                                @error('landmark')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="Street">Street</label>
                                <input type="text" class="form-control" id="Street" name="Street"
                                    value="{{ $addressParts[2] ?? '' }}" placeholder="Enter Street" required>
                                @error('Street')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="Post">Post</label>
                                <input type="text" class="form-control" id="Post" name="Post"
                                    value="{{ $addressParts[4] ?? '' }}" placeholder="Enter Post" required>
                                @error('Post')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="Taluka">Taluka</label>
                                <input type="text" class="form-control" id="Taluka" name="Taluka"
                                    value="{{ $addressParts[5] ?? '' }}" placeholder="Enter Taluka" required>
                                @error('Taluka')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" style="color:black;">Update
                        Profile</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="text-light pt-4 pb-2" style="background-color: rgb(69, 89, 91);">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#" style="color: rgb(103, 157, 6);"><i
                                class="fas fa-copyright text-light me-2"></i>WWW.Munishvam.com</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" style="color: rgb(103, 157, 6);"
                        href="https://htmlcodex.com">Munishvam</a> Distributed By <a style="color: rgb(103, 157, 6);"
                        class="border-bottom" href="https://themewagon.com">Munishvam</a>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-0">&copy; 2024 Company Name. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // Cache to store pincode results locally
    const pincodeCache = {};
    // Debounce function to reduce API calls
    function debouncedFetchLocationData() {
        clearTimeout(window.pincodeDebounce);
        window.pincodeDebounce = setTimeout(fetchLocationData, 300); // wait 300ms after typing stops
    }
    // Function to fetch location data
    async function fetchLocationData() {
        const pincode = document.getElementById("Pincode").value;
        if (pincode.length === 6 && !isNaN(pincode)) {
            // Check cache first
            if (pincodeCache[pincode]) {
                populateLocationFields(pincodeCache[pincode]);
                return;
            }
            try {
                const response = await fetch(`https://api.postalpincode.in/pincode/${pincode}`);
                const data = await response.json();
                if (data[0].Status === "Success") {
                    const postOffice = data[0].PostOffice[0];
                    const locationData = {
                        District: postOffice.District,
                        State: postOffice.State
                    };

                    // Cache the response
                    pincodeCache[pincode] = locationData;

                    // Populate fields
                    populateLocationFields(locationData);
                } else {
                    alert("Invalid Pincode");
                }
            } catch (error) {
                alert("Error fetching data. Please try again.");
            }
        } else {
            clearLocationFields();
        }
    }
    // Populate fields with fetched data
    function populateLocationFields({
        District,
        State
    }) {
        document.getElementById("District").value = District || "";
        document.getElementById("State").value = State || "";
    }
    // Clear fields if input is invalid
    function clearLocationFields() {
        document.getElementById("District").value = "";
        document.getElementById("State").value = "";
    }
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        background-color: #f1f2f6;
        border: 5px solid #fff;
        /* Add border to body */
        border-radius: 10px;
        /* Optional: Add border radius */

    }

    .account-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 10px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .account-header {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group label {
        font-weight: 500;
        color: #555;
    }

    .btn-primary {
        background-color: #679d06;
        border-color: #679d06;
    }

    .btn-primary:hover {
        background-color: #0a58ca;
        border-color: #0a58ca;
    }

    .nav-pills .nav-link {
        color: #679d06;
        font-weight: 600;
    }

    .nav-pills .nav-link.active {
        background-color: #679d06;
        color: white;
    }

    .edit-icon {
        color: #2874f0;
        cursor: pointer;
    }

    .order-list .order-item {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .order-list .order-item:last-child {
        border-bottom: none;
    }

    .order-list .order-item h6 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .order-list .order-item small {
        color: #888;
    }

    .logout-link {
        color: #ff4c4c;
        cursor: pointer;
        font-weight: 600;
    }
    </style>
</body>
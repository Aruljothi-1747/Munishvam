<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    .order-card {
        border: none;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.2s;
    }

    .order-card:hover {
        transform: scale(1.02);
    }

    .order-header {
        background-color: rgb(103, 157, 6);
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 10px 10px 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section {
        padding: 20px;
        border-top: 1px solid #f1f3f6;
    }

    .info-title {
        font-weight: bold;
        color: #333;
    }

    .info-text {
        color: #555;
        font-size: 0.95rem;
    }

    .total {
        font-size: 1.2rem;
        color: #2874f0;
        font-weight: bold;
    }

    .order-btn {
        background-color: #2874f0;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        padding: 10px 20px;
        text-align: center;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    .order-btn:hover {
        background-color: #1f5fbf;
    }
    </style>
</head>

<body>

    <div class="container my-5">
        <h2 class="mb-4 text-center">Order Details List</h2>

        <div class="card order-card">
            <div class="order-header">
                <span class="order-title">Order #{{ $product->id }}</span>
                <span><i class="fas fa-calendar-alt"></i> Date: {{ now()->format('d-M-Y') }}</span>
            </div>

            <div class="section">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <span class="info-title"
                            style="font-size: 1.5rem; font-weight: bold; color: #4CAF50;">Shipping-Address</span>
                        <div class="info-text">
                            <strong>Address:</strong>
                            <div class="address-details">
                                <div class="info-text">
                                    <strong>Name:</strong> {{ $customer->name ?? 'Not Available' }}
                                </div>
                                <div class="info-text">
                                    <strong>Contact:</strong> {{ $customer->Phonenumber ?? 'Not Available' }}
                                </div>
                                <p>
                                    {{ $addressParts[1] ?? '' }}, {{ $addressParts[3] ?? '' }},
                                    {{ $addressParts[2] ?? '' }},
                                    {{ $addressParts[4] ?? '' }} (POST), {{ $addressParts[5] ?? '' }} (T.K),
                                    Landmark: {{ $addressParts[0] ?? '' }},
                                    {{ $customer->District ?? 'Not Available' }} -
                                    {{ $customer->Pincode ?? 'Not Available' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 text-right">
                        <button class="badge badge-success" data-toggle="modal" data-target="#updateAddressModal"
                            style="font-size: 1.0rem; padding: 10px 20px; border-radius: 5px; background-color:rgb(31, 95, 191); color: white; border: none;">
                            <i class="fa-solid fa-pen-to-square fa-lg"></i> Edit Address
                        </button>
                    </div>
                </div>
            </div>
            <!-- Product and Price Details -->
            <style>
            .amazon-style-container {
                max-width: 100%;
                margin: 20px auto;
                font-family: Arial, sans-serif;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .section-title {
                font-size: 1.4rem;
                font-weight: bold;
                color: #333;
                margin-bottom: 15px;
            }

            .product-section {
                display: flex;
                border-bottom: 1px solid #ddd;
                padding-bottom: 20px;
                margin-bottom: 20px;
                flex-wrap: wrap;

            }

            .product-image {
                max-width: 180px;
                max-height: 180px;
                border-radius: 8px;
                margin-right: 20px;
            }

            .product-details {
                flex: 1;
            }

            .product-details p {
                margin: 5px 0;
                font-size: 1rem;
                color: #333;
            }

            .price-section {
                width: 100%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;

            }

            .price-section th,
            .price-section td {
                padding: 10px;
                text-align: right;
                /* Aligns text to the right */
                font-size: 1rem;
                border: none;
            }

            .price-section th {
                color: #555;
                font-weight: bold;
                width: 150px;
                text-align: left;
            }

            .price-section td {
                background-color: #fff;
                color: #333;

            }

            .price-summary {
                font-size: 1.2rem;
                font-weight: bold;
                color: #ff9900;
                text-align: right;
            }

            .total-row {
                font-weight: bold;
            }

            .highlighted-text {
                color: #ff9900;
            }

            .action-buttons {
                text-align: right;
            }

            .edit-button {
                background-color: #ff9900;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 1rem;
                cursor: pointer;
            }

            .edit-button:hover {
                background-color: #e68a00;
            }
            </style>

            <div class="section">
                <div class="section-title">Product Details</div>
                <div class="product-section">
                    <img src="{{ asset('ProductLogos/' . $product->ProductLogo) }}" alt="Product Image"
                        class="product-image">
                    <table class="price-section">
                        <tr style="border-bottom: 1px solid #ddd;">
                            <th>Product</th>
                            <td>{{ $product->ProductName }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <th>Price</th>
                            <td>₹{{ number_format($product->ProductPrice, 2) }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <th>Quantity</th>
                            <td>{{ $product->Quantity ?? 1 }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>

                            <td style="font-size: 20px;"> <span
                                    class="badge badge-success ">₹{{ number_format($product->ProductPrice * ($product->Quantity ?? 1), 2) }}</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="section-title">Price Details</div>
                <table class="price-section">
                    <tr style="border-bottom: 2px solid #ddd;">
                        <th>Subtotal</th>
                        <td>₹{{ number_format($product->ProductPrice * ($product->Quantity ?? 1), 2) }}</td>
                    </tr>
                    <tr style="border-bottom: 2px solid #ddd;">
                        <th>Tax (5%)</th>
                        <td>₹{{ number_format($product->ProductPrice * ($product->Quantity ?? 1) * 0.05, 2) }}</td>
                    </tr>
                    <tr style="border-bottom: 2px solid #ddd;">
                        <th>Shipping Fee</th>
                        <td>₹0.00</td>
                    </tr>
                    <tr style="border-bottom: 2px solid #ddd;">
                        <th class="total">Total</th>

                        <td class="total" style="font-size: 20px;">
                            <span class="badge badge-success">
                                ₹{{ number_format($product->ProductPrice * ($product->Quantity ?? 1) * 1.05, 2) }}</span>
                        </td>
                    </tr>
                </table>


                <div class="section text-center">
                    <form action="{{ route('placeOrder') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_date" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="Name" value="{{ $customer->Name ?? 'Not Available' }}">
                        <input type="hidden" name="Phonenumber" value="{{ $customer->Phonenumber ?? '' }}">
                        <input type="hidden" name="landmark" value="{{ $addressParts[0] ?? '' }}">
                        <input type="hidden" name="DoorNo" value="{{ $addressParts[1] ?? '' }}">
                        <input type="hidden" name="Street" value="{{ $addressParts[2] ?? '' }}">
                        <input type="hidden" name="Village_Town" value="{{ $addressParts[3] ?? '' }}">
                        <input type="hidden" name="Post" value="{{ $addressParts[4] ?? '' }}">
                        <input type="hidden" name="Taluka" value="{{ $addressParts[5] ?? '' }}">
                        <input type="hidden" name="District" value="{{ $customer->District ?? '' }}">
                        <input type="hidden" name="Pincode" value="{{ $customer->Pincode ?? '' }}">

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="{{ $product->Quantity ?? 1 }}">

                        <button type="submit" class="order-btn">Proceed to Order</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- Order Place Button -->

    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="modal fade" id="updateAddressModal" tabindex="-1" aria-labelledby="updateAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: rgb(103, 157, 6);" id="updateAddressModalLabel">Edit Address
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('App.AccountDetailsUpdate', $customer->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" style="color:black;">Full Name</label>
                            <input type="text" placeholder="{{ Auth::user()->name }}" class="form-control" id="name"
                                name="Name" value="{{  $customer->Name }}" required>
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
                                        value="{{ $addressParts[2] ?? '' }} Street" placeholder="Enter Street" required>
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

                        <button type="submit" class="btn btn-primary btn-block"
                            style="background-color: rgb(103, 157, 6);">Update
                            Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</body>

</html>
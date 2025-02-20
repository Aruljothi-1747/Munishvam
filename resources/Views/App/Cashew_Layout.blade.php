@extends('App.Main_Cashew_Layout')
@section('Tittle')
Product List
@endsection

<!--Main Content-->
@section('maincontent')

<!-- Hero Start -->
<div class="container-fluid hero-header1" style=" margin-bottom:25px;">
    <div class="row g-5 align-items-center">
        <!-- Carousel Section -->
        <div class="col-md-12 col-lg-12">
            <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active rounded">
                        <img src="img/hero-img-1.jpg" class="img-fluid bg-secondary rounded"
                            style="height: 150px; width: 100%; object-fit: cover;" alt="First slide">
                        <a href="#" class="btn px-4 py-2 text-white rounded">Nutritious</a>
                    </div>
                    <div class="carousel-item rounded">
                        <img src="img/hero-img-3.jpg" class="img-fluid w-100 rounded"
                            style="height: 150px;width: 100%; object-fit: cover;" alt="Second slide">
                        <a href="#" class="btn px-4 py-2 text-white rounded">Delicious</a>
                    </div>
                    <div class="carousel-item rounded">
                        <img src="img/hero-img-4.jpg" class="img-fluid w-100 rounded"
                            style="height: 150px; width: 100%;object-fit: cover;" alt="Third slide">
                        <a href="#" class="btn px-4 py-2 text-white rounded">Wholesome</a>
                    </div>
                </div>
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Hero End -->

<!-- Bestsaler Product Start -->
<div class="container-fluid ">
    <div class="container ">
        <div class="text-center mx-auto mb-1" style="max-width: 700px;">
            <h1 class="display-7">Bestseller Products</h1>
            <p>"Indulge in our best-selling nuts, a crunchy delight you can trust. Packed with flavor and nutrition,
                they’re the perfect snack to boost your day!"</p>
        </div>
        <div class="row g-4">
            @foreach($data as $key => $item)
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light h-100 d-flex flex-column">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="{{ asset('ProductLogos/' . ($item->ProductLogo ?? 'image.png')) }}"
                                class="card-img-top" alt="{{ $item->ProductName }}">
                        </div>
                        <div class="col-6">
                            <a href="{{ route('product.show', ['id' => $item->id]) }}"
                                class="h5 d-block">{{ $item->ProductName }}</a>
                            <div class="d-flex my-3">
                                @for ($i = 0; $i < 5; $i++) <i class="fas fa-star" style="color: gold;"></i>
                                    @endfor
                            </div>
                            <h4 class="text-danger fw-bold mb-3">Rs: {{ $item->ProductPrice }}</h4>
                            <div class="d-flex align-items-center mb-2">
                                <button class="btn btn-outline-secondary btn-sm quantity-decrease">-</button>
                                <input type="text" value="0" min="0"
                                    class="form-control text-center mx-2 quantity-input" style="width: 60px;" readonly>
                                <button class="btn btn-outline-secondary btn-sm quantity-increase">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-auto">
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"
                            data-bs-toggle="modal" data-bs-target="#productModal{{ $item->id }}">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i>Details
                        </a>
                        @if($cartItems->where('product_id', $item->id)->count() > 0)
                        <!-- If product already added to the cart -->
                        <a href="javascript:void(0);"
                            class="btn border border-secondary rounded-pill px-2 text-success disabled">
                            <i class="fa fa-check me-2 text-success"></i>Added to Cart
                        </a>
                        @else
                        <!-- If product not added to the cart -->
                        <a href="javascript:void(0);"
                            class="btn border border-secondary rounded-pill px-2 text-primary add-to-cart"
                            data-id="{{ $item->id }}" data-name="{{ $item->ProductName }}"
                            data-price="{{ $item->ProductPrice }}"
                            data-image="{{ asset('ProductLogos/' . ($item->ProductLogo ?? 'image.png')) }}">
                            <i class="fa fa-shopping-cart me-2 text-primary"></i> Add to Cart
                        </a>
                        @endif



                    </div>
                </div>
            </div>
            <style>
            .add-to-cart {
                transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
            }

            .add-to-cart:hover {
                transform: scale(1.1);
                /* Slightly enlarges the button */
                background-color: #007bff;
                /* Changes background color */
                color: white;
                /* Changes text color */
            }

            .add-to-cart i {
                transition: transform 0.3s ease;
            }

            .add-to-cart:hover i {
                transform: rotate(360deg);
                /* Rotates the icon */
            }
            </style>


            <!-- Modal -->
            <!-- Product Modal -->
            <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="productModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header with Product Name -->
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="productModalLabel{{ $item->id }}">
                                {{ $item->ProductName }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row">
                                <!-- Left Column: Product Image (Responsive) -->
                                <div class="col-md-5 col-sm-12 mb-3">
                                    <div class="ecommerce-gallery" data-mdb-ecommerce-gallery-init
                                        data-mdb-zoom-effect="true" data-mdb-auto-height="true">
                                        <div class="row py-3 shadow-5">
                                            <img id="main-product-image-{{ $item->id }}"
                                                src="{{ asset('ProductLogos/' . ($item->ProductLogo ?? 'placeholder.jpg')) }}"
                                                class="img-fluid rounded shadow-sm w-100"
                                                alt="{{ $item->ProductName }}">
                                            @foreach (['ProductLogo', 'ProductLogo2', 'ProductLogo3', 'ProductLogo4',
                                            'ProductLogo5'] as $field)
                                            @if (!empty($item->{$field}))
                                            <div class="col-3 p-1">
                                                <img src="{{ asset('ProductLogos/' . $item->{$field}) }}"
                                                    onclick="changeMainImage('{{ $item->id }}', this)"
                                                    class="thumbnail-img w-100"
                                                    alt="{{ $item->ProductName }} Thumbnail">
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <script>
                                function changeMainImage(productId, thumbnail) {
                                    const mainImage = document.getElementById(`main-product-image-${productId}`);
                                    mainImage.src = thumbnail.src;
                                    mainImage.alt = thumbnail.alt;
                                }
                                </script>


                                <!-- Right Column: Product Details (Responsive) -->
                                <div class="col-md-7 col-sm-12">
                                    <!-- Product Rating -->
                                    <div class="d-flex align-items-center mb-2">
                                        @for ($i = 0; $i < 5; $i++) <i class="fas fa-star" style="color: gold;"></i>
                                            @endfor
                                            <span class="text-muted ms-2">(120 ratings)</span>
                                    </div>

                                    <!-- Product Price Section with Discount -->
                                    <h5 class="text-muted text-decoration-line-through mb-1">
                                        ₹{{ number_format($item->ProductPrice +101, 2) }}/kg
                                    </h5>
                                    @php
                                    $discountedPrice = $item->ProductPrice * (1 - $item->discount_percentage / 100);
                                    @endphp
                                    <h4 class="text-danger fw-bold mb-2">₹{{ number_format($discountedPrice, 2) }}/-
                                    </h4>
                                    <span class="badge bg-success mb-3">Save
                                        {{ $item->discount_percentage }}%</span>

                                    <!-- Price and Weight Section -->
                                    <div class="p-2 bg-light border rounded shadow-sm mb-3">
                                        <div class="d-flex align-items-center">
                                            <!-- Price per Gram -->
                                            <div class="me-3">
                                                <h6 class="text-primary fw-semibold mb-1">Price per Gram</h6>
                                                <p class="fs-6 text-dark fw-bold">
                                                    ₹{{ number_format($discountedPrice / 1000, 2) }}</p>
                                            </div>

                                            <!-- Vertical Divider for Desktop Only -->
                                            <div class="vr d-none d-md-block mx-3"></div>

                                            <!-- Total Weight -->
                                            <div>
                                                <h6 class="text-secondary fw-semibold mb-1">Total Weight</h6>
                                                <p class="fs-6 text-dark fw-bold">{{ $item->Measurement }} kg</p>
                                            </div>
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Price
                                            based on
                                            1 kg unit.</small>
                                    </div>

                                    <!-- Product Description -->
                                    <p class="text-muted mb-4">{{ $item->ProductDescription }}</p>

                                    <!-- Action Buttons (Responsive) -->

                                    <div class="d-flex justify-content-between align-items-end mt-auto py-5">
                                        <a href="{{ route('OrderDetails.OrderDetails', ['productId' => $item->id]) }}"
                                            class="btn btn-primary px-2">
                                            <i class="fa fa-shopping-bag me-2"></i> Buy Now
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="btn border border-secondary rounded-pill px-2 text-primary add-to-cart"
                                            data-id="{{ $item->id }}" data-name="{{ $item->ProductName }}"
                                            data-price="{{ $item->ProductPrice }}"
                                            data-image="{{ asset('ProductLogos/' . ($item->ProductLogo ?? 'image.png')) }}">
                                            <i class="fa fa-shopping-cart me-2 text-primary"></i>Add to Cart
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
<!-- Bestsaler Product End -->
<!-- Featurs Section Start -->
<div class="container-fluid featurs ">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order over Rs.5000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->
<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0"> </h1>
                        <p class="text-secondary mb-0">Fresh products</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">
                        <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number"
                            placeholder="Your Email">
                        <button type="submit"
                            class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                            style="top: 0; right: 0;">Subscribe Now</button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Why People Like us!</h4>
                    <p class="mb-4">"Indulge in our best-selling nuts, a crunchy delight you can trust. Packed with
                        flavor and nutrition, they’re the perfect snack to boost your day!"</p>
                    <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: 47,pillaiyar kovil street,Puliyur Pethanankuppam,kurinjipadi(t.k), Cuddalore -
                        607301</p>
                    <p>Email: Munishvam@gmail.com</p>
                    <p>Phone: +91 8754290365</p>
                    <p>Payment Accepted</p>
                    <img src="img/payment.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fetch cart details when the page loads
document.addEventListener("DOMContentLoaded", function() {
    fetchCartDetails(); // Fetch cart details after the page loads
});

// Event listener for adding products to the cart
document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", function() {
        const productId = this.dataset.id;
        const productName = this.dataset.name;
        const productPrice = this.dataset.price;
        const productImage = this.dataset.image.split('/').pop(); // Extract just the filename

        // Disable the Add to Cart button and change its text
        this.classList.add("disabled");
        this.innerHTML = '<i class="fa fa-check me-2 text-success"></i> Added to Cart';

        // Send the data to the backend
        fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    productId: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage, // Only send the filename here
                    quantity: 1 // Default quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchCartDetails();
                    openCartSidebar(); // Open the cart sidebar
                } else {
                    alert("Error adding product to cart.");
                    // Re-enable button on error
                    this.classList.remove("disabled");
                    this.innerHTML =
                        '<i class="fa fa-shopping-cart me-2 text-primary"></i> Add to Cart';
                }
            })
            .catch(error => {
                console.error("Error:", error);
                this.classList.remove("disabled");
                this.innerHTML =
                '<i class="fa fa-shopping-cart me-2 text-primary"></i> Add to Cart';
            });
    });
});

// Function to open the cart sidebar automatically
function openCartSidebar() {
    const cartSidebar = document.getElementById('cart-sidebar');
    const cartBackdrop = document.getElementById('cart-backdrop');
    cartSidebar.style.transform = 'translateX(0)';
    cartBackdrop.style.display = 'block';
}

// Function to fetch and display cart details
function fetchCartDetails() {
    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    // Clear the current cart items before fetching new data
    cartItems.innerHTML = '';

    // Fetch updated cart details
    fetch('/get-cart-details')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.cartItems.length > 0) {
                data.cartItems.forEach(item => {
                    const productRow = document.createElement("div");

                    productRow.className =
                        `d-flex justify-content-between align-items-center mb-3 product-row product-${item.product_id}`;

                    productRow.innerHTML = `
                        <div class="product-info d-flex align-items-center">
                            <img src="${item.product_image}" alt="${item.product_name}" class="cart-product-image me-2" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">${item.product_name}</h6>
                                <small class="product-price text-muted" data-price="${item.product_price}">₹${parseFloat(item.product_price).toFixed(2)}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm quantity-decrease">-</button>
                            <input type="text" value="${item.quantity}" class="form-control text-center mx-2 product-quantity" style="width: 50px;" readonly>
                            <button class="btn btn-outline-secondary btn-sm quantity-increase">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm remove-item" data-id="${item.product_id}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;

                    // Add the product row to the cart items
                    cartItems.appendChild(productRow);

                    // ✅ Add listeners for quantity and remove button
                    addProductRowListeners(productRow, item.product_id);
                });

                updateTotal(); // Update the total after loading the cart
            } else {
                cartItems.innerHTML =
                    '<p class="empty-cart-message text-center text-muted">Your cart is empty.</p>';
            }
        })
        .catch(error => console.error('Error fetching cart details:', error));
}

// Function to update the total amount in the cart
function updateTotal() {
    let total = 0;
    const cartItems = document.getElementById("cart-items");
    const cartRows = cartItems.querySelectorAll(".product-row");

    cartRows.forEach((row) => {
        const price = parseFloat(row.querySelector(".product-price").dataset.price);
        const quantity = parseInt(row.querySelector(".product-quantity").value);
        total += price * quantity;
    });

    const cartTotal = document.getElementById("cart-total");
    cartTotal.textContent = `₹${total.toFixed(2)}`;
}

// ✅ Function to update the "Add to Cart" button after item removal
function updateAddToCartButton(productId) {
    const addToCartButton = document.querySelector(`.add-to-cart[data-id="${productId}"]`);
    if (addToCartButton) {
        addToCartButton.classList.remove("disabled", "text-success");
        addToCartButton.classList.add("text-primary");
        addToCartButton.innerHTML = '<i class="fa fa-shopping-cart me-2 text-primary"></i> Add to Cart';
    }
}

// Function to add event listeners for quantity change and item removal
function addProductRowListeners(row, productId) {
    const quantityInput = row.querySelector(".product-quantity");

    // Increase quantity
    row.querySelector(".quantity-increase").addEventListener("click", function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateTotal();
    });

    // Decrease quantity
    row.querySelector(".quantity-decrease").addEventListener("click", function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateTotal();
        }
    });

    // ✅ Modify the remove button event listener
    row.querySelector(".remove-item").addEventListener("click", function() {
        const removeButton = this;

        // Change button style to indicate the item is being removed
        removeButton.disabled = true;
        removeButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Removing...';

        // Send the DELETE request to remove the item from the cart
        fetch(`/cart/remove/${productId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // ✅ Remove the item from the cart in the UI
                    row.remove();
                    updateTotal();

                    // ✅ Enable the "Add to Cart" button after removal
                    updateAddToCartButton(productId);
                } else {
                    alert("Error removing item from cart.");
                    removeButton.disabled = false;
                    removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
                }
            })
            .catch(error => {
                console.error("Error:", error);
                removeButton.disabled = false;
                removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
            });
    });
}
</script>


@endsection
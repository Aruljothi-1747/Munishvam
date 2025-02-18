@extends('App.Main_Cashew_Layout')
@section('Tittle')
Product List
@endsection

@section('maincontent')

<!-- Main Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Shopping Bag Icon with Cart Count -->
        <div class="col-md-12 d-flex justify-content-end my-3">
            <a href="{{ route('cart.view') }}" class="position-relative me-4 my-auto">
                <i class="fa fa-shopping-bag fa-2x"></i>
                <span id="cart-count"
                    class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                    style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                    {{ session()->get('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
        </div>
    </div>

    <!-- Product List -->
    <div class="container">
        <div class="row">
            @foreach($data as $key => $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img src="{{ asset('ProductLogos/' . ($item->ProductLogo ?? 'image.png')) }}" class="card-img-top"
                        alt="{{ $item->ProductName }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->ProductName }}</h5>
                        <p class="card-text">Price: ₹{{ number_format($item->ProductPrice, 2) }}</p>
                        <button class="btn btn-primary add-to-cart" data-id="{{ $item->id }}"
                            data-name="{{ $item->ProductName }}" data-price="{{ $item->ProductPrice }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function() {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productPrice = this.dataset.price;

            fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: productId,
                        name: productName,
                        price: productPrice
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartCount = document.getElementById("cart-count");
                        cartCount.textContent = data.cartCount;
                        alert("Product added to cart!");
                    } else {
                        alert("Failed to add product to cart.");
                    }
                });
        });
    });
});
</script>

@endsection
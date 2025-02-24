<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin-top: 100px;
        text-align: center;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding: 30px;
    }

    .btn-home {
        background-color: #2874f0;
        color: white;
    }

    .btn-home:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Order Confirmation
            </div>
            <div class="card-body">
                <h4 class="card-title">Thank you for your order!</h4>
                @if(session('success'))
                <p class="card-text text-success">{{ session('success') }}</p>
                @else
                <p class="card-text">Your order has been successfully placed.</p>
                @endif
                <a href="{{ route('orderdetails.orderdetails', ['userId' => Auth::id(), 'productId' => $product->id ?? 1]) }}"
                    class="btn btn-home mt-3">View Orders</a>
                <a href="/" class="btn btn-secondary mt-3">Go to Home</a>
            </div>
        </div>
    </div>

</body>

</html>
<!-- resources/views/admin/orders/details.blade.php -->
@extends('adminLTE.AdminLTE_Layout')

@section('Tittle')
Order #{{ $order->id }} Details
@endsection

@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order #{{ $order->id }} Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Customer Name:</strong> {{ $order->customer->Name ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Product:</strong> {{ $order->product->ProductName ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Quantity:</strong> {{ $order->quantity }}
                        </div>
                        <div class="col-md-6">
                            <strong>Total Price:</strong> ₹{{ number_format($order->total_price, 2) }}
                        </div>
                        <div class="col-md-12">
                            <strong>Status:</strong>
                            @if($order->status !== 'In Production')
                            <span class="badge badge-danger">{{ $order->status }}</span>
                            @else
                            <span class="badge badge-success">In Production</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('OrderDetails.acceptOrder', $order->id) }}" class="btn btn-primary mt-3"
                        onclick="return confirm('Are you sure you want to accept this order and move it to production?')">Accept
                        Order</a>
                    <a href="{{ route('OrderDetails.OrderIndex') }}" class="btn btn-secondary mt-3">Back to Order
                        List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
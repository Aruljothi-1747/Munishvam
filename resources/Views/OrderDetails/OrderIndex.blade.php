@extends('adminLTE.adminLTE_layout')

@section('Tittle')
Order List
@endsection

<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order List</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table" id="indexlist">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>View</th> <!-- Added -->
                                    <th>Print</th> <!-- Added -->
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">You have no orders yet.</td>
                                </tr>
                                @else
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer->Name ?? 'N/A' }}</td> <!-- Display customer name -->
                                    <td>{{ $order->product->ProductName ?? 'N/A' }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        @if($order->status !== 'In Production')
                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                        @else
                                        <span class="badge badge-success">Success</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status !== 'In Production')
                                        <a href="{{ route('OrderDetails.acceptOrder', $order->id) }}"
                                            class="btn badge-primary btn-sm"
                                            onclick="return confirm('Are you sure you want to accept this order and move it to production?')">Accept
                                            Order</a>
                                        @else
                                        <span class="badge badge-success">AcceptedOrder</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('orderdetails.show', $order->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('orderdetails.print', $order->id) }}">
                                            <i class="fas fa-print"></i> Print
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#indexlist').DataTable({
        "pageLength": 25
    });
});
</script>
@endsection
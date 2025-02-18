@extends('adminLTE.AdminLTE_Layout')

@section('Tittle')
Order List
@endsection
@section('maincontent')


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15">Invoice {{ $order->id }} <span
                                class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                            <h2 class="mb-1 text-muted">Amirthamhub.com</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">41, west street, Landmark: vallalar kovil</br>
                                puliyur, ambalavanapettai (Post),</br> kurinjipadi (T.k),
                                Cuddalore - 607301

                            </p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> Amirthamhub@987.com</p>
                            <p><i class="uil uil-phone me-1"></i> +91-8754290365</p>
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3"><strong>Delivery Address:</strong></h5>
                                <h5 class="font-size-15 mb-2"><strong>{{ $order->customer->Name ?? 'N/A' }}</strong>
                                </h5>
                                <h5 class="font-size-15 mb-2">Mobile Number -
                                    <strong>{{ $addressParts[1] ?? '' }}</strong>
                                </h5>
                                <p class="mb-1"><strong>{{ $addressParts[3] ?? '' }}</strong>,
                                    <strong>{{ $addressParts[4] ?? '' }}</strong>,
                                    Landmark: <strong>{{ $addressParts[2] ?? '' }}</strong>
                                </p>
                                <p class="mb-1"><strong>{{ $addressParts[5] ?? '' }}</strong>,
                                    <strong>{{ $addressParts[6] ?? '' }}</strong> (Post),
                                    <strong>{{ $addressParts[7] ?? '' }}</strong> (T.k),
                                </p>
                                <p class="mb-1">
                                    <strong>{{ $addressParts[8] ?? '' }}</strong> -
                                    <strong>{{ $addressParts[9] ?? '' }}</strong>
                                </p>
                            </div>

                        </div>
                        <!-- end col -->

                        <div class="col-12  col-md-6 text-right">
                            <h4 class="row">
                                <span class="col-6">Invoice #</span>
                                <span class="col-6 text-sm-right">INT-001</span>
                            </h4>
                            <div class="row">
                                <span class="col-6">Account</span>
                                <span
                                    class="col-6 text-sm-right">₹{{ number_format($order->product->ProductPrice, 2) }}</span>
                                <span class="col-6">Order ID</span>
                                <span class="col-6 text-sm-right">{{ $order->id ?? 'N/A' }}</span>
                                <span class="col-6">Invoice Date</span>
                                <span class="col-6 text-sm-right">{{ now()->format('d-M-Y') }}</span>

                            </div>
                        </div>



                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1">
                                                    {{ $order->product->ProductName ?? 'N/A' }}</h5>
                                            </div>
                                        </td>
                                        <td>₹{{ number_format($order->product->ProductPrice, 2) }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td class="text-end">₹{{ number_format($order->product->ProductPrice, 2) }}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-right">
                                            Shipping Charge :</th>
                                        <td class="border-0 text-end">₹50</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-right">
                                            Tax ({{ $gstPercentage }}% GST):
                                        </th>
                                        <td class="border-0 text-end">₹{{ number_format($gstAmount, 2) }}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-right">
                                            Total:
                                        </th>
                                        <td class="border-0 text-end">
                                            <h4 class="m-0 fw-semibold">₹{{ number_format($totalAmount, 2) }}</h4>
                                        </td>
                                    </tr>

                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-right">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                        class="fa fa-print"></i></a>
                                <a href="#" class="btn btn-primary w-md">Send</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div>

<style>
body {
    margin-top: 20px;
    background-color: #eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: 1rem;
}
</style>
@endsection
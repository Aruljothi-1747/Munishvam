@extends('adminLTE.AdminLTE_Layout')
@section('Title', 'Product Details')

<!-- Main Content -->
@section('maincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-default text-black">Product Details</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="Product_Name">Product Name</label>
                        <p>{{ $product->Product_Name }}</p>
                    </div>

                    <div class="form-group">
                        <label for="Product_Logo">Product Logo</label>
                        @if($product->Product_Logo)
                        <img src="{{ asset('ProductLogos/'.$product->Product_Logo) }}" style="max-width: 200px;">
                        @else
                        <p>No logo available</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Product_MakingDate">Product Making Date</label>
                        <p>{{ $product->Product_MakingDate }}</p>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('product.index') }}" class="btn btn-primary">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
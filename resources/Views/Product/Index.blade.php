@extends('adminLTE.AdminLTE_Layout')
@section('Tittle')
Product List
@endsection

<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product List</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <a href="{{ route('product.create') }}" class="btn btn-success mb-3">Create Product</a>
                    <div class="table-responsive">
                        <table class="table" id="indexlist">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product Name</th>
                                    <th>Logo</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>ProductType</th>
                                    <th>Tax</th>
                                    <th>Measurement</th>
                                    <th>MeasurementType</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->ProductName }}</td>
                                    <td>
                                        @if($item->ProductLogo)
                                        @php
                                        $logos = json_decode($item->ProductLogo, true);
                                        @endphp
                                        @if(is_array($logos))
                                        @foreach($logos as $logo)
                                        <img src="{{ asset('ProductLogos/' . $logo) }}" alt="Product Logo"
                                            style="max-width: 50px; margin: 0px;">
                                        @endforeach
                                        @else
                                        <img src="{{ asset('ProductLogos/' . $item->ProductLogo) }}" alt="Product Logo"
                                            style="max-width: 100px;">
                                        @endif
                                        @else
                                        <img src="{{ asset('ProductLogos/image.png') }}" alt="Default Image"
                                            style="max-width: 100px;">
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Rs:
                                            {{ number_format($item->ProductPrice, 2) }}</span>
                                    </td>
                                    <td>{{ $item->ProductDescription }}</td>
                                    <td>{{ $item->ProductType }}</td>
                                    <td>
                                        <span class="badge badge-danger">{{ $item->TaxId }}</span>
                                    </td>
                                    <td>{{ $item->Measurement }}</td>
                                    <td>{{ $item->MeasurementId }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', ['id' => $item->id]) }}" class="btn btn-link"
                                            title="Edit">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>

                                        <form action="{{ route('product.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa-solid fa-trash fa-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Script -->
<script>
function confirmDelete(productName, productId) {
    if (confirm('Are you sure you want to delete ' + productName + ' ?')) {
        document.getElementById('deleteForm' + productId).submit();
    }
}
</script>

<!-- jQuery and DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('.table').DataTable({
        "pageLength": 25
    });
});
</script>
@endsection
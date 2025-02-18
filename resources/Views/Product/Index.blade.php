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
                                <th> Price</th>
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
                                    <td>{{ $item->ProductName}}</td>
                                    <td>
                                        @if($item->ProductLogo)
                                        <img src="{{ asset('ProductLogos/' . $item->ProductLogo) }}" style="max-width: 100px;">
                                        @else
                                        <img src="{{ asset('ProductLogos/image.png' ) }}" style="max-width: 99px;">
                                        @endif
                                    </td>
                                    <td><span class="badge badge-success">Rs: {{ number_format($item->ProductPrice, 2) }}</span></td>  

                                    <td>{{ $item->ProductDescription}}</td>
                                    <td>{{ $item->ProductType}}</td>
                                    <td><span class="badge badge-danger">{{ $item->TaxId}}</span></td>
                                    <td>{{ $item->Measurement}}</td>
                                    <td>{{ $item->MeasurementId}}</td>
                                    <td>
    <a href="{{ route('product.edit', ['id' => $item->id]) }}" class="btn btn-link" title="Edit">
        <i class="fa-solid fa-pen-to-square fa-lg"></i>
    </a>
    <form id="deleteForm{{ $item->id }}" action="{{ route('product.destroy', ['id' => $item->id]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <a href="#" onclick="confirmDelete('{{ $item->Product_Name }}', '{{ $item->id }}'); return false;" class="btn btn-link" title="Delete">
            <i class="fa-solid fa-trash fa-lg" style="color:red;"></i>
        </a>
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
<script>
    function confirmDelete(productName, productId) {
        if (confirm('Are you sure you want to delete ' + productName + ' ?')) {
            document.getElementById('deleteForm' + productId).submit();
        }
    }
</script>
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
@extends('adminLTE.adminLTE_layout')
@section('Tittle')
Customer List
@endsection
<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer List </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <a href="{{ route('customer.create') }}" class="btn btn-success mb-3">Create Customer</a>
                    <div class="table-responsive">
                        <table class="table" id="indexlist">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->Name}}</td>
                                    <td>
                                        @if($item->Image)
                                        <img src="{{ asset('images/' . $item->Image) }}" alt="Employee Image" style="max-width: 30px;">
                                        @else
                                        <img src="{{ asset('images/image.png' ) }}" alt="Employee Image" style="max-width: 30px;">
                                        @endif
                                    </td>
                                    <td>{{ $item->Email}}</td>
                                    <td>{{ $item->Phonenumber}}</td>
                                    <td>{{ $item->Address}}</td>
                                    <td>
                                        <a href="{{ route('customer.edit', ['id' => $item->id]) }}"> <i class="fa-solid fa-pen-to-square"></i></a>
                                        <form id="deleteForm{{ $item->id }}" action="{{ route('customer.destroy', ['id' => $item->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="confirmDelete('{{ $item->Name }}', '{{ $item->id }}'); return false;"><i class="fa-solid fa-trash" style="color:red;"></i></a>
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
    function confirmDelete(customerName, customerId) {
        if (confirm('Are you sure you want to delete ' + customerName + ' ?')) {
            document.getElementById('deleteForm' + customerId).submit();
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
@extends('adminLTE.AdminLTE_Layout')
@section('Tittle')
Service Maintenance List
@endsection
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users List</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <a href="{{ route('user.usercreate') }}" class="btn btn-success mb-3">Create Users</a>
                    <body>
                        <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $employee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>

                                    <td>
                                        <a href="{{ route('user.edit', $employee->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form id="deleteForm{{ $employee->id }}" action="{{ route('user.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="confirmDelete('{{ $employee->name }}', '{{ $employee->id }}'); return false;"><i class="fa-solid fa-trash" style="color:red;"></i></a>
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
<script>
    function confirmDelete(employeeName, employeeId) {
        if (confirm('Are you sure you want to delete ' + employeeName + ' ?')) {
            document.getElementById('deleteForm' + employeeId).submit();
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
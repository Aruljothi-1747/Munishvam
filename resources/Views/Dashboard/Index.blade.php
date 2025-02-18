@extends('adminLTE.AdminLTE_Layout')
@section('Tittle')
Dashboard
@endsection
<!--Main Content-->
@section('maincontent')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalFeesToday }}</h3>
                        <p>Today </p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Today Customers <i class="fas fa-arrow-circle-right"></i>
                        {{ $customerCountToday }} </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalFeesThisWeek }}</h3>
                        <p>This Week </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">This Week Customers <i class="fas fa-arrow-circle-right"></i>
                        {{ $customerCountThisWeek }} </a>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalFeesThisMonth }}</h3>
                        <p>This Month </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">This Month Customers <i class="fas fa-arrow-circle-right"></i>
                        {{ $customerCountThisMonth }} </a>

                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalFees }}</h3>
                        <p>Total Subscription Amount </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Total Customers <i class="fas fa-arrow-circle-right"></i>
                        {{ $overallCustomerCount }} </a>
                </div>
            </div>
        </div>

        <!-- Table to display Today's Paid Fees -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="card-title">Today Paid Customer</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="todaysPaidFeesTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Fees</th>
                                <th>Paid Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($todaysServiceMaintenances->isEmpty())
                            <tr>
                                <td colspan="5">No records found</td>
                            </tr>
                            @else
                            @php $serial = 1 @endphp
                            @foreach($todaysServiceMaintenances as $serviceMaintenance)
                            <tr>
                                <td>{{ $serial++ }}</td>
                                <td>{{ $serviceMaintenance->customer->Name }}</td>
                                <td>{{ $serviceMaintenance->product->Product_Name }}</td>
                                <td>${{ $serviceMaintenance->Fees }}</td>
                                <td>{{ \Carbon\Carbon::parse($serviceMaintenance->PaidDate)->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Table to display This Week's Paid Fees -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">This Week Paid Customer</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="thisWeeksPaidFeesTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Fees</th>
                                <th>Paid Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($thisWeekServiceMaintenances->isEmpty())
                            <tr>
                                <td colspan="5">No records found</td>
                            </tr>
                            @else
                            @php $serial = 1 @endphp
                            @foreach($thisWeekServiceMaintenances as $serviceMaintenance)
                            <tr>
                                <td>{{ $serial++ }}</td>
                                <td>{{ $serviceMaintenance->customer->Name }}</td>
                                <td>{{ $serviceMaintenance->product->Product_Name }}</td>
                                <td>${{ $serviceMaintenance->Fees }}</td>
                                <td>{{ \Carbon\Carbon::parse($serviceMaintenance->PaidDate)->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Table to display Total Paid Fees -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3 class="card-title">Total Paid Customer</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="paidDetailsTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Fees</th>
                                <th>Paid Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($serviceMaintenances->isEmpty())
                            <tr>
                                <td colspan="5">No records found</td>
                            </tr>
                            @else
                            @php $serial = 1 @endphp
                            @foreach($serviceMaintenances as $serviceMaintenance)
                            @if($serviceMaintenance->DueDate)
                            <tr>
                                <td>{{ $serial++ }}</td>
                                <td>{{ $serviceMaintenance->customer->Name }}</td>
                                <td>{{ $serviceMaintenance->product->Product_Name }}</td>
                                <td>${{ $serviceMaintenance->Fees }}</td>
                                <td>{{ \Carbon\Carbon::parse($serviceMaintenance->PaidDate)->format('d-m-Y') }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Table to display DueDate -->
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h3 class="card-title">Customer Next Due Dates</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dueDatesTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Customer Name</th>
                                <th>Next Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($serviceMaintenances->isEmpty())
                            <tr>
                                <td colspan="3">No records found</td>
                            </tr>
                            @else
                            @php $serial = 1 @endphp
                            @foreach($serviceMaintenances as $serviceMaintenance)
                            @if($serviceMaintenance->DueDate)
                            <tr>
                                <td>{{ $serial++ }}</td>
                                <td>{{ $serviceMaintenance->customer->Name }}</td>
                                <td>{{ \Carbon\Carbon::parse($serviceMaintenance->DueDate)->format('d-m-Y') }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Load jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
$(document).ready(function() {
    $('#paidDetailsTable').DataTable();
    $('#dueDatesTable').DataTable();
});
</script>

@endsection
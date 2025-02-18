<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Assuming your model for orders is named Order
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's Orders
        $todaysOrders = Order::whereDate('order_date', Carbon::today())->get();
        $totalFeesToday = $todaysOrders->sum('total_price');
        $customerCountToday = $todaysOrders->unique('user_id')->count();

        // This Week's Orders
        $thisWeeksOrders = Order::whereBetween('order_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $totalFeesThisWeek = $thisWeeksOrders->sum('total_price');
        $customerCountThisWeek = $thisWeeksOrders->unique('user_id')->count();

        // This Month's Orders
        $thisMonthsOrders = Order::whereMonth('order_date', Carbon::now()->month)->get();
        $totalFeesThisMonth = $thisMonthsOrders->sum('total_price');
        $customerCountThisMonth = $thisMonthsOrders->unique('user_id')->count();

        // Overall Orders
        $allOrders = Order::all();
        $totalFees = $allOrders->sum('total_price');
        $overallCustomerCount = $allOrders->unique('user_id')->count();

        // Today's Paid Customers
        $todaysServiceMaintenances = $todaysOrders->where('status', 'Paid');

        // This Week's Paid Customers
        $thisWeekServiceMaintenances = $thisWeeksOrders->where('status', 'Paid');

        // All Paid Customers
        $serviceMaintenances = $allOrders->where('status', 'Paid');

        // Fetch customers with upcoming due dates
        $dueOrders = $allOrders->whereNotNull('due_date')->sortBy('due_date');

        return view('dashboard.index', compact(
            'totalFeesToday', 'customerCountToday', 'totalFeesThisWeek', 'customerCountThisWeek',
            'totalFeesThisMonth', 'customerCountThisMonth', 'totalFees', 'overallCustomerCount',
            'todaysServiceMaintenances', 'thisWeekServiceMaintenances', 'serviceMaintenances', 'dueOrders'
        ));
    }
}
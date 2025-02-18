<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Customers;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{

public function printOrder($id) 
{
    // Get the order details
    $order = Order::with(['product', 'customer'])->findOrFail($id);
   $addressParts = isset($order->Address) ? explode(', ', $order->Address) : [];
      $productPrice = $order->product->ProductPrice;
    $shippingCharge = 50; // Set your shipping charge here
    $gstPercentage = 18; // GST as a percentage
    $gstAmount = ($productPrice + $shippingCharge)* $gstPercentage / 100;
    $totalAmount = $productPrice + $shippingCharge + $gstAmount;
    return view('OrderDetails.print', compact('order','addressParts','gstPercentage','gstAmount','totalAmount'));
}

   public function OrderIndex()
{
    if (Auth::user()->role === 'Admin') {
        // Show all orders with product and customer data for Admin
        $orders = Order::with(['product', 'customer'])->get();
    } else {
        // Show only the authenticated user's orders
        $orders = Order::where('user_id', Auth::id())->with(['product', 'customer'])->get();
    }

    return view('OrderDetails.OrderIndex', compact('orders'));
}
public function acceptOrder($orderId)
{
    // Find the order by its ID
    $order = Order::findOrFail($orderId);

    // Check if the order status is not already 'In Production'
    if ($order->status !== 'In Production') {
        // Update the order status to 'In Production'
        $order->status = 'In Production';
        $order->save();
        
        return redirect()->route('OrderDetails.OrderIndex')->with('success', 'Order is now in production.');
    }

    // If the order is already in production, do not change anything
    return redirect()->route('OrderDetails.OrderIndex')->with('error', 'This order is already in production.');
}
public function showOrderDetails($id)
{
    $order = Order::find($id);
    if ($order) {
        return view('OrderDetails.details', compact('order'));
    } else {
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }
}

    public function index(Request $request, $productId)
{
    // Ensure the user is authenticated
    $user = Auth::user();

    // Find the customer based on the authenticated user ID
    $customer = Customers::where('UserId', $user->id)->firstOrFail();

    // Fetch only the selected product based on product ID
    $product = Product::findOrFail($productId);

    // Splitting address parts for display if it exists, otherwise empty array  
    $addressParts = isset($customer->Address) ? explode(', ', $customer->Address) : [];

    return view('OrderDetails.OrderDetails', compact('user', 'customer', 'addressParts', 'product'));
}


   public function placeOrder(Request $request)
{
   $request->validate([
    'product_id' => 'required|exists:products,id',
    'quantity' => 'required|integer|min:1',
    'Name' => 'nullable|string|max:255', // Make Name optional, if it's already provided in the form
    'Phonenumber' => 'nullable|string|regex:/^[0-9]{10}$/', // Make Phonenumber optional, if it's already provided
    'landmark' => 'nullable|string|max:255',
    'DoorNo' => 'nullable|string|max:50',
    'Street' => 'nullable|string|max:255',
    'Village_Town' => 'nullable|string|max:255',
    'Post' => 'nullable|string|max:255',
    'Taluka' => 'nullable|string|max:255',
    'District' => 'nullable|string|max:255',
    'Pincode' => 'nullable|string|regex:/^[0-9]{6}$/', // Make Pincode optional, if it's already provided
]);
$formattedDate = Carbon::now()->format('Y-m-d');

    $product = Product::findOrFail($request->product_id);
    $totalPrice = $product->ProductPrice * $request->quantity;
    $customer = Auth::user();
    $order = new Order();
    $order->user_id = Auth::id();
    $order->product_id = $product->id;
    $order->quantity = $request->quantity;
    $order->total_price = $totalPrice + 50 + ($totalPrice * 0.05); // Including GST and shipping
    $order->status = 'Pending';
    $order->order_date = $request->input('formattedDate');
    $order->Address = 
     $request->input('Name') . ', ' . 
    $request->input('Phonenumber') . ', ' . 
    $request->input('landmark') . ', ' . 
    $request->input('DoorNo') . ', ' . 
    $request->input('Street') . ', ' . 
    $request->input('Village_Town') . ', ' . 
    $request->input('Post') . ', ' . 
    $request->input('Taluka') . ', ' . 
    $request->input('District') . ', ' . 
    $request->input('Pincode');
    $order->save();

    return redirect()->route('OrderDetails.confirmation')->with('success', 'Order placed successfully!');
}


}
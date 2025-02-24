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
        $order = Order::with(['product', 'customer'])->findOrFail($id);
    
        if (!$order->product) {
            return redirect()->back()->with('error', 'Product not found for this order.');
        }
    
        $addressParts = isset($order->Address) ? explode(', ', $order->Address) : [];
        $productPrice = $order->product->ProductPrice ?? 0; // Default to 0 if null
        $shippingCharge = 50; 
        $gstPercentage = 18; 
        $gstAmount = ($productPrice + $shippingCharge) * $gstPercentage / 100;
        $totalAmount = $productPrice + $shippingCharge + $gstAmount;
    
        return view('orderdetails.print', compact('order','addressParts','gstPercentage','gstAmount','totalAmount'));
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

    return view('orderdetails.orderindex', compact('orders'));
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
        
        return redirect()->route('orderdetails.orderindex')->with('success', 'Order is now in production.');
    }

    // If the order is already in production, do not change anything
    return redirect()->route('orderdetails.orderindex')->with('error', 'This order is already in production.');
}
public function showOrderDetails($id)
{
    $order = Order::find($id);
    if ($order) {
        return view('orderdetails.details', compact('order'));
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

    return view('orderdetails.orderdetails', compact('user', 'customer', 'addressParts', 'product'));
}
public function orderDetails(Request $request)
{
    $user = Auth::user();

    $productIds = json_decode($request->input('productIds'), true) ?? [];

    if (empty($productIds)) {
        return redirect()->back()->with('error', 'No products selected.');
    }

    $products = Product::whereIn('id', $productIds)->get();

    // Assuming you get the customer's data here
    $customer = Customers::where('UserId', $user->id)->firstOrFail();
    $addressParts = explode(',', $customer->Address ?? '');

    return view('orderdetails.multiorderdetails', compact('products', 'customer', 'addressParts'));
}


public function placeOrder(Request $request)
{
    try {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'Name' => 'nullable|string|max:255',
            'Phonenumber' => 'nullable|string|regex:/^[0-9]{10}$/',
            'landmark' => 'nullable|string|max:255',
            'DoorNo' => 'nullable|string|max:50',
            'Street' => 'nullable|string|max:255',
            'Village_Town' => 'nullable|string|max:255',
            'Post' => 'nullable|string|max:255',
            'Taluka' => 'nullable|string|max:255',
            'District' => 'nullable|string|max:255',
            'Pincode' => 'nullable|string|regex:/^[0-9]{6}$/',
            'order_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->ProductPrice * $request->quantity;

        $order = new Order();
        $order->user_id = Auth::id();
        $order->product_id = $product->id;
        $order->quantity = $request->quantity;
        $order->total_price = $totalPrice + 50 + ($totalPrice * 0.05);
        $order->status = 'Pending';
        $order->order_date = $request->order_date;

        $order->Address = implode(', ', [
            $request->input('Name', 'Not Available'),
            $request->input('Phonenumber', 'Not Available'),
            $request->input('landmark', ''),
            $request->input('DoorNo', ''),
            $request->input('Street', ''),
            $request->input('Village_Town', ''),
            $request->input('Post', ''),
            $request->input('Taluka', ''),
            $request->input('District', ''),
            $request->input('Pincode', '')
        ]);

        $order->save();

        return redirect()->route('orderdetails.confirmation')->with('success', 'Order placed successfully!');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return back()->withErrors(['error' => 'Product not found.']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->validator->errors());
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
    }
}



}
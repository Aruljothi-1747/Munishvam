<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Cashew_LayoutController extends Controller
{
    public function index()
    {
        $data = Product::all();
        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('app.cashew_Layout', compact('data','cartItems'));
    }

            public function show($id)
            {
                $user = Auth::user();
                $customer = Customers::where('UserId', $id)->firstOrFail();
        // Show all orders with product and customer data for Admin
        $orders = Order::with(['product', 'customer'])->get();
   
                // Split the address if it exists; otherwise, use an empty array.
                $addressParts = isset($customer->Address) ? explode(', ', $customer->Address) : [];

                return view('app.accountdetails', compact('user', 'customer', 'addressParts','orders'));
            }
    // Store a new customer
   public function Customerstore(Request $request, $id)
{
    // Get the existing customer record
    $customer = Customers::findOrFail($id);
    // Update validation rules to exclude the current user from the unique check
    $request->validate([
        'Name' => 'required|unique:customers,Name,' . $customer->id,
        'Phonenumber' => 'required|numeric',
        'DoorNo' => 'required',
        'Street' => 'required',
        'Village_Town' => 'required',
        'District' => 'required',
        'State' => 'required',
        'Pincode' => 'required',
        'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'Name.required' => 'Customer name is required.',
        'Name.unique' => 'Customer name already exists.',
        'Email.required' => 'Email is required.',
        'Email.email' => 'Invalid email format.',
        'Email.unique' => 'Email already exists.',
        'Phonenumber.required' => 'Phone number is required.',
        'Phonenumber.numeric' => 'Phone number must be numeric.',
        'DoorNo.required' => 'Door No is required.',
        'Street.required' => 'Street is required.',
        'Village_Town.required' => 'Village/Town is required.',
        'District.required' => 'District is required.',
        'State.required' => 'State is required.',
        'Pincode.required' => 'Pincode is required.',
        'Image.image' => 'The file must be an image.',
        'Image.mimes' => 'Supported image formats are jpeg, png, jpg, and gif.',
        'Image.max' => 'Maximum file size allowed is 2MB.',
    ]);

    // Update customer information
    $customer->Name = $request->input('Name');
    $customer->UserId = $request->input('UserId');
    $customer->Phonenumber = $request->input('Phonenumber');
    $customer->Pincode = $request->input('Pincode');
    $customer->District = $request->input('District');
    $customer->State = $request->input('State');
    $customer->Address = $request->input('landmark') . ', ' . 
                         $request->input('DoorNo') . ', ' . 
                         $request->input('Street') . ', ' . 
                         $request->input('Village_Town')  . ', ' . 
                        $request->input('Post') . ', ' . 
                         $request->input('Taluka') 
                        ;
    // Save the updated customer record
    $customer->save();

    return redirect()->back()->with('success', $customer->Name . ' - Updated Successfully');
}

}
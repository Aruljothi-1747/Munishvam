<?php

namespace App\Http\Controllers;
use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = customer::all();
        return view("app/customer/index")->with("data", $data);
    }
    public function create()
    {
        return view("app/customer/create");
    }
public function store(Request $request)
{
    $request->validate([
        'Name' => 'required|unique:customers',
        'Email' => 'required|email|unique:customers',
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

    // Create new customer instance and set values
    $customer = new Customer;
    $customer->Name = $request->input('Name');
    $customer->Email = $request->input('Email');
    $customer->Phonenumber = $request->input('Phonenumber');
    $customer->Address = $request->input('landmark') . ', ' . 
                         $request->input('DoorNo') . ', ' . 
                         $request->input('Street') . ', ' . 
                         $request->input('Village_Town') . ', ' . 
                         $request->input('District') . ', ' . 
                         $request->input('State') . ', ' . 
                         $request->input('Pincode');

    // Handle image upload
    // if ($request->hasFile('Image')) {
    //     $image = $request->file('Image');
    //     $imageName = time() . '.' . $image->getClientOriginalExtension();
    //     $image->move(public_path('images'), $imageName);
    //     $customer->Image = $imageName;
    // }

    $customer->save();

    return redirect('/customerindex')->with('success', $customer->Name . ' - Added Successfully');
}

    public function edit($id)
    {
        $customer = customer::findOrFail($id);
        $addressParts = explode(', ', $customer->Address);
        return view('customer.Edit', compact('customer', 'addressParts'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|unique:customers,Name,' . $id,
            'Email' => 'required|email|unique:customers,Email,' . $id,
            'Phonenumber' => 'required|numeric',
            'DoorNo' => 'required',
            'Street' => 'required',
            'City' => 'required',
            'Pincode' => 'required',
            'Image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'Name.required' => 'Customer name is required.',
            'Name.unique' => 'Customer name already exists.',
            'Email.required' => 'Email is required.',
            'Email.email' => 'Invalid email format.',
            'Email.unique' => 'Email already exists.',
            'Phonenumber.required' => 'Phone number is required.',
            'Phonenumber.numeric' => 'Phone number must be numeric.',
            'DoorNo.required' => 'Door number is required.',
            'Street.required' => 'Street is required.',
            'City.required' => 'City is required.',
            'Image.image' => 'The file must be an image.',
            'Image.mimes' => 'Supported image formats are jpeg, png, jpg, and gif.',
            'Image.max' => 'Maximum file size allowed is 2MB.',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->Name = $request->input('Name');
        $customer->Email = $request->input('Email');
        $customer->Phonenumber = $request->input('Phonenumber');
        $customer->Address = $request->input('DoorNo') . ', ' . $request->input('Street') . ', ' . $request->input('City');
        $customer->Pincode = $request->input('Pincode');
        if ($request->has('DeleteImage') && $request->input('DeleteImage')) {
            if ($customer->Image) {
                $imagePath = public_path('images/') . $customer->Image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $customer->Image = null;
            }
        }
        if ($request->hasFile('Image')) {
            if ($customer->Image) {
                $imagePath = public_path('images/' . $customer->Image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $image = $request->file('Image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $customer->Image = $imageName;
        }
        $customer->update();
        return redirect()->route('customer.index')->with('success', $customer->Name . ' - Updated Successfully');
    }
    public function destroy($id)
    {
        $customer = customer::findOrFail($id);
        if ($customer->Image) {
            $imagePath = public_path('images/' . $customer->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer record deleted successfully');
    }
}
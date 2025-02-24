<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
        public function index()
        {
            $data = product::all();
            return view("/product/index",compact('data'));
        }
        public function create()
        {
            return view("/product/create");
        }
        public function store(Request $request)
        {
            $request->validate([
                'ProductName' => 'required|string|max:255',
                'ProductLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
                'ProductLogo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
                'ProductLogo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
                'ProductLogo4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
                'ProductLogo5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
                'ProductPrice' => 'required|numeric',
                'ProductType' => 'required|string|max:255', // Ensure this is validated
                'ProductDescription' => 'required|string|max:255',
                'TaxId' => 'required|string|max:255',
                'MeasurementId' => 'nullable|string|max:255',
                'Measurement' => 'nullable|string|max:255', // Adjust if optional
            ], [
                'ProductName.required' => 'Product name is required.',
                'ProductLogo.image' => 'The file must be an image.',
                'ProductLogo.mimes' => 'Supported image formats are jpeg, png, jpg, and gif.',
                'ProductLogo.max' => 'Maximum file size allowed is 1MB.',
                'ProductLogo2.max' => 'Maximum file size allowed is 1MB.',
                'ProductLogo3.max' => 'Maximum file size allowed is 1MB.',
                'ProductLogo4.max' => 'Maximum file size allowed is 1MB.',
                'ProductLogo5.max' => 'Maximum file size allowed is 1MB.',
                'ProductPrice.required' => 'Product price is required.',
                'ProductType.required' => 'Product type is required.', // Custom message
            ]);
        
            $product = new Product();
            $product->ProductName = $request->input('ProductName');
        
        foreach (['ProductLogo', 'ProductLogo2', 'ProductLogo3', 'ProductLogo4', 'ProductLogo5'] as $field) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);
                $imageName = time() . '_' . $field . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('ProductLogos'), $imageName);
                $product->{$field} = $imageName; // Save each image to its respective column
            }
        }
            $product->ProductPrice = $request->input('ProductPrice');
            $product->ProductDescription = $request->input('ProductDescription');
            $product->TaxId = $request->input('TaxId');
            $product->MeasurementId = $request->input('MeasurementId');
            $product->Measurement = $request->input('Measurement');
            $product->ProductType = $request->input('ProductType'); // Make sure to add this line
        
            $product->save();
        
            return redirect()->route('product.index')->with('success', $product->ProductName . ' - Added Successfully');
        }
        
    

    public function show($id)
    {
        $product = product::findOrFail($id);
        return view('product.phow', compact('product'));
    }
    public function edit($id)
    {
        $product = product::findOrFail($id);
        return view('product.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'ProductPrice' => 'required|numeric',
            'ProductType' => 'required|string|max:255',
            'ProductDescription' => 'required|string|max:255',
            'TaxId' => 'required|string|max:255',
            'MeasurementId' => 'nullable|string|max:255',
            'Measurement' => 'nullable|string|max:255',
        ], [
            'ProductName.required' => 'Product name is required.',
            'ProductPrice.required' => 'Product price is required.',
            'ProductType.required' => 'Product type is required.',
            'ProductDescription.required' => 'Product description is required.',
        ]);
    
        $product = Product::findOrFail($id);

        // Update basic product fields
        $product->ProductName = $request->input('ProductName');
        $product->ProductPrice = $request->input('ProductPrice');
        $product->ProductType = $request->input('ProductType');
        $product->ProductDescription = $request->input('ProductDescription');
        $product->TaxId = $request->input('TaxId');
        $product->MeasurementId = $request->input('MeasurementId');
        $product->Measurement = $request->input('Measurement');
    
        // Handle product logos
        foreach (['ProductLogo', 'ProductLogo2', 'ProductLogo3', 'ProductLogo4', 'ProductLogo5'] as $field) {
            // Delete image if requested
            if ($request->input("DeleteImage_{$field}") == 1 && $product->{$field}) {
                $imagePath = public_path('ProductLogos/' . $product->{$field});
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete from storage
                }
                $product->{$field} = null; // Remove from database
            }
    
            // Upload new image if provided
            if ($request->hasFile($field)) {
                if ($product->{$field}) {
                    $oldImagePath = public_path('ProductLogos/' . $product->{$field});
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Delete old image
                    }
                }
    
                $image = $request->file($field);
                $imageName = time() . '_' . $field . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('ProductLogos'), $imageName);
                $product->{$field} = $imageName;
            }
        }
    
        $product->save(); // Save the product
    
        return redirect()->route('product.index')->with('success', $product->ProductName . ' - Updated Successfully');
    }
    
    
    public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Define an array of logo fields
    $logoFields = ['ProductLogo', 'ProductLogo2', 'ProductLogo3', 'ProductLogo4', 'ProductLogo5'];

    // Loop through each logo field and delete associated file if it exists
    foreach ($logoFields as $logoField) {
        if (!empty($product->{$logoField})) {
            $imagePath = public_path('ProductLogos/' . $product->{$logoField});
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
        }
    }

    // Delete the product record
    $product->delete();

    // Redirect with a success message
    return redirect()->route('product.index')->with('success', 'Product record and all associated logos deleted successfully.');
}

}
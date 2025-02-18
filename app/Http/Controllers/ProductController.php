<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
        public function index()
        {
          
           
            $data = product::all();
           
            return view("/Product/Index",compact('data'));
        }
    public function create()
    {
        return view("/Product/Create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'ProductLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
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
            'ProductPrice.required' => 'Product price is required.',
            'ProductType.required' => 'Product type is required.', // Custom message
        ]);
    
        $product = new Product();
        $product->ProductName = $request->input('ProductName');
    
        if ($request->hasFile('ProductLogo')) {
            $image = $request->file('ProductLogo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductLogos'), $imageName);
            $product->ProductLogo = $imageName;
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
        return view('Product.Show', compact('product'));
    }
    public function edit($id)
    {
        $product = product::findOrFail($id);
        return view('product.Edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'ProductLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'ProductPrice' => 'required|numeric',
            'ProductType' => 'required|string|max:255',
            'ProductDescription' => 'required|string|max:255',
            'TaxId' => 'required|string|max:255',
            'MeasurementId' => 'nullable|string|max:255',
            'Measurement' => 'nullable|string|max:255',
        ], [
            'ProductName.required' => 'Product name is required.',
            'ProductLogo.image' => 'The file must be an image.',
            'ProductLogo.mimes' => 'Supported image formats are jpeg, png, jpg, and gif.',
            'ProductLogo.max' => 'Maximum file size allowed is 1MB.',
            'ProductPrice.required' => 'Product price is required.',
            'ProductType.required' => 'Product type is required.',
        ]);

        $product = Product::findOrFail($id);
        $product->ProductName = $request->input('ProductName');

        if ($request->has('DeleteImage') && $request->input('DeleteImage')) {
            if ($product->ProductLogo) {
                $imagePath = public_path('ProductLogos/') . $product->ProductLogo;
                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $product->ProductLogo = null;
            }
        }
        if ($request->hasFile('ProductLogo')) {
            if ($product->ProductLogo) {
                $previousImagePath = public_path('ProductLogos/') . $product->ProductLogo;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('ProductLogo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductLogos'), $imageName);
            $product->ProductLogo = $imageName;
        }
        $product->ProductPrice = $request->input('ProductPrice');
        $product->ProductDescription = $request->input('ProductDescription');
        $product->TaxId = $request->input('TaxId');
        $product->MeasurementId = $request->input('MeasurementId');
        $product->Measurement = $request->input('Measurement');
        $product->ProductType = $request->input('ProductType');
        $product->update();
        return redirect()->route('product.index')->with('success', $product->ProductName . ' - Updated Successfully');
    }
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        if ($product->ProductLogo) {
            $imagePath = public_path('ProductLogos/' . $product->ProductLogo);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product record deleted successfully');
    }
}
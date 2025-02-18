<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function addToCart(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'productId' => 'required|integer',
        'name' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|string',  // Just store the image filename as a string
        'quantity' => 'required|integer',
    ]);

    // Save the product to the cart table
    $cart = new Cart();
    $cart->product_id = $validated['productId'];
    $cart->name = $validated['name'];
    $cart->price = $validated['price'];
    $cart->image = $validated['image']; // Store only the image filename (e.g., '1727854898.jpg')
    $cart->quantity = $validated['quantity'];
    $cart->user_id = auth()->id(); // Assuming the user is logged in
    $cart->save();

    return response()->json(['success' => true, 'message' => 'Product added to cart']);
}

  public function getCartDetails()
{
    $userId = Auth::id(); // Get the authenticated user's ID

    $cartItems = Cart::where('user_id', $userId)
        ->with('product') // Load related product data
        ->get()
        ->map(function ($cart) {
            return [
                'product_id' => $cart->product_id,
                'product_name' => $cart->name ?? 'Unknown Product', // Fallback to 'Unknown Product' if no product is found
                'product_image' => $cart->image ? asset('ProductLogos/' . $cart->image) : asset('default.jpg'), // Construct the full image URL
                'product_price' => $cart->price ?? 0, // Fallback to 0 if price is not available
                'quantity' => $cart->quantity,
            ];
        });

    return response()->json([
        'success' => true,
        'cartItems' => $cartItems,
    ]);
}

public function removeFromCart($productId)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Find the cart item by product_id and user_id
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();

            return response()->json(['success' => true, 'message' => 'Item removed from cart']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart']);
    }


}
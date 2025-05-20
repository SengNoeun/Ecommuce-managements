<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('status', 1)->get();
            $slides = Slide::where('status', 1)->orderBy('od', 'desc')->paginate(1);
            $brands = Brand::where('status', 1)->get();
            $products = Product::select('id', 'image', 'name', 'price', 'discount', 'price_after_discount')
                ->orderBy('od', 'desc')
                ->paginate(8);

            $userId = session()->get('ID');

            $cartItems = Cart::when($userId, function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }, function ($query) {
                    return $query->whereNull('user_id');
                })
                ->get()
                ->toArray();

            $cartTotals = $this->calculateCartTotals($cartItems);

            return view('client.cart.index', compact('categories', 'slides', 'products', 'brands', 'cartItems', 'cartTotals'));
        } catch (Exception $e) {
            Log::error('Error in CartController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the cart.');
        }
    }



    public function addToCart(Request $request, $productId)
    {
        $userId = session()->get('ID');

        try {
            $request->validate([
                'quantity' => 'nullable|integer|min:1',
            ]);
            $quantity = $request->input('quantity', 1);

            $product = Product::where('id', $productId)->where('status', 1)->firstOrFail();

            $cartItem = Cart::where('product_id', $productId)
                ->when($userId, fn ($q) => $q->where('user_id', $userId), fn ($q) => $q->whereNull('user_id'))
                ->first();

            $existingQty = $cartItem ? $cartItem->quantity : 0;
            $newTotalQty = $existingQty + $quantity;

            if ($newTotalQty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['success' => false, 'message' => 'Insufficient stock!'], 400)
                    : redirect()->back()->with('error', 'Insufficient stock!');
            }

            $images = json_decode($product->image, true);
            $image = is_array($images) && !empty($images) ? $images[0] : $product->image;
            $price = $product->price_after_discount ?? $product->price;

            if ($cartItem) {
                $cartItem->quantity = $newTotalQty;
                $cartItem->subtotal = $price * $newTotalQty;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'name' => $product->name,
                    'image' => $image,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $price * $quantity,
                ]);
            }

            $cartCount = Cart::when($userId, fn ($q) => $q->where('user_id', $userId), fn ($q) => $q->whereNull('user_id'))->count();

            return $request->expectsJson()
                ? response()->json(['success' => true, 'message' => 'Product added to cart!', 'cartCount' => $cartCount])
                : redirect()->back()->with('success', 'Product added to cart!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Product not found: ' . $e->getMessage());
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => 'Product not found or inactive!'], 404)
                : redirect()->back()->with('error', 'Product not found or inactive!');
        } catch (\Exception $e) {
            Log::error('Add to cart failed: ' . $e->getMessage());
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => 'Failed to add product to cart.'], 500)
                : redirect()->back()->with('error', 'Failed to add product to cart.');
        }
    }

    // You can adapt updateQuantity, removeItem, and mergeGuestCart similarly if needed



    private function calculateCartTotals($items)
    {
        $subtotal = array_sum(array_column($items, 'subtotal'));
        $vat = $subtotal * 0.015;
        return ['subtotal' => $subtotal ?: 0, 'vat' => $vat ?: 0, 'total' => ($subtotal + $vat) ?: 0];
    }

   

    public function updateQuantity(Request $request, $id)
       
    {
        try { 
            
            $userId = session()->get('ID');

            $cartItem = Cart::where('user_id', $userId)
                ->where('id', $id)
                ->first();

            if ($cartItem) {
                $product = Product::findOrFail($cartItem->product_id);
                $newQuantity = $cartItem->quantity;

                if ($request->input('action') === 'increment') {
                    $newQuantity++;
                    $stockChange = $newQuantity - $cartItem->quantity;
                    if ($product->stock < $stockChange) {
                        return response()->json(['success' => false, 'message' => 'Insufficient stock!']);
                    }
                } elseif ($request->input('action') === 'decrement' && $cartItem->quantity > 1) {
                    $newQuantity--;
                }

                // Update stock only if quantity changes
                if ($newQuantity !== $cartItem->quantity) {
                    $stockChange = $newQuantity - $cartItem->quantity;
                    $product->stock -= $stockChange;
                    $product->save();
                }

                $cartItem->quantity = $newQuantity;
                $cartItem->subtotal = $cartItem->price * $cartItem->quantity;
                $cartItem->save();

                return response()->json(['success' => true, 'quantity' => $cartItem->quantity, 'subtotal' => $cartItem->subtotal]);
            }

            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        } catch (Exception $e) {
            Log::error('Error in CartController@updateQuantity: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update quantity']);
        }
    }

   public function removeItem($id)
{
    try {
        $userId = session()->get('ID');

        $cartItem = Cart::where('id', $id)
            ->when($userId, fn ($q) => $q->where('user_id', $userId), fn ($q) => $q->whereNull('user_id'))
            ->first();

        if ($cartItem) {
            $product = Product::findOrFail($cartItem->product_id);

            // Return stock to the product
            $product->stock += $cartItem->quantity;
            $product->save();

            $cartItem->delete();

            return response()->json(['success' => true, 'message' => 'Item removed from cart']);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found']);
    } catch (Exception $e) {
        Log::error('Error in CartController@removeItem: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to remove item']);
    }
}

    /**
     * Merge guest cart with authenticated user cart upon login
     */
    public function mergeGuestCart()
    {
        try {
            if (Auth::check()) {
                $guestIdentifier = 'guest_' . session()->getId();
                $userIdentifier = 'user_' . Auth::id();

                // Find guest cart items
                $guestCartItems = Cart::where('identifier', $guestIdentifier)->get();

                foreach ($guestCartItems as $guestItem) {
                    $product = Product::find($guestItem->product_id);
                    if (!$product || $product->status != 1) {
                        $guestItem->delete();
                        continue;
                    }

                    // Check for existing user cart item
                    $userCartItem = Cart::where('identifier', $userIdentifier)
                        ->where('product_id', $guestItem->product_id)
                        ->first();

                    if ($userCartItem) {
                        // Update existing user cart item
                        $newQuantity = $userCartItem->quantity + $guestItem->quantity;
                        if ($newQuantity <= $product->stock) {
                            $userCartItem->quantity = $newQuantity;
                            $userCartItem->subtotal = $userCartItem->price * $newQuantity;
                            $userCartItem->save();
                        }
                        $guestItem->delete();
                    } else {
                        // Update identifier to user
                        $guestItem->identifier = $userIdentifier;
                        $guestItem->user_id = Auth::id();
                        $guestItem->save();
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Error in CartController@mergeGuestCart: ' . $e->getMessage());
        }
    }
} 

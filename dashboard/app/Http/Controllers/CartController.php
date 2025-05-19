<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

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

            // Use session ID for guests
            $identifier = Auth::check() ? Auth::id() : session()->getId();
            $cartItems = Cart::where('identifier', $identifier)
                ->where('user_id',1)
                ->get()
                ->toArray();
            $cartTotals = $this->calculateCartTotals($cartItems);

            return view('client.cart.index', compact('categories', 'slides', 'products', 'brands', 'cartItems', 'cartTotals'));
        } catch (Exception $e) {
            Log::error('Error in CartController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the cart.');
        }
    }

    private function calculateCartTotals($items)
    {
        $subtotal = array_sum(array_column($items, 'subtotal'));
        $vat = $subtotal * 0.015;
        return ['subtotal' => $subtotal ?: 0, 'vat' => $vat ?: 0, 'total' => ($subtotal + $vat) ?: 0];
    }

    public function addToCart(Request $request, $productId)
    {
        try {
            $identifier = Auth::check() ? Auth::id() : session()->getId();
            $userId = 1;

            $product = Product::findOrFail($productId);

            $images = json_decode($product->image, true);
            $image = is_array($images) ? (array_slice($images, 0, 1)[0] ?? '') : $product->image;

            $cartItem = Cart::where('identifier', $identifier)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->input('quantity', 1);
                $cartItem->subtotal = $cartItem->price * $cartItem->quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'identifier' => $identifier,
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'name' => $product->name,
                    'image' => $image,
                    'price' => $product->price_after_discount,
                    'quantity' => $request->input('quantity', 1),
                    'subtotal' => $product->price_after_discount * $request->input('quantity', 1),
                ]);
            }

            return redirect()->back()->with('success', 'Product added to cart!');
        } catch (Exception $e) {
            Log::error('Error in CartController@addToCart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add product to cart.');
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $identifier = Auth::check() ? Auth::id() : session()->getId();

            $cartItem = Cart::where('identifier', $identifier)
                ->where('id', $id)
                ->first();

            if ($cartItem) {
                if ($request->input('action') === 'increment') {
                    $cartItem->quantity++;
                } elseif ($request->input('action') === 'decrement' && $cartItem->quantity > 1) {
                    $cartItem->quantity--;
                }
                $cartItem->subtotal = $cartItem->price * $cartItem->quantity;
                $cartItem->save();
                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        } catch (Exception $e) {
            Log::error('Error in CartController@updateQuantity: ' . $e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    public function removeItem($id)
    {
        try {
            $identifier = Auth::check() ? Auth::id() : session()->getId();

            $cartItem = Cart::where('identifier', $identifier)
                ->where('id', $id)
                ->first();

            if ($cartItem) {
                $cartItem->delete();
                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        } catch (Exception $e) {
            Log::error('Error in CartController@removeItem: ' . $e->getMessage());
            return response()->json(['success' => false]);
        }
    }
}
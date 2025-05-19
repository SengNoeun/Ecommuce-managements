<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class HeaderController extends Controller
{
    public function index()
    {    $products = Product::all()->map(function ($product) {
          $product->slide_name = Slide::find($product->slide)->name ?? 'N/A';
          $product->brand_name = Brand::find($product->brand)->name ?? 'N/A';
          $product->category_name = Category::find($product->category)->name ?? 'N/A';
          return $product;
          });
          $categorys = Category::where('status', 1)->get();
          $slides = Slide::where('status', 1)->get();
          $slides = Slide::orderBy('od','desc')->paginate(1);
         $products = Product::select('id', 'image', 'name', 'price', 'discount','price_after_discount')
            ->orderBy('od', 'desc')
            ->paginate(8);
          return view('client.home.index', compact('categorys','slides','products'));
        
    }
    

   
}
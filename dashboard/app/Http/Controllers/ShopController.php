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

class ShopController extends Controller
{
    public function index()
    {     
          
         $products = Product::all();
          $categorys = Category::where('status', 1)->get();
          $slides = Slide::where('status', 1)->get();
          $brands = Brand::where('status', 1)->get();
          $slides = Slide::orderBy('od','desc')->paginate(1);
         $products = Product::select('id', 'image', 'name', 'price', 'discount','price_after_discount')
            ->orderBy('od', 'desc')
            ->paginate(8);
          return view('client.shop.index', compact('categorys','slides','products','brands'));
        
    }
    

   
}
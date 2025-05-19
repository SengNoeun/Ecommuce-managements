<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        $totalUsers = User::count();
       $cartItems = Cart::all();
        return view('admin.dashboard.index', compact('totalUsers', 'cartItems'));
    }
}

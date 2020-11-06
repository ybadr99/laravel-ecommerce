<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
// use Gloudemans\Shoppingcart\Facades\Cart;

class LandingPageController extends Controller
{
    public function index()
    {   
        $products = Product::inRandomOrder()->take(8)->get();
        return view('landing-page',compact('products'));
    }
}

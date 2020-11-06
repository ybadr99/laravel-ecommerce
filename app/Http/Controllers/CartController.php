<?php

namespace App\Http\Controllers;

// use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    
    public function index()
    {
        $mightAlsoLike = Product::inRandomOrder()->take(4)->get();
        return view('cart')->with('mightAlsoLike',$mightAlsoLike);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('warning','Item is already exits!');
        }

        Cart::add($request->id, $request->name, 1,$request->price)
              ->associate('App\Product');
        
        return redirect()->route('cart.index')->with('success','Item Added Successfuly!');
    }


    public function show(Cart $cart)
    {
        //
    }

    
    public function edit(Cart $cart)
    {
        //
    }


    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function destroy($id)
    {
        // dd($id);
        Cart::remove($id);
        return back()->with('success','Item Deleted Successfuly!');

    }

    public function savelater($id)
    {

        
        $item = Cart::get($id);

        Cart::remove($id);
        
        $duplicates = Cart::instance('savelater')->search(function ($cartItem, $rowId) use ($id){
            return $cartItem->id === $id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('warning','Item is already saved for later!');
        }

        Cart::instance('savelater')->add($item->id, $item->name, 1,$item->price)
                ->associate('App\Product');
        
        return back()->with('success','Item has been saved for later !');

    }


}

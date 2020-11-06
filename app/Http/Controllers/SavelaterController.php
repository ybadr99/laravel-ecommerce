<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;

class SavelaterController extends Controller
{
    public function destroy($id)
    {
        // dd($id);
        Cart::instance('savelater')->remove($id);
        return back()->with('success','Item Deleted Successfuly!');

    }

    public function movetocart($id)
    {
        $item = Cart::instance('savelater')->get($id);
        // dd($item);

        Cart::instance('savelater')->remove($id);
        
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
            return $cartItem->id === $id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('warning','Item is already moved to cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1,$item->price)
                ->associate('App\Product');
        
        return back()->with('success','Item has been moved to cart !');
    }

}

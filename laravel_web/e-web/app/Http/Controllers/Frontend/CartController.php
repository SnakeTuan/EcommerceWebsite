<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_product(Request $request){
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');
        if(Auth::check()){
            $product_check = Product::where('id', $product_id)->first();
            if($product_check){
                if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                    return response()->json(['status' => $product_check->name.' Already added to cart']);
                }
                else{
                    $cart_item = new Cart();
                    $cart_item->product_id = $product_id;
                    $cart_item->user_id = Auth::id();
                    $cart_item->product_quantity = $product_quantity;
                    $cart_item->save();
                    return response()->json(['status' => $product_check->name.' Added to cart']);
                }  
            }
        }
        else{
            return response()->json(['status' => 'Login to continue']);
        }
    }

    public function view_cart(){
        $cart_item = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cart_item'));
    }

    public function delete_product(Request $request){
        if(Auth::check()){
            $product_id = $request->input('product_id');
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                $cart_item = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart_item->delete();
                return response()->json(['status' => '']);
            }
        }
        else{
            return response()->json(['status' => 'Login to continue']);
        }
    }

    public function update_cart(Request $request){
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');
        if(Auth::check()){
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                $cart_item = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart_item->product_quantity = $product_quantity;
                $cart_item->update();
                return response()->json(['status' => 'Quantity updated']);
            }
        }
    }
}

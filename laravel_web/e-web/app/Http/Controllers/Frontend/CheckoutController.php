<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $old_cart_item = Cart::where('user_id', Auth::id())->get();
        foreach($old_cart_item as $item){
            if(Product::where('id', $item->product_id)->where('quantity', '<', $item->product_quantity)->exists()){
                $remove_item = Cart::where('product_id', $item->product_id)->where('user_id', Auth::id())->first();
                $remove_item->delete();
            }
            else{
                continue;
            }
        }
        $cart_item = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cart_item'));
    }

    public function place_order(Request $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        $order->tracking_number = 'Order'.rand(1111, 9999);

        $total = 0;
        $cart_item_total = Cart::where('user_id', Auth::id())->get();
        foreach($cart_item_total as $item){
            $total += $item->product->selling_price;
        }
        $order->total_price = $total;

        $order->save();
        
        $cart_item = Cart::where('user_id', Auth::id())->get();
        foreach($cart_item as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->product_quantity,
                'price' => $item->product->selling_price,
            ]);
            $product = Product::where('id', $item->product_id)->first();
            $product->quantity = $product->quantity - $item->product_quantity;
            $product->update();
        }

        if(Auth::user()->address == NULL){
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }

        $cart_item = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cart_item);

        return redirect('/')->with('status', 'Order placed successfully');
    }
}

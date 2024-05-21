<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $cartItems = Cart::where('user_id', $userId)->get();
        $products = array();
        foreach ($cartItems as $cartItem) {
            array_push($products, Product::where('id', $cartItem->product_id)->first());
        }

        $subtotalArray = array();
        foreach($products as $product) {
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product_id == $product->id) {
                     array_push($subtotalArray, number_format($product->price*$cartItem->quantity, 2));
                }
            }
        }
        $subtotal = 0;
        foreach ($subtotalArray as $sub){
            $subtotal += $sub;
        }
        return view('pages.products.cart', ["products" => $products, "cartItems" => $cartItems, 'subtotal' => $subtotal]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $existingCartItem = Cart::where('product_id', $product->id)->where('user_id', $user->id)->first();
        try {
            DB::beginTransaction();
            if ($existingCartItem == null) {
                $cart = Cart::create(['user_id' => Auth::user()->id, 'product_id' => $product->id, 'quantity' => $request->quantity]);
            } else {
                $cart = Cart::where('id', $existingCartItem->id)->update(['quantity' => $request->quantity + $existingCartItem->quantity]);
            }
            DB::commit();
            return redirect()->back()->with('success', "Added to cart.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteCartItem($id)
    {
        try {
            DB::beginTransaction();
            $cartItem = Cart::find($id);
            $cartItem->delete();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateCart(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Cart::find($id)->update(['quantity' => $request->quantity]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function orderItem($id)
    {
        $cartItems = Cart::where('user_id', $id)->get();
        $products = array();
        foreach ($cartItems as $cartItem) {
            array_push($products, Product::where('id', $cartItem->product_id)->first());
        }

        $subtotalArray = array();
        foreach($products as $product) {
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product_id == $product->id) {
                    array_push($subtotalArray, number_format($product->price*$cartItem->quantity, 2));
                }
            }
        }
        $subtotal = 0;
        foreach ($subtotalArray as $sub){
            $subtotal += $sub;
        }
        try {
            DB::beginTransaction();
            $order = Order::create(['price' => $subtotal, 'user_id' => $id]);
            $orderId = Order::select('id')->where('price', $subtotal)->where('user_id', $id)->first();
            foreach($products as $product){
                $orderProduct = DB::table('order_product')->insert(['order_id' => $orderId->id, 'product_id' => $product->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            redirect()->back()->with('success', "Order confirmed.");
            Cart::truncate();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

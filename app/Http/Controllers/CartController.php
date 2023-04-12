<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /*
     * Show cart interface with data
     *
     * @return resources/views/cart.blade.php
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $amount = $carts->sum('amount');
        $total = 0;
        foreach ($carts as $item) {
            $total += $item->product->price;
        }
        return view('cart', [
            'carts' => $carts,
            'amount' => $amount,
            'total' => $total
        ]);
    }

    /*
     * Store product to cart table from list of product page
     *
     * @param Integer $request->product id
     *
     * @return resources/views/cart.blade.php
     */

    public function store(Request $request)
    {
        $cart = new Cart();
        $product = Product::where('id', $request->productId);
        if ($product->exists() && $product->first()->stock > 0) {
            $cart = $cart->where([
                ['product_id', $request->productId],
                ['user_id', Auth::user()->id]
            ]);
            if ($cart->exists()) {
                $cart->update([
                    'amount' => $cart->first()->amount + 1
                ]);
                $product->update([
                    'stock' => $product->first()->stock - 1
                ]);
            } else {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->productId,
                    'amount' => 1
                ]);
                $product->update([
                    'stock' => $product->first()->stock - 1
                ]);
            }
            return redirect()->route('cart');
        } else {
            return back();
        }
    }

     /*
     * Store product to cart table from product detail page
     *
     * @param Integer $request->product id, $request->quantity
     *
     * @return resources/views/cart.blade.php
     */
    public function storeInDetail(Request $request)
    {
        $cart = new Cart();
        $product = Product::where('id', $request->productId);
        if ($product->exists() && $product->first()->stock > 0) {
            $cart = $cart->where([
                ['product_id', $request->productId],
                ['user_id', Auth::user()->id]
            ]);
            if ($cart->exists()) {
                $cart->update([
                    'amount' => $cart->first()->amount + $request->quantity
                ]);
                $product->update([
                    'stock' => $product->first()->stock - $request->quantity
                ]);
            } else {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->productId,
                    'amount' => $request->quantity
                ]);
            }
            return redirect()->route('cart');
        } else {
            return back();
        }
    }

     /*
     * Delete product in cart page
     *
     * @param : integer id
     *
     * @return resources/views/cart.blade.php
     */
    public function delete($id)
    {
        $cart = Cart::where('id', $id);
        if ($cart->exists()) {
            $product = Product::where('id', $cart->first()->product_id);
            $product->update([
                'stock' => $product->first()->stock + $cart->first()->amount
            ]);
            $cart->delete();
            return redirect()->route('cart');
        } else {
            return back();
        }
    }

     /*
     * Show checkout page, redirect from cart page
     *
     *
     * @return resources/views/checkout.blade.php
     */
    public function checkout()
    {
        $total = 0;
        $data = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($data as $item) {
            $total += $item->amount * $item->product->price;
        }
        return view('checkout', [
            'payment_methods' => PaymentMethod::all(),
            'carts' => $data,
            'total' => $total
        ]);
    }

    /*
     * Finish checkout and store in order, transaction table
     * and delete in cart table by user_id
     *
     *
     * @return resources/views/order.blade.php
     */
    public function checkoutStore(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:10', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return redirect()->route('checkout')->withErrors($validate->errors());
        } else {
            $carts =  Cart::where('user_id', Auth::user()->id)->get();
            $transaction = [];
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'payment_methods_id' => $request->paymentMethod,
                'purchased_date' => Carbon::now(),
                'estimated_delivery_date' => date("Y-m-d", time() + 86400 * 3),
                'shipping_address' => $request->address,
                'total' => $request->total
            ]);
            foreach ($carts as $item) {
                $transaction [] =[
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'order_id' => $order->id
                ];
            }
            Transaction::insert($transaction);
            Cart::where('user_id', Auth::user()->id)->delete();
            return redirect()->route('order')->with("checkoutSuccess", true);
        }
    }
}

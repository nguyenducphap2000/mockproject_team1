<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use function GuzzleHttp\Promise\all;

class OrderController extends Controller
{
    public function index()
    {
        $data = [];
        if (Auth::user()->is_admin) {
            $data = Order::paginate(10);
        } else {
            $data = Order::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('order', [
            'orders' => $data
        ]);
    }
    public function show($id)
    {
        if (Order::where([
            ['user_id', Auth::user()->id],
            ['id', $id]
        ])->exists() || Auth::user()->is_admin) {
            $data = Transaction::where('order_id', $id)->get();
            $total = 0;
            foreach ($data as $item) {
                $total += $item->amount * $item->product->price;
            }
            return view('order-show', [
                'transactions' => $data,
                'user' => User::find($data[0]->order->user_id),
                'total' => $total,
                'quantity' => $data->sum('amount'),
                'order_id' => $id
            ]);
        } else {
            return back();
        }
    }

    public function acceptOrder($id)
    {
        if (Auth::user()->is_admin) {
            Order::where('id', $id)->update(
                ['order_status' => true]
            );
            return Redirect::back()->with('acceptSuccess', true);
        } else {
            return back();
        }
    }

    public function checkedOrder($id)
    {
        if (Auth::user()->is_admin) {
            Order::where('id', $id)->update(
                ['payment_status' => true]
            );
            return redirect()->route('order')->with('checkedSuccess', true);
        } else {
            return back();
        }
    }

    public function deleteOrder(Request $request)
    {
        if (Auth::user()->is_admin) {
            Order::where('id', $request->order_id)->delete();
            return Redirect::back()->with('deleteSuccess', true);
        } else {
            return back();
        }
    }

    public function search(Request $request)
    {
        $request->flash();
        $data = [];
        if(empty($request->billingName))
        {
            $query = new Order();
        }else{
            $user = User::where('name', 'like', '%' . $request->billingName . '%')->first();
            $query = Order::where('user_id', $user->id);
        }

        if (Auth::user()->is_admin) {
            $data = $query->paginate(10);
        } else {
            $data = $query->where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('order', [
            'orders' => $data
        ]);
    }
}

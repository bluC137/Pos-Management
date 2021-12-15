<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_Detail;
use App\Product;
use App\Cart;
use App\Transaction;
use Auth;
use DB;
class OrderTransactionController extends Controller
{
    public function for_approval(){
        $user = Auth::user();
        $products = Product::where('status','ACTIVE')->get();
        $orders = Order::all();

        $lastID = Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id', $lastID)->get();

        $transaction = Transaction::where('order_id', $lastID)->get();

        $pendings = Cart::with('cashier')->with('product_data')->where('temp_discount','>',0)->where('discount_status',0)->get();
        return view('orders.for_approval',
        ['products' => $products,
        'orders' => $orders,
        'order_receipt' => $order_receipt,
        'transactions' => $transaction,
        'pendings'=>$pendings]);
    }
}

<?php

namespace App\Http\Livewire;
use App\Transaction;
use App\Order_Detail;
use App\Product;
use App\User;
use App\Order;
use App\Returned;
use Livewire\Component;

class Transactions extends Component
{
    public $order_details=[]; 

    public $transaction_details=[]; 

    public $user_details=[]; 
    public $product=[]; 
    
    public function UserDetails($user_id)
    {
      $this->user_details = User::where('id' , $user_id) -> get();
    
    }
    
    public function TransactionDetails($order_id)
    {
      $this->transaction_details = Order::where('id' , $order_id) -> get();
    
    }

    public function OrderDetails($order_id)
    {
      $this->order_details = Order_Detail::where('order_id' , $order_id) -> get();
    
    }

    public function setItem($product_id)
    {
      $this->product = Product::where('id' , $product_id ) -> get();
    }

    public function render()
    {
        return view('livewire.transactions', ['transactions'=>Transaction::paginate(5),'returns'=>Returned::paginate(5)]);
    }
}

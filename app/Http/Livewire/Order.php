<?php

namespace App\Http\Livewire;
use App\Product;
use App\Cart;
use Livewire\Component;


class Order extends Component
{
    public $orders, $products = [], $product_code, $message='', $productIncart;
    public $pay_money, $balance;

    
    public function mount()
    {
        $this->products = Product::all();
        $this->productIncart = Cart::all();
    }

    public function InsertoCart()
    {
        $countProduct = Product::where('id', $this->product_code)->first();
            //here the 3 return
            if (!$countProduct){
                return session()->flash('error', 'Product Not Found');
                
            }

            $countCartProduct = Cart::where('product_id', $this->product_code)->count();

            if ($countCartProduct >  0){
                return session()->flash('info', 'Product ' .$countProduct->product_name .' already exists in cart. Please add quantity. ');

            }

            $add_to_cart = new Cart;
            $add_to_cart->product_id = $countProduct->id;
            $add_to_cart->product_qty = 1;
            $add_to_cart->product_price = $countProduct->price;
            $add_to_cart->user_id = auth()->user()->id;
            $add_to_cart->save();

            
            $this->productIncart->prepend($add_to_cart);
            $this->product_code = ' ';
            return session()->flash('success', "Product Added Successfully");
            //return $this->message ="Product Added Successfully"; 
       
        //dd($countProduct);

    }

 

    //here
    public function removeProduct($cartId){
        $deleteCart = Cart::find($cartId);
        $deleteCart->delete();
        
      
       
       // return  $this->message = "Product removed from Cart";
      
       $this->productIncart = $this->productIncart->except($cartId);
       $this->emit('');
    
    return session()->flash('success', "Product removed from Cart");
    }
    

    public function IncrementQty($cartId){
        $carts = Cart::find($cartId);
        $carts->increment('product_qty', 1);
        $updatePrice = $carts->product_qty * $carts->product_price;
        $total = floatval($updatePrice)-floatval($carts->discount);
        $carts->update(['product_price' => $carts->product_price]);
        $this->mount();
    }

    public function DecrementQty($cartId){
        $carts = Cart::find($cartId);
        if ($carts->product_qty == 1){
            return session()->flash('info', 'Product ' . $carts->product->product_name. ' cannot be less than 1, add quantity or remove product in cart.');

        }
        $carts->decrement('product_qty', 1);
        $updatePrice = $carts->product_qty * $carts->product_price;
        $total = floatval($updatePrice)-floatval($carts->discount);
        $carts->update(['product_price' => $carts->product_price]);
        $this->mount();
    }

    
    public function render()
    {
            // if ($this->pay_money != ''){
            //     $totalAmount = $this->pay_money - $this->productIncart->sum('product_price');
            //     $this->balance = $totalAmount;

            // }

            
            
        return view('livewire.order');
    }
}

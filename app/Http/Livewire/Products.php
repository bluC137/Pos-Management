<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;

use Livewire\Component;
use App\Supplier;
use App\Product;




class Products extends Component
{

    public $products_details=[]; 

    public function mount()
    {
       $this->supplier = Supplier::all();
    }
    public function ProductDetails($product_id)
    {
      $this->products_details = Product::where('id' , $product_id) -> get();
    
    }

    public function render()
    {
      

        return view('livewire.products', ['products'=>Product::latest()->paginate(5),]);
    }
}

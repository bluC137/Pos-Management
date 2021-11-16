<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\Product;
use App\Stockin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    
class StockinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $product_details=[]; 

    public $user_details=[]; 
    
    public function UserDetails($user_id)
    {
      $this->user_details = User::where('id' , $user_id) -> get();
  
    }
    
    public function TransactionDetails($order_id)
    {
      $this->product_details = Product::where('id' , $order_id) -> get();
    
    }

    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $stocks = Stockin::all();
        


        if($user->is_admin==1){
            return view('stocks.index', ['suppliers' => $suppliers,'products' => $products,'stocks' => $stocks,'users' => $users]);
        }else{
            return redirect(route('cashier-content'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request   
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = new Stockin();
        $stock->product_id = $request->product_id;  
        $stock->quantity = $request->quantity;
        $stock->supplier = $request->supplier_name;
        $stock->user_id = auth()->user()->id;
        $stock->remarks = $request->remarks;
        $stock->save();
        
        $prod = Product::find($request->product_id);
        $prod->quantity = $prod->quantity + $request->quantity;
        $prod->save();


if ($stock) {
  return redirect()->back()->with('Supplier Created Successfully');
}
  return redirect()->back()->with('Failed to Create Stock');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stockin  $stockin
     * @return \Illuminate\Http\Response
     */
    public function show(Stockin $stockin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stockin  $stockin
     * @return \Illuminate\Http\Response
     */
    public function edit(Stockin $stockin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stockin  $stockin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stock = Stockin::find($id);
        if (!$stock) {
            return back()->with('Error', 'Stock not Found');
        }
        $stock->update($request->all());
        return back()->with('Success', 'Stock Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stockin  $stockin
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
        $stock = Stockin::find($id);
        if (!$stock) {
            return back()->with('Error', 'Stock not Found');
        }
        $stock->delete();
        return back()->with('Success', 'Stock Deleted Successfully!');
    }
}

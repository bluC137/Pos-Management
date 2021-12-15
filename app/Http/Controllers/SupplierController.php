<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $supplier =  Supplier::paginate(5);
        $products = Product::all();
        if($user->is_admin==1){
        return view('suppliers.index', ['suppliers' => $supplier,'products' => $products]);
        }
        elseif($user->is_admin==0){
        return view('suppliers.index', ['suppliers' => $supplier,'products' => $products]);
        }
        else{
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
        
        $suppliers = new Supplier();
                 $suppliers->supplier_name = $request->supplier_name;
                 $suppliers->address = $request->address;
                 $suppliers->phone = $request->phone;
                 $suppliers->email = $request->email;
                 $suppliers->brand = $request->brand;

                 $suppliers->save();
        
        if ($suppliers) {
           return redirect()->back()->with('Supplier Created Successfully');
        }
           return redirect()->back()->with('Failed to Create Supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $suppliers = Supplier::find($id);
        if (!$suppliers) {
            return back()->with('Error', 'Supplier not Found');
        }
        $suppliers->update($request->all());
        return back()->with('Success', 'Supplier Updated Successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suppliers = Supplier::find($id);
        if (!$suppliers) {
            return back()->with('Error', 'Supplier not Found');
        }
        $suppliers->delete();
        return back()->with('Success', 'Supplier Deleted Successfully!');
    }
}
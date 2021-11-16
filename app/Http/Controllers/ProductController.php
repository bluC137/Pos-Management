<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Picqer; 
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::where('status','ACTIVE')->get();
        
        $suppliers = Supplier::all();

        if($user->is_admin==1){
            return view('products.index', ['products' => $products,'suppliers' => $suppliers]);
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
     //return $request->all(); 
    //product code section

    $product_code = $request->product_code ;

    $products = new Product;

    // Image Section
    if ($request->hasFile('product_image')) {
        $file = $request -> file ('product_image');
        $file->move(public_path(). '/product/image', $file->getCLientOriginalName());
        $product_image = $file -> getClientOriginalName();
        $products -> product_image = $product_image;
    }
    //Barcode Section
      
      $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
      file_put_contents('product/barcode/'.$product_code . '.jpg',
      $generator->getBarcode( $product_code,
      $generator::TYPE_CODE_128, 3, 50));


      //Product::create($request->all());
      
      $products -> product_name = $request->product_name;
      $products -> product_code = $product_code;
      $products -> supplier_id = $request->supplier_name;
      $products -> quantity = $request->quantity;
      $products -> price = $request->price;
      $products -> brand = $request->brand;
      $products -> alert_stock = $request->alert_stock;
      $products -> description = $request->description;
      $products -> barcode= $product_code . '.jpg';
      $products -> save();

      return redirect()->back()->with('Success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $product_code = $request->product_code ;
        $suppliers = Supplier::all();


       $products = Product::find($data['product-id']); 
       

       

        // Image Section
        if ($request->hasFile('product_image')) {

            if ($products->product_image != '') {
                $proImage_path = public_path(). '/product/image/' .$products->product_image;
                unlink($proImage_path);
            }
            
            $file = $request -> file ('product_image');
            $file->move(public_path(). '/product/image', $file->getCLientOriginalName());
            $product_image = $file -> getClientOriginalName();
            $products -> product_image = $product_image;
        }


        //Barcode Section
          if ($request->product_code != ''
           && $request->product_code != $products->product_code) {

            $unique = Product::where('product_code', $product_code) -> first();
            if ($unique) {
                return redirect()->back()->with('Error', 'Product code already exist!');
            }
               
               if ($products->barcode != '') {
                   $barcode_path = public_path(). '/product/barcode/' .$products->barcode;
                   unlink($barcode_path);
               }

             $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
             file_put_contents('product/barcode/'.$product_code . '.jpg',
             $generator->getBarcode( $product_code,
             $generator::TYPE_CODE_128, 3, 50));

             $products -> barcode = $product_code . '.jpg';
             
           }
          
                $products -> product_name = $request->product_name;
                $products -> product_code = $product_code;
                $products -> quantity = $request->quantity;
                $products -> price = $request->price;
                $products -> brand= $request->brand;
                $products -> alert_stock= $request->alert_stock;
                $products -> description= $request->description;
                $products -> save();
    //   $products->update($request->all());

        return redirect()->back()->with('Success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();

        $product = Product::find($data['product-ids']);
        $product->status = 'INACTIVE';
        $product->save();
        return redirect()->back()->with('Success', 'Product Deleted Successfully');
    }
    public function retrieve(Request $request)
    {
        $data = $request->all();

        $product = Product::find($data['product-idss']);
        $product->status = 'ACTIVE';
        $product->save();
        return redirect()->back()->with('Success', 'Product Retrieve Successfully');
    }
    public function GetProductBarcodes()
    {
        $productsBarcode = Product::select ('barcode', 'product_code')->get();
        $products = Product::where('status','ACTIVE')->get();
        
       
        return view ('products.barcode.index', compact('productsBarcode'),['products' => $products]);
    }
}

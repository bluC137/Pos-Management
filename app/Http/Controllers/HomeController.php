<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Cart;
use App\Order_Detail;
use App\Order;

use App\Returned;
use Carbon\Carbon;
// use App\Http\Controllers\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use PDF;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $transactions = Transaction::all();
        $selectQuery = Order_Detail::select('product_id')->groupBy('product_id')->get();
        $product_datas = array();
        foreach($selectQuery as $product){
            array_push($product_datas,$product->product_id);
        }
        $unsolds = Product::whereNotIn('id',$product_datas)->get();
    

        if($user->is_admin==1){
        return view('home', ['transactions' => $transactions,'products' => $products,'unsolds'=>$unsolds]);
        }
        elseif($user->is_admin==0){
        return view('home', ['transactions' => $transactions,'products' => $products,'unsolds'=>$unsolds]);
        }
        else{
        return redirect(route('cashier-content'));
        }
        
    }
    public function print_sales_report(Request $request){
        $user = Auth::user();
        $data = $request->all();
       
        $selectQuery = Transaction::with('order_detail')->whereBetween('transac_date',[$data['Startdate'],$data['Enddate']])->get();
        // return $selectQuery;
        $title = date('F d,Y',strtotime($data['Startdate'])).' TO '.date('F d,Y',strtotime($data['Enddate']));
        $pdf = PDF::loadView('print_sales', array('selectQuery'=>$selectQuery,'title'=>$title));
        return $pdf->stream();
    }
    public function print_product_sales(Request $request){
        $user = Auth::user();
        $data = $request->all();
       
        $selectQuery = Order_Detail::with('product_data')->whereBetween('created_at',[$data['Startdate'],$data['Enddate']])->groupBy('product_id')->get();
    //    return $selectQuery;
        $title = date('F d,Y',strtotime($data['Startdate'])).' TO '.date('F d,Y',strtotime($data['Enddate']));
        $pdf = PDF::loadView('print_product_sales', array('selectQuery'=>$selectQuery,'title'=>$title,'data'=>$data));
        return $pdf->stream();
    }
    public function find()
    {
        // $titles = DB::table('users')->pluck('title');

        // foreach ($titles as $title) {
        //     echo $title;
        // }
     
    }
    public function showFunctions(Request $request,$postMode){
        $data = $request->all();
        $user = Auth::user();
        if($request->ajax()){
            if($postMode=='submit-date'){
                if($data['type']=='DATE'){
                    if($data['start']==''){
                        $selectQuery = Transaction::select(DB::raw('SUM(paid_amount) as total_paid'),'transac_date')->whereMonth('transac_date',date('m'))->whereYear('transac_date',date('Y'))->groupBy('transac_date')->get();
                    }else{
                        $selectQuery = Transaction::select(DB::raw('SUM(paid_amount) as total_paid'),'transac_date')->whereBetween('transac_date',[$data['start'],$data['end']])->groupBy('transac_date')->get();
                    }
                    $array_merge = array();
                    foreach($selectQuery as $records){
                        array_push($array_merge,array('label'=>date('F d,Y',strtotime($records->transac_date)),'y'=>floatval($records->total_paid)));
                    }
                    $title = '<b class="text-danger">'.date('F d,Y',strtotime($data['start'])).' to '.date('F d,Y',strtotime($data['end'])).'</b>';
                    return array('records'=>$array_merge,'title'=>$title);
                }elseif($data['type']=='MONTH'){
                    if($data['start']==''){
                        $selectQuery = Transaction::select(DB::raw('SUM(paid_amount) as total_paid'),'transac_date')->whereMonth('transac_date',date('m'))->whereYear('transac_date',date('Y'))->groupBy('transac_date')->get();
                    }else{
                        $selectQuery = Transaction::select(DB::raw('SUM(paid_amount) as total_paid'),'transac_date',DB::raw('MONTH(transac_date) as month_data'),DB::raw('YEAR(transac_date) as year_data') )->whereBetween('transac_date',[$data['start'],$data['end']])->groupBy('month_data')->get();
                    }
                    $months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
                    $array_merge = array();
                    foreach($selectQuery as $records){
                        array_push($array_merge,array('label'=>$months[$records->month_data].' '.$records->year_data,'y'=>floatval($records->total_paid)));
                    }
                    $title = '<b class="text-danger">'.date('F d,Y',strtotime($data['start'])).' to '.date('F d,Y',strtotime($data['end'])).'</b>';
                    return array('records'=>$array_merge,'title'=>$title);
                }else{
                    if($data['start']==''){
                        $selectQuery = Transaction::select(DB::raw('SUM(paid_amount) as total_paid'),'transac_date')->whereMonth('transac_date',date('m'))->whereYear('transac_date',date('Y'))->groupBy('transac_date')->get();
                    }else{
                        $selectQuery = Transaction::select(DB::raw('SUM(paid_amount) as total_paid'),'transac_date',DB::raw('YEAR(transac_date) as year_data') )->whereBetween('transac_date',[$data['start'],$data['end']])->groupBy('year_data')->get();
                    }
                    $months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
                    $array_merge = array();
                    foreach($selectQuery as $records){
                        array_push($array_merge,array('label'=>$records->year_data,'y'=>floatval($records->total_paid)));
                    }
                    $title = '<b class="text-danger">'.date('F d,Y',strtotime($data['start'])).' to '.date('F d,Y',strtotime($data['end'])).'</b>';
                    return array('records'=>$array_merge,'title'=>$title);
                }
            }elseif($postMode=='submit-product'){
                if($data['start']==''){
                    $selectQuery = Order_Detail::select(DB::raw('SUM(quantity) as qty'),'product_id','created_at')->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->groupBy('product_id')->get();
                }else{
                    $selectQuery = Order_Detail::select(DB::raw('SUM(quantity) as qty'),'product_id',DB::raw('DATE(created_at) as date_created'))->whereBetween('created_at',[$data['start'],$data['end']])->groupBy('product_id')->get();
                    
                }
                $array_merge = array();
                foreach($selectQuery as $records){
                    array_push($array_merge,array('label'=>$this->productData($records->product_id),'y'=>intval($records->qty)));
                }
                $title = '<b class="text-danger">'.date('F d,Y',strtotime($data['start'])).' to '.date('F d,Y',strtotime($data['end'])).'</b>';
               
                return array('records'=>$array_merge,'title'=>$title);
            }elseif($postMode=='add-cart'){
                $countProduct = Product::where('status','ACTIVE')->where('id', $data['id'])->first();
                if(!$countProduct){
                    return session()->flash('error', 'Product Not Found');
                }else{
                    $countCartProduct = Cart::where('product_id', $data['id'])->count();
                    if($countCartProduct >  0){
                        return session()->flash('info', 'Product ' .$countProduct->product_name .' already exists in cart. Please add quantity. ');
                    }else{
                        $add_to_cart = new Cart();
                        $add_to_cart->product_id = $countProduct->id;
                        $add_to_cart->product_qty = 1;
                        $add_to_cart->product_price = $countProduct->price;
                        $add_to_cart->user_id = $user->id;
                        if($add_to_cart->save()){
                            return session()->flash('success', "Product Added Successfully");
                        }
                    }
                }
           
            }elseif($postMode=='search-product'){
                $products = Product::where('status','ACTIVE')->where('product_name', 'like', '%' . $data['search'] . '%')->get();
                $returnHtml = '';
                $count = 0;
                foreach ($products as $product){
                    $count++;
                    $returnHtml .= '
                    <tr>
            <td hidden="true">'.$count.'</td>
            <td>'.$count.'</td>
            <td style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Click to view" wire:click="ProductDetails ('.$product->id.')">
                '. $product->product_name .'
            </td>

            <td>'. $product->brand .'</td>
            <td>'. number_format($product->price,2) .'</td>
            <td>'. $product->quantity .'</td>
            <td> ';
            if ($product->alert_stock >= $product->quantity ){
                $returnHtml .= '<span class="badge badge-danger">Low Stock < '.$product->alert_stock.'</span>';
            }else{
                $returnHtml .= '<span class="badge badge-success">'.$product->alert_stock.'</span>';
            }
            $returnHtml .= '</td>

            <td>
                <div class="btn-group">
                <a class="btn btn-info btn-sm update" data-id="'.$product->id.'"> <i class=" fa fa-edit">
                </i> Edit</a>
            <a class="btn btn-sm btn-danger delete" data-id="'.$product->id.'"><i class=" fa fa-trash">
                </i> Delete</a>
                </div>
            </td>
        </tr>
                    ';
                }
               
                return $returnHtml;
            }elseif($postMode=='select-product'){
                $selectQuery = Product::find($data['id']);
                return $selectQuery;
            }elseif($postMode=='count-for-approval'){
                $count = Cart::where('temp_discount','>',0)->where('discount_status',0)->count();
                return $count;
            }elseif($postMode=='save-cart'){
                $update = Cart::find($data['id']);
                $update->product_price = $data['price'];
                // $update->discount = $data['total_discount'];
                $update->temp_discount = $data['total_discount'];
                $update->discount_percentage = $data['discount_percetage'];
                $update->discount_status = 0;
                $update->save();
            }elseif($postMode=='approved-discount'){
                $update = Cart::find($data['id']);
                $update->discount = $update->temp_discount;
                $update->discount_status = 1;
                $update->temp_discount = null;
                $update->save();
            }elseif($postMode=='decline-discount'){
                $update = Cart::find($data['id']);
                $update->discount = null;
                $update->discount_status = 2;
                $update->discount_percentage = null;
                $update->temp_discount = null;
                $update->save();
            }elseif($postMode=='product-details'){
                $products = Order_Detail::with('product_data')->where('order_id',$data['order_id'])->get();
                $product_detail = '';
                $count = 0;
                
                foreach($products as $product){
                    if($product->quantity!=0){
                    $count++;
                    $total = floatval($product->unitprice)*floatval($product->quantity)-floatval($product->discount);
                   
                    $product_detail .= '
                    <tr>
                        <td>'.$product->product_data->product_name.'</td>
                        <td>
                        <input type="text" maxlength="5" onkeypress="return isNumberKey(event)" 
                            value="'.$product->quantity.'" 
                            name="product-qty[]" 
                            id="qty'.$product->id.'" 
                            data-id="'.$product->id.'" 
                            class="form-control" >
                        </td>
                        <td>
                        <input type="text" maxlength="100" readonly onkeypress="return isNumberKey(event)" 
                            value="'.$product->unitprice.'" 
                            name="product-price[]" 
                            id="price'.$product->id.'" 
                            data-id="'.$product->id.'" 
                            class="form-control" >
                        </td>
                        <td>
                        <input type="text" maxlength="100" onkeypress="return isNumberKey(event)" 
                            value="'.$product->discount.'" 
                            name="product-discount[]" 
                            id="discount'.$product->id.'" 
                            data-id="'.$product->id.'" 
                            class="form-control" >
                        </td>
                        <td>
                        <input type="text" maxlength="100" readonly onkeypress="return isNumberKey(event)" 
                                value="'.$total.'" 
                                name="product-total[]" 
                                id="total'.$product->id.'" 
                                data-id="'.$product->id.'" 
                                class="form-control" >
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm delete" data-id="'.$product->id.'" data-product="'.$product->product_data->product_name.' ('.$product->quantity.'pcs.)"><span class="fa fa-times"></span></a>
                        </td>
                    </tr>
                    ';
                    }else{
                        $product_detail .= '
                        <tr class="btn-danger text-white">
                            <td> '.$product->product_data->product_name.'</td>
                            <td colspan="5"><b>Return reason :</b> '.$product->reason.'</td>
                        </tr>
                        ';
                    }
                }
                $returnHtml = '
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>QTY</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$product_detail.'
                    </tbody>
                </table>
                
                ';
                return $returnHtml;
            }else{
                return array('success' => 0, 'message' => 'Undefined Method');
            }
        }else{
            if($postMode=='return-product'){
                $update = Order_Detail::find($data['transaction-id']);
                $quatity = $update->quantity;
                $update->reason = $data['reason'];
                $update->quantity = 0;
                if($update->save()){
                     $date = Carbon::now();
                     $returnProduct = new Returned;
                     $returnProduct->product_name = $this->productData($update->product_id);
                     $returnProduct->quantity = $quatity;
                     $returnProduct->reason = $update->reason = $data['reason'];
                     $returnProduct->date = $date;
                     $returnProduct->save();
                }
                return back();
            }else{
                Session::flash('success', 0);
                Session::flash('message', 'Undefined method please try again');
                return back();
            }
            
        }
    }
    public function productData($id){
        $selectQuery = Product::find($id);
        return $selectQuery->product_name;
    }
}

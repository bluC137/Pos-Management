<div class="col-lg-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: #1f2833; color: #edf6ff">
                    <h4 style="float: left"> Cashier</h4>
                    <!-- <a href="http://" style="float:right; background-color: white; color:black; outline-color: #66fcf1; outline-width: 100px" class="btn btn-info" data-toggle="modal" data-target="#addproduct">
                        <i class="fa fa-plus"></i> Add New Products</a> -->
                </div>

                <!-- <form action=" {{ route('orders.store')}}" method="post">
                        @csrf -->
                <div class="card-body">
                    <div class="my-2">
                        <!-- <form wire:submit.prevent="InsertoCart">
                            <input type="text" name="" wire:model="product_code" id="" class="form-control" placeholder="Enter Product Code:">
                        </form> -->
                        <select class="form-control" id="product_datasss">
                            <option value=""></option>
                            @foreach($products as $product)
                            @if($product->status=='ACTIVE')
                            <option value="{{$product->id}}" >{{$product->product_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @if (session()->has('success')) 
                    <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
                    @elseif (session()->has('info'))
                    <div class="alert alert-info">
                        {{ session('info')}}
                    </div>
                    @elseif (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
                    @endif

                    <table class="table table-bordered table-left">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Discount (%)</th>
                                <th colspan="6">Total</th>
                                <!-- <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle"><i class="fa fa-plus"></i> </a></th> -->
                            </tr>
                        </thead>
                        <tbody class="addMoreProduct">
                            @php 
                            $total_grand = 0;
                            @endphp
                            @foreach ($productIncart as $key=> $cart)

                            <tr>
                                <td class="no">{{ $key + 1 }}</td>
                                <td width="30%">
                                    <input type="text" class="form-control" readonly value="{{ $cart->product->product_name }}"></input>
                                </td>
                                <td width="15%" align="center">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <button wire:click.prevent="IncrementQty({{ $cart->id}})" class="btn btn-sm btn-success"> + </button>
                                        </div>
                                        <div class="col-md-1 " align="center">
                                            <label for="" class="quantity text-align-center" id="qty{{$cart->id}}">{{ $cart->product_qty }}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <button wire:click.prevent="DecrementQty({{ $cart->id}})" class="btn btn-sm btn-danger"> - </button>
                                        </div>
                                    </div>
                                    <!-- <input type="number" name="quantity[]" id="quantity"
                                        class="form-control quantity" value="{{ $cart->product_qty }}"> -->
                                </td>
                                <td>
                                    <input type="number"  class="form-control" readonly name="price_data[]" id="price{{$cart->id}}" data-id="{{$cart->id}}" value="{{ $cart->product_price }}">
                                </td>
                                <td>
                                    <input type="text" maxlength="2" onkeypress="return isNumberKey(event)" value="{{$cart->discount_percentage*100}}" name="discount-data[]" id="discount{{$cart->id}}" data-id="{{$cart->id}}" class="form-control" >
                                </td>
                                <td>
                                    <input type="text" onkeypress="return isNumberKey(event)" 
                                    value="{{ floatval($cart->product_qty) * floatval($cart->product_price) - floatval($cart->discount) }}" readonly id="total{{$cart->id}}" class="form-control total_amount">
                                </td>

                                <td><a href="#" > <button type="button" class="btn btn-danger servideletebtn" wire:click="removeProduct({{$cart->id}})">Delete</button> </a></td>
                            </tr>
                            @php    
                            $grand_to = floatval($cart->product_qty) * floatval($cart->product_price) - floatval($cart->discount);
                            $total_grand = $total_grand+$grand_to;
                            @endphp
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
            <div class="card-header" style="background: #1f2833; color: #edf6ff">
                   <center> <h4>Items:  <b class="items">{{ $productIncart->sum('product_qty') }}</b></h4></center></div><br>
                <div class="card-header" style="background: #1f2833; color: #edf6ff">
                   <center> <h4>Total:  <b class="total" id="grand-total">{{ $total_grand }}</b></h4></center></div>

                <form action="{{ route('orders.store')}}" method="POST">
                    @csrf
                    @foreach ($productIncart as $key=> $cart)
                    <input type="hidden" class="form-control" name="product_id[]" value="{{ $cart->product->id }}"></input>
                    <input type="hidden" name="quantity[]" class="form-control quantity" value="{{ $cart->product_qty }}">
                    <input type="hidden" name="price[]" class="form-control price" value="{{ $cart->product_price }}">
                    <input type="hidden" name="discount[]" class="form-control discount" value="{{$cart->discount}}">
                    <input type="hidden" name="total_amount[]" value="{{$cart->product_qty * $cart->product_price - floatval($cart->discount) }}" class="form-control total_amount">
                    @endforeach
                    <div class="card-body">
                        <div class="btn-group">
                          <center> <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i class="fa fa-print "> Print</i></button> </center>
<!--
                            <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-primary"><i class="fa fa-print "> History</i></button>

                            <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-danger"><i class="fa fa-print "> Report</i></button> -->
                        </div>

                        <div class="panel">
                            <div class="row">
                                <table class="table table-stripe">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="Customer Name">Customer Name</label>
                                                <input type="text" name="customer_name" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Customer Phone</label>
                                                <input type="number" name="customer_phone" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <td> Payment Method <br>
                                    <div>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="cash" checked="checked">
                                            <label for="payment_method"><i class="fa fa-money-bill text-success"></i>Cash</label>
                                        </span>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="bank transfer">
                                            <label for="payment_method"><i class="fa fa-university text-danger"></i>Bank Transfer</label>
                                        </span>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="credit card">
                                            <label for="payment_method"><i class="fa fa-credit-card text-info"></i>Credit Card</label>
                                        </span>
                                    </div>
                                </td>-->


                                <td>
                                    Payment <input type="number" wire:model="pay_money" name="paid_amount" id="paid_amount" class="form-control">
                                </td><br>
                                <td>
                                    Returning Change <input type="number" readonly name="balance" id="balance" class="form-control">
                                </td>
                                <td>
                                    <button style = "background-color: #1f2833" class="btn-primary btn-lg btn-block mt-3">Save</button>
                                </td>
                                <!-- <td>
                                    <button class="btn-danger btn-lg btn-block mt-2">Calculator</button>
                                </td> -->
                                <br>

                                <div class="text-center" style="text-align: center !important">
                                    <a href="{{ url('/') }}" class="text-danger text-center"><i class="fa fa-sign-out-alt"></i> </a>
                                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</form>
</div>
</div>
</div>

<!-- Modal section adding new product -->
<!-- Modal -->
<div class="modal middle fade"  id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff" >

                <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Product Code</label>
                        <input type="text" name="product_code" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description </label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Image </label>
                        <input type="file" name="product_image" id="" cols="30" rows="2" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-block">Save Product</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
</div>

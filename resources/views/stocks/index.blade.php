@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4 style="float: left"> Stock Management</h4>
                        <a href="http://"  style="float:right; background-color: white; color:black; outline-color: #66fcf1; outline-width: 100px" class="btn btn-info" data-toggle="modal" data-target="#addStock">
                            <i class="fa fa-plus"></i> Add New Stock</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                
                                <tr>
                                    <th>#</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Supplier</th>
                                    <th>Receiver </th>
                                    <th>Remarks</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($stocks as $key => $stock)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $stock->product_id }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->supplier }}</td>
                                    <td>

                                    {{$stock->receiver}}
                                   
                                    </td>
                                    <td>{{ $stock->remarks }}</td>
                                    <td>{{ $stock->created_at }}</td>
                                    <td>{{ $stock->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editStock{{ $stock->id }}"> <i class=" fa fa-edit">
                                                </i> Edit</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal section Editing supplier details -->
                                <!-- Modal -->
                                <div class="modal right fade" id="editStock{{ $stock->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Supplier</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('stocks.update', $stock->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="">Product Name</label>
                                                        <select name="product_id" id="" class="form-control">
                                                        @foreach ( $products as $key => $product)
                                                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Qty</label>
                                                        <input type="number" name="quantity" id="" value="{{ $stock->quantity }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Supplier</label>
                                                        <select name="supplier_name" id="" class="form-control">
                                                        @foreach ( $suppliers as $key => $supplier)
                                                            <option value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <textarea name="remarks" id="" cols="30" rows="2" value="{{ $stock->remarks }}" class="form-control">{{ $stock->remarks }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Receiver</label>
                                                        <input type="text" name="user_id" id="" readonly value="{{ auth()->user()->name }}" class="form-control">
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info btn-block">Save Stock</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal section adding new stockin -->
<!-- Modal -->
<div class="modal right fade" id="addStock" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Add Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('stocks.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <select name="product_id" id="" class="form-control">
                        @foreach ( $products as $key => $product)
                            <option class="form-control" value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach 
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Based Price</label>
                        <input type="number" name="based_price" id="" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Selling Price</label>
                        <input type="number" name="price" id="" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Supplier</label>
                        <select name="supplier_name" id="" class="form-control">
                        @foreach ( $suppliers as $key => $supplier)
                            <option class="form-control" value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <textarea name="remarks" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info btn-block">Save Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<style>
    
</style>


@endsection
<div class="form-group">
    <input class="form-control" name="search-product" placeholder="Search here..."/>
</div>

<table class="table table-bordered table-left" id="productTbl" >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Based Price</th>
            <th>Selling Price</th>
            <th>Qty</th>
            <th>Alert Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="product-content">
        @foreach ($products as $key => $product)

        <tr
        @if($product->status=='INACTIVE')
            class="bg-danger"
        @endif
        >
            <td hidden="true">{{ $key+1 }}</td>
            <td>{{ $key+1 }}</td>
            <td style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Click to view" wire:click="ProductDetails ({{ $product->id }})">
                {{ $product->product_name }}
            </td>

            <td>{{ $product->brand }}</td>
            <td>{{ number_format($product->based_price,2) }}</td>
            <td>{{ number_format($product->price,2) }}</td>
            <td>{{ $product->quantity }}</td>
            <td> @if ($product->alert_stock >= $product->quantity )
                <span class="badge badge-danger">Low Stock < {{$product->alert_stock}}</span>
                        @else
                        <span class="badge badge-success">{{$product->alert_stock}}</span>
                        @endif
            </td>

            <td>
                <div class="btn-group">
                    <a class="btn btn-info btn-sm update" data-id="{{$product->id}}"> <i class=" fa fa-edit">
                        </i> Edit</a>
                        @if($product->status=='ACTIVE')

                            @if ($product->quantity > 0)
                            <button class="btn btn-sm btn-danger" type="button" class="btn btn-primary" data-toggle="modal" data-target="#remind">
                            <i class=" fa fa-trash">
                            </i> Delete</a>
                            </button>
                            @else
                            <a class="btn btn-sm btn-danger delete"  data-id="{{$product->id}}" data-product="{{$product->product_name}}"><i class=" fa fa-trash">
                            </i> Delete</a>
                            @endif
                            
                           

                        @else 
                        <a class="btn btn-sm btn-warning retrieve" data-id="{{$product->id}}" data-product="{{$product->product_name}}"><i class=" fa fa-undo">
                        </i> Retrieve</a>

                        @endif

                </div>
            </td>
        </tr>
       
        @endforeach
      
    </tbody>

</table>

{{ $products->links() }}

<div class="modal right fade" id="editproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{ route('product-update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
               
                    @csrf
                    <input type="hidden" name="product-id"/>
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="a" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Product Code</label>
                        <input type="text" name="product_code" id="b" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="c" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Based Price</label>
                        <input type="number" name="based_price" id="j" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Selling Price</label>
                        <input type="number" name="price" id="d" class="form-control">
                    </div>

                    <div class="form-group" >
                    <label for="">Quantity</label>
                        <input type="number" name="quantity" readonly id="e" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="f" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Description </label>
                        <textarea name="description" id="g" cols="30" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Image </label>
                        <img width="40" id="i" >
                        <input type="file" name="product_image" id="h" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-block">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete modal -->
<div class="modal right fade" id="deleteproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Delete product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{ route('product-desctroy') }}" id="form-delete" method="post">
                    @csrf 
                    <input type="hidden" name="product-ids"/>
                    <p>Are you sure you want to delete <span id="product-name"></span>?</p>

                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" form="form-delete" class="btn btn-danger">Delete</button>
                    </div>
              
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete modal but 0 quantity-->
<div class="modal fade" id="remind" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" >Cannot delete product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-remind" >
                    <p> This product is not yet sold out </p>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>	

<div class="modal right fade" id="retrieveproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Retrieve product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{ route('product-retrieve') }}" id="form-retrieve" method="post">
                    @csrf 
                    <input type="hidden" name="product-idss"/>
                    <p>Are you sure you want to retrieve <span id="product-names"></span> ?</p>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" form="form-retrieve" class="btn btn-warning">Retrieve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

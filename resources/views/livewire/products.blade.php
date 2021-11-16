<div>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4 style="float: left"> Products</h4>
                        <a href="http://" style="float:right; background-color: white; color:black; outline-color: #66fcf1; outline-width: 100px" class="btn btn-info" data-toggle="modal" data-target="#addproduct">
                            <i class="fa fa-plus"></i> Add New Products</a>

                    </div>
                    
                    <div class="card-body" >
                        @include('products.table')

                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4>Product Details</h4>
                        
                    </div>
                    <div class="card-body">
                        @include('products.product_detail')
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>{{--{{ $products, $suppliers }}--}}
</div>


@extends('layouts.app')

@section('content')


@livewire('products')

<!-- Modal section adding new product -->

<!-- Modal -->
<div class="modal right fade"  id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff" >

                <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                        <label for="">Supplier</label>
                        <select name="supplier_name" id="" class="form-control">
                        @foreach ( $suppliers as $key => $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Based Price</label>
                        <input type="number" name="based_price" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Selling Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>
                    <div class="form-group" >
                        
                        <input type="hidden" name="quantity" value="0" id="" class="form-control">
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
@endsection
@section('script')
<script>
    $(document).ready(function() {
         $(document).on('change','input[name="search-product"]',function(){
            var search = $(this).val();
            $('#product-content').html('<tr><td colspan="7">Loading....</td></tr>');
            $.post("{{route('home-functions',['id' => 'search-product'])}}",{"_token": "{{ csrf_token() }}",search:search},function(data){
                 $('#product-content').html(data);
            });
         });
         $(document).on('click','.update',function(){
             var id = $(this).data('id');
             $('input[name="product-id"]').val(id);
            $.post("{{route('home-functions',['id' => 'select-product'])}}",{"_token": "{{ csrf_token() }}",id:id},function(data){
                $('#a').val(data.product_name);
                $('#b').val(data.product_code); 
                $('#c').val(data.brand);
                $('#d').val(data.price);
                $('#e').val(data.quantity);
                $('#f').val(data.alert_stock);
                $('#g').val(data.description);
                $('#j').val(data.based_price);
                $('#i').prop('src',"{{ asset('product/image/')}}"+data.product_image);
            });
            $('#editproduct').modal('show');
         });
         $(document).on('click','.delete',function(){
             var id = $(this).data('id');
             var product = $(this).data('product');
             $('input[name="product-ids"]').val(id);
             $('#product-name').text(product);
             
            $('#deleteproduct').modal('show');
         });
         $(document).on('click','.retrieve',function(){
             var id = $(this).data('id');
             var product = $(this).data('product');
             $('input[name="product-idss"]').val(id);
             $('#product-names').text(product);
             
            $('#retrieveproduct').modal('show');
         });
    });
</script>
@endsection
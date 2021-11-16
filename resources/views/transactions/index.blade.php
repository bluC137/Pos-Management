@extends('layouts.app')

@section('content')

@livewire('transactions')

   
<style>
    .modal.right .modal-dialog {

        top: 0;
        right: 0;
        margin-right: 20vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
</style>


@endsection

@section('script')
<script>
    $(document).on('click','.update',function(){
        var id = $(this).data('id');
        var order_id = $(this).data('order_id');
        $.post("{{route('home-functions',['id' => 'product-details'])}}",{"_token": "{{ csrf_token() }}",id:id,order_id:order_id},function(data){
            $('#product-content').html(data);
        });
        $('#updateTransaction').modal('show');
    });
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
        var product = $(this).data('product');
        $('#product-name').text(product);
        $('input[name="transaction-id"]').val(id);
        $('#updateTransaction').modal('toggle');
        $('#reasonDeleted').modal('show');
    });
    $(document).on('change','input[name="search-transaction"]',function(){
            var search = $(this).val();
            $('#transaction-content').html('<tr><td colspan="8">Loading....</td></tr>');
            $.post("{{route('home-functions',['id' => 'search-transaction'])}}",{"_token": "{{ csrf_token() }}",search:search},function(data){
                 $('#transaction-content').html(data);
            });
         });
    function isNumberKey(evt){
            var e = evt || window.event; // for trans-browser compatibility
            var charCode = e.which || e.keyCode;
            if (charCode > 31 && (charCode < 46 || charCode > 57))
            return false;
            if (e.shiftKey) return false;
            return true;  
        }
</script>
@endsection
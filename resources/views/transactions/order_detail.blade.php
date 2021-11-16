<div class="row">
    
    @forelse ($order_details as $order_detail)


    <div class="col-md-12">
        <div class="form-group">
            
            <input type="text" class="form-control" value="{{ $order_detail->product_id }}" readonly>
        </div>
    </div>

    
    @empty
    @endforelse



<style>
    input:read-only {
        background: #fff !important;

    }

    textarea:read-only {
        background: #fff !important;

    }
</style>
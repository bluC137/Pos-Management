<div class="row">
    @forelse ($transaction_details as $order_detail)


    <div class="col-md-12">
        <div class="form-group">
            <label for=""> Customer Name </label>
            <input type="text" class="form-control" value="{{ $order_detail->name }}" readonly>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""> Customer Phone </label>
            <input type="text" class="form-control" value="{{ $order_detail->phone }}" readonly>
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
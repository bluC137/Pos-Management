<div class="row">
    @forelse ($products_details as $product)

    <div class="col-md-12">
        <div><center>
        <img data-toggle="modal" data-target="#productPreview{{ $product->id }}" src="{{ asset('product/image/' .$product->product_image) }}" width="100" height="100" style=" cursor: pointer;" alt="">
    <center></div>
        <div class="form-group">
            <label for=""> Product ID </label>
            <input type="text" class="form-control" value="{{ $product->id }}" readonly>

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""> Product Name </label>
            <input type="text" class="form-control" value="{{ $product->product_name }}" readonly>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""> Product Code </label>
            <input type="text" class="form-control" value="{{ $product->product_code }}" readonly>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""> Product Desc </label>
            <textarea class="form-control" readonly cols="10" rows="2">{{ $product->description }}</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group" style="text-align: center !important; padding-left:8%">
            <span style="text-align: center;">
                <img src="{{ asset('product/barcode/' .$product->barcode) }}" width="70" style="cursor: pointer;" alt="">
            </span>
            <h5>{{ $product->product_code}}</h5>
        </div>
    </div>
    @include('products.product_preview')
    @empty
    @endforelse
</div>

<style>
    input:read-only {
        background: #fff !important;

    }

    textarea:read-only {
        background: #fff !important;

    }
</style>
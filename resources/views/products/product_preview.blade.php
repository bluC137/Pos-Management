<div class="modal right fade" id="productPreview{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">{{ $product->product_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="">
                    <img src="{{ asset('product/image/' .$product->product_image) }}" width="265" style="cursor: pointer;" alt="">
                </div>
                <img src="{{ asset('product/barcode/' .$product->barcode) }}" width="265" style="cursor: pointer;" alt="">
            </div>
        </div>
    </div>
</div>
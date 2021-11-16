<div class="modal right fade" id="edittransaction{{ $transaction->order_id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{ route('transactions.update', $transaction->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for=""></label>
                        <input type="text" name="product_name" id="" value="{{ $product->product_name }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" value="{{ $product->product_name }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" value="{{ $product->product_name }}" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-block">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
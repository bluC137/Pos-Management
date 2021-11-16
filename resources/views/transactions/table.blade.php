
<table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order By</th>
                                    <th>Transact By</th>
                                    <th>Transaction Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Balance</th>
                                    <th>Transaction Date</th>
                                    <th> Action </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $key => $transaction)
                                <tr>
                                    <td hidden="true">{{ $key+1 }}</td>
                                    <td style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Click to view" wire:click="TransactionDetails ({{ $transaction->order_id }})" >{{ $key+1 }} </td>
                                    <td style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Click to view" wire:click="OrderDetails ({{ $transaction->order_id }})" >{{ $transaction->order_detail->name }} </td>
                                    <td style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Click to view" wire:click="UserDetails ({{ $transaction->user_id }})">
                                    @if(isset($transaction->user_detail->name))
                                    {{ $transaction->user_detail->name }}
                                    @endif
                                </td>
                                    <td>{{ number_format($transaction->transac_amount,2) }}</td>
                                    <td>{{ number_format($transaction->paid_amount,2) }}</td>
                                    <td>{{ number_format($transaction->balance,2) }}</td>
                                    <td>{{ $transaction->transac_date }}</td> 
                                    <td>
                                    <a class="btn btn-info btn-sm update" data-order_id="{{$transaction->order_id}}" data-id="{{$transaction->id}}"> <i class=" fa fa-edit">
                                        </i> Update Transaction</a>
                                    </td>
                                    
                                 @endforeach 
                                </tr>
                        </table>
                        {{ $transactions->links() }}
<div class="modal fade" id="updateTransaction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Update Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div id="product-content"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reasonDeleted" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Reason Return </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{route('home-functions',['id' => 'return-product'])}}" method="post" enctype="multipart/form-data" autocomplete="off">
               @csrf
                <div class="form-group">
                    <b id="product-name"></b>
                </div>
                <input type="hidden" name="transaction-id"/>
                <textarea class="form-control" name="reason" rows="3" required></textarea>
                <div class="modal-footer">
                        <button class="btn btn-info btn-block">Return Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
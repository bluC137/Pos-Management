@extends('layouts.app')
@section('stylesheet')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="content">
    <div class="card ml-5 mr-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cashier</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Discount Requested</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendings as $index=>$pending)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$pending->cashier->name}}</td>
                            <td>{{$pending->product_data->product_name}}</td>
                            <td align="center">{{$pending->product_qty}}</td>
                            <td align="right">PHP {{number_format($pending->temp_discount,2)}}</td>
                            <td align="right">PHP {{number_format($pending->product_price,2)}}</td>
                            <td align="right">
                               @php 
                               
                               $total_price = floatval($pending->product_qty) * floatval($pending->product_price) - floatval($pending->temp_discount); @endphp
                            PHP {{number_format($total_price,2)}}
                            </td>
                            <td align="center">
                                <a class="btn btn-success approve" data-id="{{$pending->id}}"><span class="fa fa-check"></span> Approved</a>
                                <a class="btn btn-danger remove" data-id="{{$pending->id}}"><span class="fa fa-times"></span> Decline</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script>
     $('table').DataTable();
     $(document).ready(function(index){
        $(document).on('click','.approve',function(){
            var id = $(this).data('id');
            if (confirm('Are you sure you want to APPROVED this discount?')) {
                $.post("{{route('home-functions',['id' => 'approved-discount'])}}",{"_token": "{{ csrf_token() }}",id:id},function(data){
                location.reload();
            });
            }
        });
        $(document).on('click','.remove',function(){
            var id = $(this).data('id');
            if (confirm('Are you sure you want to DECLINE this discount?')) {
                $.post("{{route('home-functions',['id' => 'decline-discount'])}}",{"_token": "{{ csrf_token() }}",id:id},function(data){
                location.reload();
            });
            }
        });
     });
</script>
@endsection
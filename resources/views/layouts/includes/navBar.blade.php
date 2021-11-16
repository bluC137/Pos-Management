@php 

$user =Auth::user();
@endphp

@if($user->is_admin==1)
<a href="" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline rounded-pill"><i class="fa fa-list"></i></a>
<a href="{{ route('users.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-user"></i>Users</a>
<a href="{{ route('products.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-box"></i>Products</a>
<a href="{{ route('orders.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-laptop"></i>Cashier</a>
<a href="{{ route('stocks.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-boxes"></i>Stocks</a>
<a href="{{ route('transactions.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-money-bill"></i>Transactions</a>
<a href="{{ route('suppliers.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-truck"></i></i>Suppliers</a>
<!-- <a href="{{ route('orders.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-users"></i>Customers</a> -->
<a href="{{ route('products.barcode')}}" class="btn btn-outline rounded-pill"><i class="fa fa-barcode"></i>Barcode</a>
<a href="" data-toggle="modal" data-target="#test" class="btn btn-outline rounded-pill"><i class="fa fa-bell"></i></a>
@endif
<style>
    .btn-outline {
        border-color: #1f2833;
        color: #1f2833;
    }

    
    .btn-outline:hover {
        background: #c5c6c7;
        color: #edf6ff;
    }
</style>
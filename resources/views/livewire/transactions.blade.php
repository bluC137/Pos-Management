<div>
<div class="container-fluid">
    <div class="col-lg-16">
        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4 style="float: left"> Transactions </h4>
                        <a href="{{ route('orders.index')}}" style="float:right; background-color: white; color:black; outline-color: #66fcf1; outline-width: 100px" class="btn btn-info" > 
                            <i class="fa fa-plus"></i> Add New Transaction </a>
                    </div>
                
                    <div class="card-body" > 
                       @include('transactions.table')
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4>Returned Items</h4>
                    </div>
                    <div class="card-body">
                    
                        @include('transactions.returned')
                        
                    </div>
                    
                </div>
            </div>
            
          
           
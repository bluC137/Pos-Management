<div class="row">


<table class="table table-bordered"  >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Reason</th>
        </tr>
    </thead>
                      
    
    @foreach ($returns as $key => $return)
    <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $return->product_name }}</td>
    <td>{{ $return->quantity }}</td>
    <td>{{ $return->date }}</td>
    <td>{{ $return->reason }}</td>
    </tr>
    @endforeach
    </table>
   
</div>

<style>
    input:read-only {
        background: #fff !important;

    }

    textarea:read-only {
        background: #fff !important;

    }
</style>
<html>
    <title>Print Sales Report</title>
    <head>
        <style>
             @page {
                margin: 100px 25px;
             }
             #header {
                margin-top: -2.3cm;
                left: 0px;
                right: 0px;
                height: 50px;
                line-height: 35px;
                text-align: center;
            }
            #address {
                margin-top: -9cm;
                left: 0px;
                right: 0px;
                text-align: center;
            }
            .table-bordered {
                border: 1px solid #ddd;
                text-align: left;
            }
            .table {
                width: 100%;
                max-width: 100%;
                font-family: Arial, Helvetica, sans-serif;
            }
            .small, small {
                font-size: 80%;
            }
            #payments td, #payments th {
                border: 1px solid #ddd;
                font-size: 80%;
            }
            #payments {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
           
            .col-7 {
                float: left;
                width: 70%;
                padding: 10px;
                /* height: 300px;  */
                font-size: 80%;
            }
            .col-5 {
                float: left;
                width: 30%;
                padding: 10px;
                font-size: 80%;
            }
            .col-6 {
                float: left;
                width: 30%;
                padding: 10px;
                font-size: 80%;
            }
            .row:after {
                display: table;
                clear: both;
            }
            td{
                padding:5px;
            }
        </style>
    </head>
    <body>
        <div id="header">
           <h1>BOYONG'S ELECTRONIC STORE</h1>
       </div>
      <div id="address">
          <h3 style="margin:0px;padding:0px;">Sales Report</h3>
          @php echo $title; @endphp
         
      </div>
      
       <div id="body">
            <br>
                <table id="payments">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order Details</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $grand_total = 0;
                        @endphp
                      @foreach($selectQuery as $transaction)
                        @php 
                        $grand_total = $grand_total+floatval($transaction->transac_amount);
                        @endphp
                        <tr>
                            <td>{{date('F d,Y',strtotime($transaction->transac_date))}}</td>
                            <td>
                                @if($transaction->order_detail->name!='')
                                <b>Name: </b> {{$transaction->order_detail->name}} <hr>
                                <b>Contact Number: </b> {{$transaction->order_detail->phone}}
                                @endif
                            </td>
                            <td align="right">PHP {{number_format($transaction->transac_amount,2)}}</td>
                        </tr>
                      @endforeach
                        <tr>
                            <td colspan="2" align="right">Grand Total:</td>
                            <td align="right">PHP {{number_format($grand_total,2)}}</td>
                        </tr>
                    </tbody>
                </table>
            
            <div class="row">
                <div class="col-5">
                   
                </div>
            </div>
            
       </div>
    </body>
</html>
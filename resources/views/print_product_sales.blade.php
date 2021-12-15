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
          <h3 style="margin:0px;padding:0px;">Product Sales Report</h3>
          @php echo $title; @endphp
         
      </div>
      
       <div id="body">
       <br>
                <table id="payments">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Based Price</th>
                            <th>Total QTY Stock In</th>
                            <th>Total Cost</th>
                            <th>Total QTY Sold</th>
                            <th>Total Sold</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $grand_total = 0;
                        @endphp
                      @foreach($selectQuery as $sales)
                        @php 
                            $totalQtyStock = totalQty($sales->product_id,$data['Startdate'],$data['Enddate']);
                            $totalCostStock = intval($totalQtyStock)*floatval($sales->product_data->based_price);
                            $totalQtySold = totalQtySold($sales->product_id,$data['Startdate'],$data['Enddate']);
                            $totalSalesSold = intval($totalQtySold)*floatval($sales->product_data->price);

                            $gt = floatval($totalSalesSold)-floatval($totalCostStock);
                        @endphp
                        <tr>
                            <td>{{date('F d,Y',strtotime($sales->created_at))}}</td>
                            <td>{{$sales->product_data->product_name}}</td>
                            <td align="right">PHP {{number_format($sales->product_data->based_price,2)}}</td>
                            <td align="center">{{$totalQtyStock}}</td>
                            <td align="right">PHP {{number_format($totalCostStock,2)}}</td>
                            <td align="center">{{$totalQtySold}}</td>
                            <td align="right">PHP {{number_format($totalSalesSold,2)}}</td>
                            <td align="right">PHP {{number_format($gt,2)}}</td>
                        </tr>
                      @endforeach
                       
                    </tbody>
                </table>
            
            <div class="row">
                <div class="col-5">
                   
                </div>
            </div>
            
       </div>
    </body>
</html>
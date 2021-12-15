@extends('layouts.app')

@section('content')

<div class="container-fluid">
    
    <div class="row ">
    
       
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header" style="background: #1f2833; color: #edf6ff">
                    <marquee behavior="" direction="">Welcome to Boyong's Electronics Store</marquee>
                </h4>
                <div class="row p-3">
                <div class="col-md-12"   align="right">
                    <br>
                    <button class="btn btn-info text-white" data-toggle="modal" data-target="#sales-report"> <span class="fas fa-file-invoice-dollar text-white"></span> Sales Report</button>
                    <button class="btn btn-success text-white" data-toggle="modal" data-target="#product-sales-report" ><span class="fas fa-funnel-dollar text-white"></span> Product Expenses Report</button>
                </div>
                </div>
                
                @php
                    $total = 0;
                    $alltrans = array();
                @endphp
                @foreach ($transactions as $key => $transaction)
                                <tr>
                                    <input type="hidden" class=" form-control key" value="{{ $key+1 }}"></input>
                                    <input type="hidden" name="transac_amount" class="form-control transac_amount" value="{{ $transaction->transac_amount }}"></input>
                                    <input type="hidden" name="transac_date" class="form-control transac_date" value="{{$transaction->transac_date }}"></input>
                                    <input type="hidden" name="total" class="form-control total_amount" value="{{ $total = $total + $transaction->transac_amount }}"></input>
                                    <input type="hidden" name="alldate" class="form-control all_date" value="{{$alltrans[$key] = $transaction->transac_date }}"></input>
                                </tr>      
                                        
                @endforeach </td>
                <div class="row p-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <b>Select Date Range </b>
                            <div class="input-group mb-3">
                                <input type="date" id="start-date" class="form-control" required />
                                <div class="input-group-prepend">
                                <span class="input-group-text">TO</span>
                                </div>
                                <input type="date" id="end-date" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <b>Report Type</b>
                            <select class="form-control" id="report-type">
                                <option value="DATE">Per Date</option>
                                <option value="MONTH">Per Month</option>
                                <option value="YEAR">Per Year</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h4 class="ml-5 mb-4"> BOYONG'S SALES REPORT in <span id="bar-title">{{date('F Y')}}</span></h4>
                <!-- <select name="" class="buwan">
                    <option value="1">january</option>
                    <option value="2">february</option>
                    <option value="3">march</option>
                    <option value="4">april</option>
                    <option value="5">may</option>
                    <option value="6">june</option>
                    <option value="7">july</option>
                    <option value="8">august</option>
                    <option value="9">sepmtember</option>
                    <option value="10">october</option>
                    <option value="11">november</option>
                    <option value="12">december</option>
                </select> -->
                <input type="hidden" class="taon"></input>
                <input type="hidden" id="pogi" class ="test" value = "@php echo $total @endphp">
                <!-- <a href="#" id="submit" class="btn btn-sm btn-danger try"><i>Generate</i></a> -->

                <div id="chartContainer" style="height: 500px; width: 95%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                <div style="margin-top:16px;color:dimgrey;font-size:9px;font-family: Verdana, Arial, Helvetica, sans-serif;text-decoration:none;"></a></div>
                <div class="card-body">
                    @if (session('staus'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif  
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background: #1f2833; color: #edf6ff">Products</div>
                <div class="card-body">
                    <div class="row p-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <b>Select Date Range </b>
                                <div class="input-group mb-3">
                                    <input type="date" id="ustart-date" class="form-control" required />
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">TO</span>
                                    </div>
                                    <input type="date" id="uend-date" class="form-control" required />
                                </div>
                                
                            </div>
                            <div class="mb-1">
                            <div id="productContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">Unsold Products</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unsolds as $unsold)
                                <tr>
                                    <td>{{$unsold->product_name}}</td>
                                    <td>{{date('F d,Y h:i a',strtotime($unsold->created_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
            </div>
        </div>
        
    </div>
</div>
<!-- =============================================== -->
<div id="sales-report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sales Report</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            <form target="_blank" action="{{route('sales-report')}}" id="sales-report-form" method="GET" enctype="multipart/form-data" autocomplete="off">
                @csrf
            <div class="form-group">
                <b>Select Date Range </b>
                <div class="input-group mb-3">
                    <input type="date" name="Startdate" class="form-control" required />
                    <div class="input-group-prepend">
                    <span class="input-group-text">TO</span>
                    </div>
                    <input type="date" name="Enddate" class="form-control" required />
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" form="sales-report-form" >Submit</button>
      </div>
    </div>

  </div>
</div>
<div id="product-sales-report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Product Sales Report</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            <form target="_blank" action="{{route('product-report')}}" id="product-report-form" method="GET" enctype="multipart/form-data" autocomplete="off">
                @csrf
            <div class="form-group">
                <b>Select Date Range </b>
                <div class="input-group mb-3">
                    <input type="date" name="Startdate" class="form-control" required />
                    <div class="input-group-prepend">
                    <span class="input-group-text">TO</span>
                    </div>
                    <input type="date" name="Enddate" class="form-control" required />
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" form="product-report-form" >Submit</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>    
//=================================
$(document).ready(function(index){
    $(document).on('change','#start-date',function(){
        var start = $(this).val();
        var end = $('#end-date').val();
        if($.trim(start)){
            $('#start-date').removeClass('is-invalid');
            $('#start-date').addClass('is-valid');
            if($.trim(end)){
                $('#end-date').removeClass('is-invalid');
                $('#end-date').addClass('is-valid');
                chartData(start,end);
            }else{
                $('#end-date').addClass('is-invalid');
            }
        }else{
            $('#start-date').addClass('is-invalid');
        }
    });
    $(document).on('change','#end-date',function(){
        var start = $('#start-date').val();
        var end = $(this).val();
        if($.trim(start)){
            $('#start-date').removeClass('is-invalid');
            $('#start-date').addClass('is-valid');
            if($.trim(end)){
                $('#end-date').removeClass('is-invalid');
                $('#end-date').addClass('is-valid');
                chartData(start,end);
            }else{
                $('#end-date').addClass('is-invalid');
            }
        }else{
            $('#start-date').addClass('is-invalid');
        }
    });
    $(document).on('change','#report-type',function(){
        var start = $('#start-date').val();
        var end = $('#end-date').val();
        if($.trim(start)){
            $('#start-date').removeClass('is-invalid');
            $('#start-date').addClass('is-valid');
            if($.trim(end)){
                $('#end-date').removeClass('is-invalid');
                $('#end-date').addClass('is-valid');
                chartData(start,end);
            }else{
                $('#end-date').addClass('is-invalid');
            }
        }else{
            $('#start-date').addClass('is-invalid');
        }
    });
    //==================================
    $(document).on('change','#ustart-date',function(){
        var start = $(this).val();
        var end = $('#uend-date').val();
        if($.trim(start)){
            $('#ustart-date').removeClass('is-invalid');
            $('#ustart-date').addClass('is-valid');
            if($.trim(end)){
                $('#uend-date').removeClass('is-invalid');
                $('#uend-date').addClass('is-valid');
                productChart(start,end);
            }else{
                $('u#end-date').addClass('is-invalid');
            }
        }else{
            $('#ustart-date').addClass('is-invalid');
        }
    });
    $(document).on('change','#uend-date',function(){
        var start = $('#ustart-date').val();
        var end = $(this).val();
        if($.trim(start)){
            $('#ustart-date').removeClass('is-invalid');
            $('#ustart-date').addClass('is-valid');
            if($.trim(end)){
                $('#uend-date').removeClass('is-invalid');
                $('#uend-date').addClass('is-valid');
                productChart(start,end);
            }else{
                $('#uend-date').addClass('is-invalid');
            }
        }else{
            $('#ustart-date').addClass('is-invalid');
        }
    });
    
});
//=================================
 $('#submit').on('click', function(){
   var key = $('.key').val()-0;

   var jArray = <?php echo json_encode($alltrans); ?>;
   var date = [];

   for (let i = 0; i < jArray.length; i++) {
    date.push(jArray[i]);
    }

   var day = date.getDate();
   var month = date.getMonth() + 1;
   var year = date.getFullYear();
   var amount = $('#pogi').val() - 0;

   
   

  alert(month);
 });


function chartData(start,end){
    var type = $('#report-type').val();
    $.post("{{route('home-functions',['id' => 'submit-date'])}}",{"_token": "{{ csrf_token() }}",start:start,end:end,type:type},function(report_data){
        console.log(report_data);
        var title_data = '';
        if(start==''){
            title_data = "{{date('F')}}";
            console.log(title_data);
        }else{
            title_data = report_data.title;
            $('#bar-title').html('<br>'+title_data);
        }
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light", "dark1", "dark2"
           
            axisY: {
                title: "Sales",
                prefix: "₱"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.0#",
                dataPoints: report_data.records
            }]
        });
        chart.render();
    });
}
chartData('','');
function productChart(start,end){
    $.post("{{route('home-functions',['id' => 'submit-product'])}}",{"_token": "{{ csrf_token() }}",start:start,end:end},function(report_data){
        console.log(report_data);
        var product = new CanvasJS.Chart("productContainer", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            data: [{
                type: "bar",
                startAngle: 25,
                toolTipContent: "<b>{label}</b>: {y} Qty",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - {y} Qty",
                dataPoints: report_data.records
            }]
        });
        product.render();
    });
}
productChart('','');
</script>
@endsection
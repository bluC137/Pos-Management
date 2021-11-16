@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"  style="background: #1f2833; color: #edf6ff">
                        <h4 style="float: left"> Product Barcodes</h4>
                    </div>
                    <div class="card-body">
                        <div id="print">
                            <div class="row">

                                @forelse ($products as $barcode)
                                <div class="col-md-3 col-md-4 col-sm-12 mt-3 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{asset('product/barcode/'.  $barcode->barcode)}} " alt="">
                                            <h4 class="text-center" style="padding: 1em; margin-top: 0.5em"> {{$barcode->product_name}} </h4>

                                        </div>
                                    </div>
                                </div>
                                @empty
                                <h2 align="center"> POGI </h2>
                                @endforelse

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endsection
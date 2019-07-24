@extends('layouts.master')
@section('head')
    
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
    
@endsection
@section('content')
<div class="page-content">
    
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('stocks.index') }}">Stocks</a>
        </li>
        <li class="active">All Stocks</li>
    </ul>
    
    <div class="row">

        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
        <div class="col-md-12">
           
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">All Stock Lists</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="{{ route('stocks.create') }}" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Stock
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                   
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>Serial</th>
                                <th>Store</th>
                                <th>Product</th>
                                <th>Buy Price</th>
                                <th>Sale Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($availables as $i=>$stock)
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td><b>{{$stock->product_stores->stores->name}}</b></td>
                                <td><b>({{$stock->product_stores->products->name}})</b></td>
                                <td>{{$stock->buy_price}}</td>
                                <td>{{$stock->sell_price}}</td>
                                <td>{{$stock->quantity}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection
@section('script')
    
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection

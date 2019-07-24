@extends('layouts.master')

@section('pageTitle', __('role Roles'))

@section('head')

@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="disabled">Account Management</li>
        <li>
            <a href="{{ route('account_management.transactions') }}">Transactions</a>
        </li>
        <li class="active">Transaction Invoices</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Transaction Invoices</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="" class="horizontal-form" method="GET">
                        {{-- @csrf --}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="trans_type">Transaction Type</label>
                                        <select class="form-control select2" id="trans_type" name="trans_type">
                                            <option selected disabled>Select One</option>
                                            <option value="1">Supplier</option>
                                            <option value="2">Customer</option>
                                            <option value="3">Office</option>
                                            <option value="4">Employee</option>
                                            <option value="5">Investor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="trans_id">Transaction ID.</label>
                                        <input type="text" id="trans_id" name="trans_id" class="form-control" placeholder="Transaction ID">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="inv_no">Invoice No.</label>
                                        <input type="text" id="inv_no" name="inv_no" class="form-control" placeholder="Invoice No.">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="from_date">From Date</label>
                                        <div class="input-group input-small date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="from_date" class="form-control" id="from_date" readonly>
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fas fa-calendar-alt font-red"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="to_date">To Date</label>
                                        <div class="input-group input-small date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="to_date" class="form-control" id="to_date" readonly>
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fas fa-calendar-alt font-red"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <a class="btn sbold red" id="trx_inv_search"><i class="fas fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                            {{-- /row --}}
                        </div>
                        {{-- form-body --}}
                    </form>
                    <span id="searchTable"></span>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $("#account_from").change(function () {
            $("select option:selected").each(function () {

                var row ='<div class="row">'+
                            '<div class="col-md-4">'+
                                '<p id=""><b>Balance</b></p>'+
                            '</div>'+
                            '<div class="col-md-8">'+
                                '<p id="balance" class="font-red">121124 TK.</p>'+
                            '</div>'+
                        '</div>';
                $('#balance_row').html(row);
            });
        });
    </script>

    <script>
        $("#trx_inv_search").click(function () {
            var table ='<table class="table table-strpped">'+
                        '<thead>'+
                            '<tr>'+
                                '<th style="width:5%">SL.</th>'+
                                '<th style="width:10%">Trx.&nbsp;No.</th>'+
                                '<th style="width:10%">Inv.&nbsp;No.</th>'+
                                '<th style="width:10%">Amount</th>'+
                                '<th style="width:10%">Type</th>'+
                                '<th style="width:10%">Supplier</th>'+
                                '<th style="width:5%">Date</th>'+
                                '<th style="width:15%">Description</th>'+
                                '<th style="width:15%">Store</th>'+
                                '<th style="width:10%">Action</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                            '<tr>'+
                                '<td>1113</td>'+
                                '<td>12123</td>'+
                                '<td>31232</td>'+
                                '<td>100000 BDT.</td>'+
                                '<td>asdsaa</td>'+
                                '<td>asdsaasds</td>'+
                                '<td>21/12/2019</td>'+
                                '<td>xxxxxxx dasdf</td>'+
                                '<td>xxxxxxx xxxxxx</td>'+
                                '<td>'+
                                    '<div class="btn-group">'+
                                        '<a href="#edit" class="btn blue btn-xs" id="">'+
                                            '<i class="fas fa-edit"></i>'+
                                        '</a>'+
                                        '<a href="#delete" class="btn red btn-xs" id="">'+
                                            '<i class="fas fa-times"></i>'+
                                        '</a>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>';
            $('#searchTable').html(table);
        });
    </script>
    
@endsection

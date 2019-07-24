@extends('layouts.master')
@section('head')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li>
                <a href="{{ route('sales.index') }}">Sales</a>
        </li>
        <li class="active">Sales Chalan</li>
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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Search Sales Chalan</span>
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-body">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-md-8 sales-return-search">
                                                        <div class="col-md-11 sales-input">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="search" name="sale_search" placeholder="Search" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 sales-btn">
                                                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped table-hover order-column">
                                    <thead>
                                        <tr>
                                            <th>xxxx</th>
                                            <th>xxxx</th>
                                            <th>xxxxxxxxxx</th>
                                            <th>xxxxxxxxxxx</th>
                                            <th>xxxxx</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX text-center">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.table -->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection
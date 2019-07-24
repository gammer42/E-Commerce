@extends('layouts.master')
@section('head')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="disabled">Delivery</li>
        <li class="active">Orders</li>
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
                        <span class="caption-subject bold uppercase">List of Delivery Orders</span>
                    </div>
                </div>
                <div class="portlet-body">
                    

                    <table class="table table-striped table-hover order-column">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Service Name</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Delivery Charge</th>
                                <th>Paid Amount</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX text-center">
                                <td>xxxx xxxxxxx xxxxxxxx</td>
                                <td>xxxxxxxx</td>
                                <td>xxxxxxxx xxxxxxx</td>
                                <td>010101010101000</td>
                                <td>5000</td>
                                <td>100</td>
                                <td>Pending</td>
                                <td>
                                    <a href="#view" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold red">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#view" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold green">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a>
                                </td>
                                {{-- Modal View   --}}
                                <div class="modal fade bs-modal-md" id="view" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Delivery Cost Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <ul class="list-group borderless">
                                                        <li class="list-group-item"><b>Delivery Name :</b>  xxxxx xxxxx</li>
                                                        <li class="list-group-item"><b>Delivery Type :</b> xxxxx</li>
                                                        <li class="list-group-item"><b>Agent Name :</b> xxxxx xxxxx</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                {{-- /.Modal View --}}
                            </tr>
                        </tbody>
                    </table>
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
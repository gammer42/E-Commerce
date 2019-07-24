@extends('layouts.master')

@section('pageTitle', __('role Roles')) 

@section('head')
    
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}"> Dashboard</a>
        </li>
        <li>
            <a href="{{ route('sales.index') }}">Sales</a>
        </li>
        <li class="active">Add Order</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
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
                        <span class="caption-subject bold uppercase">Order List</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ route('sales.add') }}" class="btn sbold red">Add Order</a>
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <table class="table table-striped table-bordered table-hover order-column" id="">
                        <thead>
                            <tr>
                                <th>S/L</th>
                                <th>Order No.</th>
                                <th>Customer</th>
                                <th>Store Name</th>
                                <th>Date</th>
                                <th>Notes</th>
                                <th>Total Amount</th>
                                <th>Advance Paid</th>
                                <th>Order Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $i=>$order)
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td>{{$order->order_no}}</td>
                                <td>{{$order->customers->name}}</td>
                                <td>{{$order->stores->name}}</td>
                                <td>{{$order->date}}</td>
                                <td>{{$order->note}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->advance}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a data-toggle="modal" href="#view{{$order->id}}" class="btn green btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.edit_sales_transaction') }}" class="btn blue btn-xs">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" href="#delete{{$order->id}}" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                                {{-- Modal View   --}}
                                <div class="modal fade bs-modal-lg" id="view{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Transaction Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default borderless">
                                                            <div class="panel-body">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                {{-- Delete Modal   --}}
                                <div class="modal fade bs-modal-md" id="delete{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="#" class="horizontal-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title"><b>Delete this entry</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="font-red">
                                                        <strong>Warning!</strong> Are you sure you want to delete this Record?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fas fa-times"></i> No</button>
                                                    <button type="submit" class="btn blue btn-outline">Yes <i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

@endsection

@section('script')
 
@endsection
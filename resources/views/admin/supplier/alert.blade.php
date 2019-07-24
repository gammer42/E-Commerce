@extends('layouts.master')
@section('head')

@endsection
@section('content')
<div class="page-content"> 
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('supplier.index')}}">Supplier</a>
        </li>
        <li class="active">Supplier Payment Alert</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List of Supplier Payment Alerts</span>
                    </div>
                    <div class="btn-group">
                        <button data-toggle="modal" data-target="#supplierPaymentAlert" class="btn sbold red"> Add Supplier Payment Alert
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>SL</th>
                                <th>Supplier</th>
                                <th>Notification Date</th>
                                <th>Payment Date</th>
                                <th>Amount (BDT)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($alerts as $i=>$alert)   
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $alert->suppliers->supplier_name }}</td>
                                <td>{{ $alert->notification_date }}</td>
                                <td>{{ $alert->payment_date }}</td>
                                <td>{{ $alert->amount }}</td>
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="{{ route('supplier_payment_alert.destroy', $alert->id) }}">
                                          <a class="btn btn-xs sbold blue" data-toggle="modal" href="#editSupplierPaymentAlertModal{{$alert->id}}" data-backdrop="static" data-keyboard="false">
                                              <i class="fas fa-edit"></i>
                                          </a>
                                        
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}
                                          <button type="submit" class="btn btn-xs sbold red">
                                              <i class="fas fa-times"></i>
                                          </button>
                                        </form>
                                    </div>                                   
                                </td>
                            </tr>
                            <!-- START Edit ALERT FORM MODAL -->
                            <div id="editSupplierPaymentAlertModal{{$alert->id}}" class="modal fade in" role="dialog" aria-hidden="false" style="display: none; padding-right: 17px;"><div class="modal-backdrop fade in" style="height: 485px;"></div>
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="element-header">Edit Supplier Payment Alert <span class="close" data-dismiss="modal">×</span></h6>
                                    </div>
                                    <form action="{{ route('supplier_payment_alert.update', $alert->id) }}" id="supplier_payment_alert" class="cmxform" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body"> 
                                            <div class="form-group row">
                                                <label class="col-md-3 control-label">Supplier</label>
                                                <div class="col-md-9">
                                                    <select id="single" class="form-control select2" name="supplier">
                                                        <option disabled selected>Select Supplier</option>
                                                        @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}" {{ $alert->supplier_id == $supplier->id? 'selected':''}}>{{ $supplier->supplier_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="">Amount<span class="req">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" value="{{ $alert->amount }}" type="text" id="amount" name="amount">
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="">Notification Date<span class="req">*</span></label>
                            
                                                <div class="col-sm-8">
                                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($alert->notification_date) }}" id="dtt_notification" name="notification_date">
                                                        <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="">Payment Date<span class="req">*</span></label>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($alert->payment_date) }}" id="dtt_payment_est" name="payment_date">
                                                        <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                    <label id="dtt_payment_est-error" class="error" for="dtt_payment_est"></label>
                                                </div>
                                            </div>
                            
                                            <div class="form-buttons-w">
                                                <button class="btn btn-primary" type="submit"> Update</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>        
                                </div>
                            </div>
                            </div>
                            <!-- END Edit ALERT FORM MODAL-->
                          @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
</div>

<!-- START NEW ALERT FORM MODAL -->
<div id="supplierPaymentAlert" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="element-header">Supplier Payment Alert <span class="close" data-dismiss="modal">×</span></h6>
            </div>
            <form action="{{ route('supplier_payment_alert.store') }}" id="supplier_payment_alert" class="cmxform" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
            @csrf
            <div class="modal-body"> 
                <div class="form-group row">
                    <label class="col-md-3 control-label">Supplier</label>
                    <div class="col-md-9">
                        <select id="single" class="form-control select2" name="supplier">
                            <option disabled selected>Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Amount<span class="req">*</span></label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Amount" type="text" id="amount" name="amount">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Notification Date<span class="req">*</span></label>

                    <div class="col-sm-8">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <input type="text" class="form-control" id="dtt_notification" name="notification_date">
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
        
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Payment Date<span class="req">*</span></label>
                    <div class="col-sm-8">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <input type="text" class="form-control" id="dtt_payment_est" name="payment_date">
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <label id="dtt_payment_est-error" class="error" for="dtt_payment_est"></label>
                    </div>
                </div>

                <div class="form-buttons-w">
                    <button class="btn btn-primary" type="submit"> Submit</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>        
        </div>
    </div>
</div>
<!-- END NEW ALERT FORM MODAL-->




@endsection
@section('script')
    
@endsection
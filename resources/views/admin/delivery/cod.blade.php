@extends('layouts.master')
@section('head')
    
@endsection

@section('content')

<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li class="disabled">Delivery</li>
        <li class="active">COD</li>
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
                        <span class="caption-subject bold uppercase">List COD Costs</span>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="form-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">From Date</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text"  name="from_date" class="form-control" readonly="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fas fa-calendar-alt font-red"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">To Date</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text"  name="to_date" class="form-control" readonly="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fas fa-calendar-alt font-blue"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="person_type">Agent Name</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control select2" name="person_type" id="person_type" required>
                                            <option selected disabled>Select One</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Agent">Agent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn red btn-outline" style="margin-top:26px;"><i class="fas fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-striped table-hover order-column">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Agent Name</th>
                                <th>Invoice Amount</th>
                                <th>Delivery Costs</th>
                                <th>COD Costs</th>
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
            <!-- /.table -->
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection
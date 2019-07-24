@extends('layouts.master')

@section('head')
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('supplier.index')}}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <span class="active">&nbsp; Edit Supplier</span>
        </li>
    </ul>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- <h3 class="page-title">Add Brand's Info
        <small>dashboard & statistics</small>
    </h3> -->
    <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-cart font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Edit Supplier</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                    <div class="">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <!-- BEGIN FORM-->
                    <form method="post" action="{{route('supplier.update', $supplier->id)}}" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <!-- <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                            </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Supplier Code
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="supplier_code" data-required="1" class="form-control" value="{{ $supplier->supplier_code }}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Supplier Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="supplier_name" data-required="1" class="form-control" value="{{ $supplier->supplier_name }}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Contact Person
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                        <input type="text" name="contact_person" data-required="1" class="form-control" value="{{ $supplier->contact_person }}"/>
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Email
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="email" data-required="1" class="form-control" value="{{ $supplier->email }}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Phone
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="phone" data-required="1" class="form-control" value="{{ $supplier->phone }}"/> 
                                </div>         
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Store Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="store" data-required="1" class="form-control" value="{{ $supplier->store_name }}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Vat Registration No</label>
                                <div class="col-md-9">
                                    <input type="text" name="vat" data-required="1" class="form-control" value="{{ $supplier->vat_reg_num }}"/> 
                                </div>  
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="2" name="address">{{ $supplier->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Upazila</label>
                                <div class="col-md-9">
                                    <select id="single" class="form-control select2" name="upazila">
                                        <option disabled selected></option>
                                        @foreach ($upazilas as $upazila)
                                        <option value="{{ $upazila->id }}" {{ $supplier->upazila_id == $upazila->id? 'selected':'' }}>{{ $upazila->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="3" name="description">{{ $supplier->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Image</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;"> </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="img"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <a href="{{ route('supplier.index') }}" type="button" class="btn grey-salsa btn-outline">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                                    <!-- END FORM-->
                </div>
            </div>
                            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
@endsection
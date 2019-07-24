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
            <a href="{{ route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('supplier.index')}}">Supplier</a>
        </li>
        <li class="active">Add New Supplier</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
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
        <div class="col-md-10 col-md-offset-1">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-cart font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Add New Supplier</span>
                    </div>
                </div>
                <div class="portlet-body form">
                
                <!-- BEGIN FORM-->
                <form method="post" action="{{route('supplier.store')}}" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Supplier Code
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="supplier_code" data-required="1" class="form-control" /> 
                            </div>        
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Supplier Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="supplier_name" data-required="1" class="form-control" /> 
                            </div>        
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Contact Person
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                    <input type="text" name="contact_person" data-required="1" class="form-control" />
                            </div>        
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="email" data-required="1" class="form-control" /> 
                            </div>        
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Phone
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="phone" data-required="1" class="form-control" /> 
                            </div>         
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Store Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="store" data-required="1" class="form-control" /> 
                            </div>        
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Vat Registration No</label>
                            <div class="col-md-9">
                                <input type="text" name="vat" data-required="1" class="form-control" /> 
                            </div>  
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="2" name="address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upazila</label>
                            <div class="col-md-9">
                                <select id="single" class="form-control select2" name="upazila">
                                    <option disabled selected></option>
                                    @foreach ($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="3" name="description"></textarea>
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
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
@endsection

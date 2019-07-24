@extends('layouts.master')

@section('content')

<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('store.index')}}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <span class="active">&nbsp; Create Store</span>
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
                            <span class="caption-subject font-dark sbold uppercase">Create New Store</span>
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
                    <form method="post" action="{{route('store.store')}}" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                        <div class="form-body">
                            <!-- <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                            </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="name" data-required="1" class="form-control" /> 
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
                                <label class="control-label col-md-3">Address
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="2" name="address">{{ old('address') }}</textarea>
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
                                <label class="control-label col-md-3">City
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="city" data-required="1" class="form-control" /> 
                                </div>         
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Location
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="location" data-required="1" class="form-control" /> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Vat No</label>
                                <div class="col-md-9">
                                    <input type="text" name="vat_no" data-required="1" class="form-control" /> 
                                </div>  
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Post Code
                                    
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="post_code" data-required="1" class="form-control" /> 
                                </div>  
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-md-3">Logo
                                        
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" name="logo" data-required="1" class="form-control" /> 
                                    </div>             
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="5" name="description"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn grey-salsa btn-outline">Cancel</button>
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

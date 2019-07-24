@extends('layouts.master')

@section('content')

<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('store.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Store</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- <h3 class="page-title">Add Brand's Info
        <small>dashboard & statistics</small>
    </h3> -->



    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Edit Store</span>
                    </div>
                    <!-- <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                        </div> -->
                </div>
                
                
                <div class="portlet-body">
                
                    
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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-cart font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Edit Store Info</span>
                                </div>
                            </div>
                        <!-- BEGIN FORM-->
                        <form method="post" action="{{route('store.update', $store->id)}}" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                        <input type="text" name="name" data-required="1" class="form-control" value="{{ $store->name }}"/> 
                                    </div>        
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Email
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="email" data-required="1" class="form-control" value="{{ $store->email }}"/> 
                                    </div>        
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Address
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="2" name="address">{{ $store->address }}</textarea>
                                    </div>        
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Phone
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="phone" data-required="1" class="form-control" value="{{ $store->phone }}"/> 
                                    </div>        
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">City
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="city" data-required="1" class="form-control" value="{{ $store->city }}"/> 
                                    </div>         
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Location
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="location" data-required="1" class="form-control" value="{{ $store->location }}"/> 
                                    </div>        
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Vat No</label>
                                    <div class="col-md-9">
                                        <input type="text" name="vat_no" data-required="1" class="form-control" value="{{ $store->vat_no }}"/> 
                                    </div>  
                                </div>
                                <input type="hidden" name="old_logo" value="{{ $store->logo }}"/>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Post Code
                                        
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="post_code" data-required="1" class="form-control" value="{{ $store->post_code }}"/> 
                                    </div>  
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-md-3">Logo
                                            
                                        </label>
                                        <div class="col-md-9">
                                            <input type="file" name="logo" data-required="1" class="form-control" value="{{ $store->logo }}"/> 
                                        </div>             
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="4" name="description">{{ $store->description }}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Submit</button>
                                        <a href="{{ route('store.index') }}" type="button" class="btn grey-salsa btn-outline">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div> 
                    </div>               <!-- END FORM-->
                </div>
            </div>
                            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>


@endsection
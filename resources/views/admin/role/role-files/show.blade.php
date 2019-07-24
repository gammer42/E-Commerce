@extends('layouts.master')

@section('pageTitle', __('Show Roles')) 

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('role.index')}}">
                
            </a>
        </li>
        <li>
            <span class="active">&nbsp; Show Role</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-users font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Show Role</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                                <label class="col-sm-1 col-form-label">:</label>
                            <label class="col-sm-4 col-form-label">{{ $role->name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Slug') }}</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $role->slug }}</label>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Permission') }}</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <div class="col-md-8">
                                    @foreach ($role->permissions as $item)
                                        <label class="col-sm-4 col-form-label">{{ $item->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
@endsection




@extends('layouts.master')


@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('store.index')}}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <span class="active">&nbsp; Show Store</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-8 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-cart font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Show Store</span>
                    </div>
                    <div class="btn-group" style="float:right; margin:2px;">
                        <form id="del" action="{{ route('store.destroy', $store->id) }}" onclick="return confirm('Are you sure you want to delete this Student?);" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <a onclick="document.getElementById('del').submit();" type="button" class="btn sbold green"><i class="fa fa-trash"></i>&nbsp; Delete
                        </a>
                    </div>
                    <div class="btn-group" style="float:right; margin:2px;">
                        <a href="{{ route('store.edit', $store->id) }}" id="sample_editable_1_new" class="btn sbold green"><i class="fa fa-pencil"></i> &nbsp; Edit
                        </a>
                    </div> &nbsp;
                </div>
               <div class="portlet-body form">
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Store Name</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Store Phone No.</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->phone }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Store Address </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->address }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Location</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->location }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> City </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->city }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Email </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->email }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Email </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $store->email }}</label>
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




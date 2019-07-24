@extends('layouts.master')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('unit.index')}}">Unit</a>
        </li>
        <li class="active">Create Unit</li>
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
                        <span class="caption-subject font-dark sbold uppercase">Create New Unit</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" action="{{ route('unit.store') }}" method="POST" Role="form">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Unit Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Unit Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control"  name="description" rows="2" placeholder="Enter Unit Description Here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
@endsection



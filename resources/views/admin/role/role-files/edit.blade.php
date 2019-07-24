@extends('layouts.master')

@section('pageTitle', __('Update Roles')) 

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('role.index')}}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <span class="active">&nbsp; Update Role</span>
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
                        <span class="caption-subject font-dark sbold uppercase">Update Role</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" action="{{ route('role.update', $role->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Role Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="slug" class="form-control" value="{{ $role->slug }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Display Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control input-inline input-medium" value="{{ $role->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Select Permissions</label>
                                <div class="col-md-6">
                                    <div class="mt-checkbox-inline">
                                        @foreach ($permissions as $permission)
                                        <label class="col-md-4 mt-checkbox">
                                            <input id="permission{{ $i }}" name="permission[]" value="{{$permission->id}}" type="checkbox"
                                            @if($role->permissions->contains($permission))checked @endif> 
                                            {{ $permission->name }}
                                            <span></span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn green">Update</button>
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




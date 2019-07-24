@extends('layouts.master')


@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('user.index')}}">Users</a>
        </li>
        <li class="active">Show User</li>
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
                        <span class="caption-subject font-dark sbold uppercase">Show User</span>
                    </div>
                    <div class="btn-group" style="float:right; margin:2px;">
                        <form id="del" action="" onclick="return confirm('Are you sure you want to delete this Student?);" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <a onclick="document.getElementById('del').submit();" type="button" class="btn sbold green"><i class="fa fa-trash"></i>&nbsp; Delete
                        </a>
                    </div>
                    <div class="btn-group" style="float:right; margin:2px;">
                        <a href="{{ route('user.edit', $users->id) }}" id="sample_editable_1_new" class="btn sbold green"><i class="fa fa-pencil"></i> &nbsp; Edit
                        </a>
                    </div> &nbsp;
                </div>
               <div class="portlet-body form">
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Name</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Phone No.</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->phone }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Email </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->email }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Address </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->address }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upazila Name</label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->upazilas->name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Job Title </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->job_title }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Date of Birth </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->dob }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Blood Group </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->blood_group }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Join Date </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->join_date }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Salary </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->salary }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> National Id Card </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->nid }}</label>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Image </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->img }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> File </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->file }}</label>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Store Name </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->stores->name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Is Access </label>
                                <label class="col-sm-1 col-form-label">:</label>
                                <label class="col-sm-4 col-form-label">{{ $users->is_access ==1 ? "Yes":"No" }}</label>
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




@extends('layouts.master')

@section('head')

    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
        <li class="active">Edit</li>
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
                        <i class="icon-user font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Update User</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    <span class="help-block"> Enter User's Full Name </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Phone</label>
                                <div class="col-md-9">
                                    <div class="input-inline input-medium">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="text" name="phone" class="form-control input-inline input-medium" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <div class="input-inline input-medium">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                    <span class="help-inline"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="password" name="password" value="123456" class="form-control" disabled>
                                    </div>
                                </div>
                                <label class="col-md-3 control-label">Confirm Password</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="password" value="123456" name="password_confirmation" class="form-control" placeholder="Confirm Password" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Designation</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="job_title" value="{{ $user->job_title }}"> </div>
                                </div>
                                <label class="col-md-2 control-label">Salary</label>
                                <div class="col-md-3">
                                    <input type="text" name="salary" class="form-control" value="{{ $user->salary }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">National ID</label>
                                <div class="col-md-9">
                                    <input type="text" name="nid" class="form-control" value="{{ $user->nid }}">
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Blood Group</label>
                                <div class="col-md-9">
                                    <select class="form-control"  name="blood_group">
                                        <option>{{ $user->blood_group }}</option>
                                        <option>A+ve</option>
                                        <option>B+ve</option>
                                        <option>AB+ve</option>
                                        <option>O+ve</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Store</label>
                                <div class="col-md-9">
                                    <select class="form-control"  name="store">
                                            @foreach ($stores as $store)
                                            <option value="{{ $store->id }}" {{ $store->id == $user->id? "selected":""}}>{{ $store->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Roles</label>
                                <div class="col-md-9">
                                    <select class="form-control"  name="role">
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $store->id == $user->id? "selected":""}}>{{ $role->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Address</label>
                                <div class="col-md-9">
                                    <textarea class="form-control"  name="address" rows="2">{{ $user->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-md-3 control-label">Upazila</label>
                                    <div class="col-md-9">
                                        <select id="single" class="form-control select2" name="upazila">
                                            @foreach ($upazilas as $upazila)
                                            <option value="{{ $upazila->id }}" {{ $store->id == $user->id? "selected":""}}>{{ $upazila->name }}</option>
                                            @endforeach
                                        </select>
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
                                                <input type="file" name="img value="{{ $user->img }}""> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-md-3 control-label">File</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="file" > </span>
                                        <span class="fileinput-filename"> </span> &nbsp;
                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date of Birth</label>
                                <div class="col-md-9">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text"  name="dob" value="{{ $user->dob }}" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Join Date</label>
                                <div class="col-md-9">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text"  name="join_date" value="{{ $user->join_date }}" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    {{-- <button type="submit" class="btn green">Submit</button> --}}
                                    <a type="button" href="{{route('user.index') }}" class="btn default">Cancel</a>
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
<!-- END CONTENT BODY -->

@endsection

@section('script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>


@endsection

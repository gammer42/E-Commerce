@extends('layouts.master')

@section('head')

    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css">
    
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="active">Users</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Users</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false">Add New User
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="">
                        <thead>
                            <tr>
                                <th style="width:5%">SL.</th>
                                <th style="width:15%">Full Name</th>
                                <th style="width:15%">Phone Number</th>
                                <th style="width:15%">Email Address</th>
                                <th style="width:20%">Store</th>
                                <th style="width:15%">Status</th>
                                <th style="width:15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $i=>$user)
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <a href="mailto:shuxer@gmail.com"> {{ $user->email }} </a>
                                </td>
                                @if(isset($user->stores->name))
                                <td> {{ $user->stores->name }} </td>
                                @else 
                                <td>No Store </td>
                                @endif
                                @if($user->is_access == 1)
                                <td>
                                    <span class="label label-sm label-success">Active</span>
                                </td>
                                @else
                                <td>
                                    <span class="label label-sm label-warning"> Suspended </span>
                                </td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a data-toggle="modal" href="#view{{ $user->id }}" class="btn green btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a data-toggle="modal" href="#edit{{ $user->id }}" class="btn blue btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a data-toggle="modal" href="#delete{{ $user->id }}" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                </td>
                                {{-- Modal View   --}}
                                <div class="modal fade bs-modal-lg" id="view{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">User Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="storage/images/users/photos/{{ $user->img }}" alt="" class="img-responsive profile-square">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Designation</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->job_title }}</p>
                                                            </div>
                                                        </div>
                                            
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Full Name</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->name }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Mobile Number</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->phone }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Email Address</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->email }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>NID Number</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->nid }}</p>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Store Name</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                @isset($user->stores->name)
                                                                <p>{{ $user->stores->name }}</p>
                                                                @else
                                                                <p>No Store</p>
                                                                @endisset
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Role</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->roles[0]->name }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Blood Group</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->blood_group }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Joining Date</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->join_date }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Date Of Birth</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->dob }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Location</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->upazilas->name }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p><b>Address</b></p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="colon">:</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{ $user->address }}</p>
                                                            </div>
                                                        </div>
                                                    </div>{{-- /.col-md-8 --}}
                                                </div>{{-- /.row --}}
                                            </div> {{-- /.panel-body --}}
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- /.Modal View --}}

                                {{-- Edit Modal --}}
                                <div class="modal fade bs-modal-lg" id="edit{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('user.update',$user->id) }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="fas fa-times font-red"></i>
                                                    </button>
                                                    <h4 class="modal-title">Edit User</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="name">Full Name</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="phone">Mobile Number</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="uemail">Email Address</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="email" id="uemail" name="email" class="form-control" value="{{ $user->email }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="nid">NID Number</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="text" id="nid" name="nid" class="form-control" value="{{ $user->nid }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="npass">New Password</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="password" id="npass" name="password" class="form-control" value="123456" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="cpass">Confirm Password</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="password" id="cpass" name="password_confirmation" class="form-control" value="123456" disabled>
                                                                    <span id='message'></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="job_title">Designation</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="text" id="job_title" name="job_title" class="form-control" value="{{ $user->job_title }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="salary">Salary</label>
                                                                    <span class="font-red">*</span>
                                                                    <input type="text" id="salary" name="salary" class="form-control" value="{{ $user->salary }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="blood_group">Blood Group</label>
                                                                    <span class="font-red">*</span>
                                                                    <select class="form-control" id="blood_group" name="blood_group">
                                                                        <option value="AB+" {{ $user->blood_group == 'AB+'? 'selected':'' }}>AB+ (Positive)</option>
                                                                        <option value="AB-" {{ $user->blood_group == 'AB-'? 'selected':'' }}>AB- (Negative)</option>
                                                                        <option value="A+" {{ $user->blood_group == 'A+'? 'selected':'' }}>A+ (Positive)</option>
                                                                        <option value="A-" {{ $user->blood_group == 'A-'? 'selected':'' }}>A- (Negative)</option>
                                                                        <option value="B+" {{ $user->blood_group == 'B+'? 'selected':'' }}>B+ (Positive)</option>
                                                                        <option value="B-" {{ $user->blood_group == 'B-'? 'selected':'' }}>B- (Negative)</option>
                                                                        <option value="O+" {{ $user->blood_group == 'O+'? 'selected':'' }}>O+ (Positive)</option>
                                                                        <option value="O-" {{ $user->blood_group == 'O-'? 'selected':'' }}>O- (Negative)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="store">Store Name</label>
                                                                    <span class="font-red">*</span>
                                                                    <select class="form-control" id="store" name="store">
                                                                        @foreach ($stores as $store)
                                                                            <option value="{{ $store->id }}" {{ $user->store == $store->id? 'selected':'' }}>{{ $store->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="role">User Role</label>
                                                                    <span class="font-red">*</span>
                                                                    <select class="form-control" id="role" name="role">
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}" {{ $user->role == $role->id? 'selected':'' }}>{{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="location">Location</label>
                                                                    <span class="font-red">*</span>
                                                                    <select id="single" class="form-control select2" name="upazila">
                                                                        <option disabled selected></option>
                                                                        @foreach ($upazilas as $upazila)
                                                                        <option value="{{ $upazila->id }}" {{ $user->upazila_id == $upazila->id? 'selected':'' }}>{{ $upazila->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->

                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="dob">Date of Birth</label>
                                                                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                                                <input type="text" name="dob" class="form-control" value="{{ $user->dob }}" readonly="">
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn default" type="button">
                                                                                        <i class="fas fa-calendar-alt font-red"></i>
                                                                                    </button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="join">Join Date</label>
                                                                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                                                <input type="text"  name="join_date" class="form-control" value="{{ $user->join_date }}" readonly="">
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn default" type="button">
                                                                                        <i class="fas fa-calendar-alt font-red"></i>
                                                                                    </button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="address">Address</label>
                                                                            <textarea name="address" id="address" rows="4" class="form-control" required>{{ $user->address}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <p><b>File Name: </b>{{ $user->file }}</p>
                                                                            <label for="file" class="control-label">File:</label>
                                                                            <div class="fileinput fileinput-new" data-provides="fileinput" id="file">
                                                                                <span class="btn green btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="file" accept="docx,doc,docs,pdf,image/*" value="{{ $user->file}}">
                                                                                </span>
                                                                                <span class="fileinput-filename"> </span>
                                                                                <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="control-label" for="image">User Photo</label>
                                                                <div class="form-group">
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                                                            <img src="storage/images/users/photos/{{ $user->img }}" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                                                        </div>
                                                                        <div>
                                                                            <span class="btn red btn-outline btn-file">
                                                                                <span class="fileinput-new"> Select image </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" name="img" accept="image/*" value="{{ $user->img }}"> </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                    {{-- <button type="submit" class="btn blue btn-outline">Submit</button> --}}
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- /.Edit Modal --}}

                                {{-- Delete Modal   --}}
                                <div class="modal fade bs-modal-md" id="delete{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('user.destroy', $user->id)}}" class="horizontal-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="fas fa-times font-red"></i>
                                                    </button>
                                                    <h4 class="modal-title">Delete this entry</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="font-red">
                                                        <strong>Warning!</strong> Are you sure you want to delete this Record?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fas fa-times"></i> No</button>
                                                    <button type="submit" class="btn blue btn-outline">Yes <i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr>                                                       
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
{{-- Add Modal --}}
<div class="modal fade bs-modal-lg" id="add" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.store') }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="name">Full Name</label>
                                    <span class="font-red">*</span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="phone">Mobile Number</label>
                                    <span class="font-red">*</span>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Mobile Number" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="uemail">Email Address</label>
                                    <span class="font-red">*</span>
                                    <input type="email" id="uemail" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="nid">NID Number</label>
                                    <span class="font-red">*</span>
                                    <input type="text" id="nid" name="nid" class="form-control" placeholder="NID Number" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="npass">New Password</label>
                                    <span class="font-red">*</span>
                                    <input type="password" id="npass" name="password" class="form-control" placeholder="New Password" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="cpass">Confirm Password</label>
                                    <span class="font-red">*</span>
                                    <input type="password" id="cpass" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                    <span id='message'></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="job_title">Designation</label>
                                    <span class="font-red">*</span>
                                    <input type="text" id="job_title" name="job_title" class="form-control" placeholder="Designation" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="salary">Salary</label>
                                    <span class="font-red">*</span>
                                    <input type="text" id="salary" name="salary" class="form-control" placeholder="Salary" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="blood_group">Blood Group</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" id="blood_group" name="blood_group">
                                        <option value="" selected disabled>Select One</option>
                                        <option value="AB+">AB+ (Positive)</option>
                                        <option value="AB-">AB- (Negative)</option>
                                        <option value="A+">A+ (Positive)</option>
                                        <option value="A-">A- (Negative)</option>
                                        <option value="B+">B+ (Positive)</option>
                                        <option value="B-">B- (Negative)</option>
                                        <option value="O+">O+ (Positive)</option>
                                        <option value="O-">O- (Negative)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="store">Store Name</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" id="store" name="store">
                                            <option value="" selected disabled>Select One</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="role">User Role</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" id="role" name="role" required>
                                            <option value="" selected disabled>Select One</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="single">Location</label>
                                    <span class="font-red">*</span>
                                    <select id="single" class="form-control select2" name="upazila">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="dob">Date of Birth</label>
                                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                <input type="text" name="dob" class="form-control" id="dob" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fas fa-calendar-alt font-red"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="join_date">Join Date</label>
                                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                <input type="text" name="join_date" class="form-control" id="join_date" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fas fa-calendar-alt font-red"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="address">Address</label>
                                            <textarea name="address" id="address" rows="4" class="form-control" placeholder="User Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file" class="control-label">File:</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput" id="file">
                                                <span class="btn green btn-file">
                                                    <span class="fileinput-new"> Select file </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="file" accept="docs,pdf,image/*"> </span>
                                                <span class="fileinput-filename"> </span>
                                                <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="image">User Photo</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                            <img src="user.png" alt="User Image" class="img-responsive">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="img" accept="image/*"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- /.Modal Add --}}

@endsection

@section('script')

    <script src="{{asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    
    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>

    
@endsection
@extends('layouts.master')

@section('head')

@endsection

@section('content')
<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{route('home')}}">Dashboard</a>
        </li>
        <li class="active">Customers</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Customers</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('customer.create') }}" class="btn sbold red"> Add New Customer
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Customer Type</th>
                                <th>Mobile Number</th>
                                <th>Points</th>
                                <th>Balance (BDT)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $i=>$customer)

                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $customer->membership_id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->types->type_name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->earned_point }}&nbsp; Pt.</td>
                                <td>{{ $customer->advanced_amount+0 }}&nbsp; Tk</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route("customer.show",$customer->id) }}" class="btn btn-xs sbold green">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route("customer.edit",$customer->id) }}" class="btn btn-xs sbold blue">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a class="btn btn-xs sbold red" data-toggle="modal" href="#delete{{ $customer->id }}" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                            {{-- Delete Modal   --}}
                            <div class="modal fade bs-modal-md" id="delete{{ $customer->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('customer.destroy', $customer->id ) }}" class="horizontal-form" method="POST">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.table -->
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade bs-modal-lg" id="add"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('customer.store') }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New Customer</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Membership ID</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="membership_id" name="membership_id" class="form-control" placeholder="123456" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Customer Type</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control" name="customer_type" id="customer_type" required>
                                        <option value="" disabled selected>Select One</option>
                                        @foreach ($types as $type)
                                            <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Date Of Birth</label>
                                    <div class="input-group input-medium date date-picker" id="full_width_input" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" name="dob" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fas fa-calendar-alt font-red"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Gender</label>
                                    <div class="space" style="margin-top:7px;"></div>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="1">Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="2" checked>Female
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="0">Others
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Marital Status(Optional)</label>
                                            <select class="form-control" name="marital_status" id="marital_status">
                                                <option value="" selected>Select One</option>
                                                <option value="1">Married</option>
                                                <option value="2">Unmarried</option>
                                                <option value="3">Devorced</option>
                                                <option value="4">Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Anniversary Date</label>
                                            <div class="input-group input-medium date date-picker" id="full_width_input" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                <input type="text" name="anniversary_date" class="form-control" readonly="">
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fas fa-calendar-alt font-red"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="addPhoneRow">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="phone">Phone</label>
                                            <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone" required>
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button" id="addPhoneBtn">
                                                        <i class="fas fa-plus font-green"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Customer Photo</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                            <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=DressUp" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo" accept="image/*"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    {{-- <span class="text-danger">*</span> --}}
                                    <textarea name="description" id="" rows="10"  class="form-control"  placeholder="Customer's Description.."></textarea>
                                </div>
                            </div>
                        </div><!--/row-->

                        <div class="row" id="showAddressRow">
                            <div class="col-md-12">
                                <span class="pull-right" style="padding:15px">
                                    <button type="button" name="add" id="addAddressBtn" class="btn btn-success">Add More</button>
                                </span>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="title">Address Details</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                               
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="address_type">Address Type</label>
                                                        <select class="form-control" id="address_type" name="address_type[]">
                                                            <option value="" selected>Select One</option>
                                                            <option value="1">Permanent</option>
                                                            <option value="2">Present</option>
                                                            <option value="3">Work</option>
                                                            <option value="4">Delivery</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label" for="district">District</label>
                                                        <select id="single" class="form-control select2" name="district_id[]">
                                                            <option disabled selected></option>
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="address">Address</label>
                                                        <textarea name="street[]" id="address" rows="2"  class="form-control"  placeholder="Enter your address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection

@section('script')

@endsection

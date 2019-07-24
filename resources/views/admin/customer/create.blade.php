@extends('layouts.master')

@section('head')

@endsection

@section('content')
<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('customer.index')}}">Customers</a>
        </li>
        <li class="active">Add Customer</li>
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
                        <span class="caption-subject bold uppercase">Add New Customer</span>
                    </div>
                    
                </div>
                <div class="portlet-body">
                    <form action="{{ route('customer.store') }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                <label class="control-label" for="photo">Customer Photo</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                            <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=DressUp" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo" id="photo" accept="image/*"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label" for="description">Description/Note</label>
                                    <textarea name="description" id="description" rows="10"  class="form-control"  placeholder="Customer's Description/Note.."></textarea>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-stripped table-bordered" id="showAddressRow">
                                    <thead>
                                        <tr>
                                            <th style="width:20%">Address Type</th>
                                            <th style="width:20%">District</th>
                                            <th style="width:50%">Location</th>
                                            <th style="width:10%">
                                                <button type="button" name="add" id="addAddressBtn" class="btn sbold green">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group" style="margin-top:10px;">
                                                    <select class="form-control" id="address_type" name="address_type[]">
                                                        <option selected disabled>Select One</option>
                                                        <option value="1">Permanent</option>
                                                        <option value="2">Present</option>
                                                        <option value="3">Work</option>
                                                        <option value="4">Delivery</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group" style="margin-top:10px;">
                                                    <select id="" class="form-control select2" name="district_id[]">
                                                        <option disabled selected>Select District</option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="street[]" id="address" rows="2"  class="form-control"  placeholder="Enter your address"></textarea>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="reset" class="btn red btn-outline">Reset</button>
                                <button type="submit" class="btn blue btn-outline">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.table -->
        </div>
    </div>
</div>

@endsection

@section('script')

    {{-- dynamic phone field addition for add page --}}
    <script type="text/javascript">
        $("#addPhoneBtn").click(function(){
            var phoneRow ='<div class="col-md-12"><div class="form-group"><label class="control-label">Alternative Phone</label><span class="text-danger">*</span><div class="input-group"><input type="tel" id="phone" name="alt_phone[]" class="form-control" placeholder="Alternative Phone" required><span class="input-group-btn"><button class="btn default" type="button" id="removePhoneBtn"><i class="fas fa-minus font-red"></i></button></span></div></div></div>';
            $("#addPhoneRow").append(phoneRow);

        });

        $(document).on('click', '#removePhoneBtn', function(){
            if ($('#addPhoneRow > div').length > 1) {
                $('#addPhoneRow > div').last().remove();
            }
        });
    </script>

   
    {{-- address for add page --}}
    <script type="text/javascript">
        $("#addAddressBtn").click(function(){
        var addressRow ='<tr id="removeAddressRow">'+
                            '<td>'+
                                '<div class="form-group" style="margin-top:10px;">'+
                                    '<select class="form-control" id="address_type" name="address_type[]">'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '<option value="1">Permanent</option>'+
                                        '<option value="2">Present</option>'+
                                        '<option value="3">Work</option>'+
                                        '<option value="4">Delivery</option>'+
                                    '</select>'+
                                '</div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="form-group" style="margin-top:10px;">'+
                                    '<select id="single" class="form-control select2" name="district_id[]">'+
                                        '<option value="" selected disabled>Select District</option>'+
                                        '@foreach ($districts as $district)'+
                                            '<option value="{{ $district->id }}">{{ $district->name }}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="form-group">'+
                                    '<textarea name="street[]" id="address" rows="2"  class="form-control"  placeholder="Enter your address"></textarea>'+
                                '</div>'+
                            '</td>'+
                            '<td class="text-center">'+
                                '<button type="button" name="add" id="removeBtnAdd" class="btn sbold red" style="margin-top:10px">'+
                                    '<i class="fas fa-times"></i>'+
                                '</button>'+
                            '</td>'+
                        '</tr>';
           
            $("#showAddressRow").append(addressRow);
            $('.select2').select2();                
           
        });

        $(document).on('click', '#removeBtnAdd', function(){
            $(this).parents('#removeAddressRow').remove();
        });
    </script>
    

@endsection

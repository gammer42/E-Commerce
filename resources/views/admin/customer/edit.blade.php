@extends('layouts.master')

@section('head')

@endsection

@section('content')
<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('customer.index') }}">Customer</a>
        </li>
        <li class="active"> Edit Customer Info </li>
    </ul>

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
        </div>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Edit Customer's Details</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ route('customer.create') }}" class="btn sbold red" >Add New Customer</a>
                    </div> 
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('customer.update', $customer->id ) }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Membership ID</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" id="membership_id" name="membership_id" class="form-control" value="{{$customer->membership_id}}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Full Name</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$customer->name}}" required>
                                            </div>
                                        </div>
            
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" id="email" name="email" class="form-control" value="{{$customer->email}}">
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
                                                    @foreach ($types as $type)
                                                        <option value="{{$type->id}}" {{$customer->type_id == $type->id? 'selected':''}}>{{$type->type_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Date Of Birth</label>
                                                <div class="input-group">
                                                    <input type="text" name="dob" id="dob" value="{{$customer->dob}}" class="form-control date-picker">
                                                    <span class="input-group-btn">
                                                        <button class="btn default date-picker" type="button">
                                                            <i class="far fa-calendar-alt font-blue"></i>
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
                                                    <input type="radio" name="gender" id="gender" value="1" {{$customer->gender==1?'checked':''}}>Male
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="2" {{$customer->gender==2?'checked':''}}>Female
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="0" {{$customer->gender==0?'checked':''}}>Others
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
                                                        <label class="control-label">Marital Status</label>
                                                        <select class="form-control" name="marital_status" id="marital_status">
                                                            <option value="1" {{$customer->marital_status==1?'checked':''}}>Married</option>
                                                            <option value="2"{{$customer->marital_status==2?'checked':''}}>Unmarried</option>
                                                            <option value="3"{{$customer->marital_status==3?'checked':''}}>Devorced</option>
                                                            <option value="4"{{$customer->marital_status==4?'checked':''}}>Widowed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Anniversary Date</label>
                                                        <div class="input-group">
                                                            <input type="text" name="anniversary_date" id="anniversary_date" value="{{$customer->anniversary_date}}" class="form-control date-picker">
                                                            <span class="input-group-btn">
                                                                <button class="btn default date-picker" type="button">
                                                                    <i class="far fa-calendar-alt font-red"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="newPhone">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone</label>
                                                        <span class="text-danger">*</span>
                                                        <div class="input-group">
                                                            <input type="tel" id="phone" name="phone" class="form-control" value="{{$customer->phone}}" required>
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button" id="addPhone">
                                                                    <i class="fas fa-plus font-green"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                    @foreach($customer->phones as $key=>$phone)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Alternative Phone {{$key+1}}</label>
                                                        <span class="text-danger">*</span>
                                                        <div class="input-group">
                                                            <input type="tel" id="phone" name="alt_phone[]" class="form-control" value="{{$phone->phone}}" required>
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button" id="removeEditPhone"><i class="fas fa-minus font-red"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
            
                                        <div class="col-md-3">
                                            <label class="control-label">Customer Photo</label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                                        <img src="{{URL::to('storage/images/customer/'.$customer->img) }}" alt="Customer's Photo" class="img-responsive" style="width: 200px; height: 200px;">
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
                                                <textarea name="description" id="" rows="10"  class="form-control">{{$customer->description}}</textarea>
                                            </div>
                                        </div>
                                    </div><!--/row-->
                                    
                                   
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
                                                    @foreach($customer->address as $key=>$address)
                                                    <tr id="AddressRowOld{{ $key+1 }}">
                                                        <td>
                                                            <div class="form-group" style="margin-top:10px;">
                                                                <select class="form-control" id="address_type" name="address_type[]">
                                                                    <option value="1"{{$address->address_type==1?'selected':''}}>Permanent</option>
                                                                    <option value="2"{{$address->address_type==2?'selected':''}}>Present</option>
                                                                    <option value="3"{{$address->address_type==3?'selected':''}}>Work</option>
                                                                    <option value="4"{{$address->address_type==4?'selected':''}}>Delivery</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group" style="margin-top:10px;">
                                                                <select id="" class="form-control select2" name="district_id[]">
                                                                    <option disabled selected>Select District</option>
                                                                    @foreach ($districts as $district)
                                                                        <option value="{{ $district->id }}" {{$address->district_id==$district->id?'selected':''}}>{{ $district->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <textarea name="street[]" id="address" rows="2"  class="form-control">{{$address->street}}</textarea>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            @if($key > 0)
                                                                <button type="button" onclick="getTrID({{ $key+1 }})" id="removeBtnOld" class="btn sbold red" style="margin-top:10px">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                                
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-10 col-md-2">
                                            <button type="reset" class="btn red btn-outline">Reset</button>
                                            <button type="submit" class="btn blue btn-outline">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{-- dynamic phone field addition for edit page --}}
    <script type="text/javascript">
        $("#addPhone").click(function(){
            var phoneRow ='<div class="col-md-12"><div class="form-group"><label class="control-label">Alternative Phone</label><span class="text-danger">*</span><div class="input-group"><input type="tel" id="phone" name="alt_phone[]" class="form-control" placeholder="Alternative Phone" required><span class="input-group-btn"><button class="btn default" type="button" id="removeEditPhone"><i class="fas fa-minus font-red"></i></button></span></div></div></div>';
            $("#newPhone").append(phoneRow);
            
        });

        $(document).on('click', '#removeEditPhone', function(){  
            if ($('#newPhone > div').length > 1) {
                $('#newPhone > div').last().remove();
            }
        });  
    </script>

    
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

    <script type="text/javascript">
        function getTrID(id){
        
            if(id>1)
            {
                $('#AddressRowOld'+id).remove();
            }
        
        }
    </script>

@endsection
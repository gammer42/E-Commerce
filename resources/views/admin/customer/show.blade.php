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
            <a href="{{route('customer.index')}}">Customer</a>
        </li>
        <li>
            <span class="active">Customer Details</span>
        </li>
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
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Customer Details</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ route('customer.edit',$customerDetail->id) }}"><button class="btn btn-danger">Edit Customer's Info.</button></a>
                    </div> 
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills">
                                <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                                <li><a data-toggle="tab" href="#address">Address</a></li>
                                <li><a data-toggle="tab" href="#invoice">Invoice History</a></li>
                                <li id="points"><a>Points: {{ $customerDetail->earned_point }} </a></li>
                                <li id="balance"><a>Balance: {{ $customerDetail->advanced_amount+0 }} </a></li>
                            </ul>
                            
                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Membership ID.</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->membership_id }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Full Name</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Gender</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->gender== 1? 'Male':'Female' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Phone Number</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{ $customerDetail->phone }}@foreach ($customerDetail->phones as $phone),&nbsp;{{ $phone->phone }}@endforeach.
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Email Address</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Date Of Birth</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->dob }}</p>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Marital Status</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->m_status = 1 ? "Married" : $customerDetail->m_status = 2 ? "Unmarried" :  $customerDetail->m_status = 3 ? "Devorced" : $customerDetail->m_status = 4 ? "Widowed" : "Not Found"}}</p>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><b>Anniversary Date</b></p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p>{{ $customerDetail->anniversary_date }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <img src="{{URL::to('storage/images/customer/'.$customerDetail->img) }}" alt="customer image" class="img-responsive profile-square">
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="card" id="customer_note">
                                                        <div class="card-heading" id="customer_heading">
                                                            <h4 class="font-red">Customer's Description (Note)</h4>
                                                        </div>
                                                        <div class="card-body" id="customer_content">
                                                            {{ $customerDetail->description }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="address" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                                <thead>
                                                    <tr>
                                                        <th>Serial</th>
                                                        <th>Address Type</th>
                                                        <th>District</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customerDetail->address as $key => $address)
                                                    <tr class="odd gradeX">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>@if($address->address_type == 1)Permanent @elseif($address->address_type == 2) Present @elseif($address->address_type == 3) Work @elseif($address->address_type == 4) Delevery @else No Type @endif</td>
                                                        <td>{{ $address->districts->name }}</td>
                                                        <td>{{ $address->phone }}</td>
                                                        <td>{{ $address->street }}</td>
                                                    </tr>    
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                               
                                <div id="invoice" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered table-hover" id="">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">Serial</th>
                                                        <th style="width:9ex">Invoice Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>1</td>
                                                        <td>No Database</td>
                                                    </tr>    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection
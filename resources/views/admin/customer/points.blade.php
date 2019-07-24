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
            <a href="{{ route('customer.index') }}">Customers</a>
        </li>
        <li class="active">Customer's Points</li>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Point Earn Rate</span>
                    </div>
                </div>    
                <div class="portlet-body">
                    <div class="form-body">
                        <form action="{{ route('customer-point-update') }}" method="POST">
                            @csrf
                            <div class="row" id="earn_point">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <input type="text" id="point" name="point" class="form-control" value="{{ $point->earn_rate}}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <p>BDT (TK.)</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p>=</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>1 Points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn sbold red">Update Point Rate</button>
                                </div>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Point Redeem Rate</span>
                    </div>
                </div>    
                <div class="portlet-body">
                    <div class="form-body">
                        <form action="{{ route('customer-point-update') }}" method="POST">
                            @csrf
                            <div class="row" id="earn_point">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <p>1 Points</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p>=</p>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="redeem" name="redeem" class="form-control" value="{{ $point->redeem_rate}}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <p>BDT (TK.)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn sbold red">Update Redeem Rate</button>
                                </div>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>
        </div>     
    </div>
</div>

@endsection

@section('script')

@endsection

@extends('layouts.master')
@section('head')
  
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('promotion.index')}}">Promotion</a>
        </li>
        <li class="active">Promotion Management</li>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Promotions</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('promotion.add-promotion') }}" class="btn sbold red"> Add New Promotion</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>SL.</th>
                                <th>Promotion Name</th>
                                <th>Promotion Type</th>
                                <th data-sortable="false">Discount Type</th>
                                <th>Discount Amount</th>
                                <th>Date (Start to End)</th>
                                <th data-sortable="false">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $i=>$promotion)   
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td>{{$promotion->title}}</td>
                                <td>
                                    @if($promotion->type==1)Promotion on Product 
                                    @elseif($promotion->type==2)Promotion on Purchase
                                    @elseif($promotion->type==3)Promotion on Card
                                    @else No Promotion Type
                                    @endif
                                </td>
                                <td>
                                    @if($promotion->discount_type==1)Parcentage (%)
                                    @elseif($promotion->discount_type==2)BDT (৳)
                                    @else No Discount Type
                                    @endif
                                </td>
                                @if($promotion->discount_type==1)
                                <td>{{$promotion->discount_amount}}&nbsp;&nbsp; %</td>
                                @else <td>{{$promotion->discount_amount}}&nbsp;&nbsp; ৳</td>
                                @endif
                                <td><b>{{$promotion->start_from}}&nbsp;to&nbsp;{{$promotion->end_to}}</b></td>
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="#">
                                            <a class="btn btn-xs sbold green" data-toggle="modal" href="#view{{$promotion->id}}" data-backdrop="static" data-keyboard="false"><i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('promotion.edit-promotion',$promotion->id) }}" class="btn btn-xs sbold blue">
                                              <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- <a class="btn btn-xs sbold red" data-toggle="modal" href="#delete{{$promotion->id}}" data-backdrop="static" data-keyboard="false">
                                                <i class="fas fa-trash"></i>
                                            </a> -->
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                            
                            <!-- View Modal -->
                            <div class="modal fade bs-modal-md" id="view{{$promotion->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Promotion Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Promotion Title</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->title}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Promotion Type</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->type===1?"Promotion on Product":($promotion->type===2?"Promotion on Purchase":(($promotion->type===3?"Promotion on Card ":"No Promotion Type")))}}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Promotion Period</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->start_from}}&nbsp;&nbsp;<strong class="font-red">To</strong>&nbsp;&nbsp;{{$promotion->end_to}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Promotion Status</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->status===1?"Active":($promotion->status===2?"Inactive":"Pending")}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Discount Type</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->discount_type===1?"Percentage (%)":($promotion->discount_type===2?"BDT (৳)":"No Discount Type")}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Discount Amount/Parcent</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->discount_amount}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <p>Description</p>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p class="colon">:</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$promotion->Description}}</p>
                                                    </div>
                                                </div>
                                               
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title text-center">The Stores that are running This Promotion</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                                @foreach ($promotion->stores as $i=>$item)
                                                                    <div class="col-md-4 role-permissions">
                                                                        <p>{{$i+1}}&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="rTable">
                                                            <div class="rTableRow">
                                                                <div class="rTableCell text-center"><b>Category</b></div>
                                                                <div class="rTableCell text-center"><b>Sub Category</b></div>
                                                            </div>
                                                            @foreach($promotion->categories as $cat)
                                                            <div class="rTableRow">
                                                                <div class="rTableCell text-center">{{$cat->parent->name}}</div>
                                                                <div class="rTableCell text-center">{{$cat->name}}</div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="rTable">
                                                            <div class="rTableRow">
                                                                <div class="rTableCell text-center"><b>Brand</b></div>
                                                            </div>
                                                            @foreach($promotion->brands as $brand)
                                                            <div class="rTableRow">
                                                                <div class="rTableCell text-center">{{$brand->name}}</div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- delete modal -->
                                <div class="modal fade bs-modal-md" id="delete{{$promotion->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('promotion.destroy', $promotion->id)}}" class="horizontal-form" method="POST">
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
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>

@endsection
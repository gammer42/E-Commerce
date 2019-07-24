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
            <a href="{{ route('requisition.index') }}">Requisitions</a>
        </li>
        <li class="active">All Requisitions</li>
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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Requisitions</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Requisition
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>Serial</th>
                                <th>Store</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requisitions as $i=>$requisition)
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td><b>{{$requisition->product_stores->stores->name}}-</b>({{$requisition->product_stores->stores->phone}})</td>
                                <td><b>{{$requisition->product_stores->products->name}}-</b>({{$requisition->product_stores->products->product_code}})</td>
                                <td>{{$requisition->quantity}}</td>
                                @if($requisition->status==1)
                                <td><span class="label label-sm label-success">Granted</span></td>
                                @else
                                <td><span class="label label-sm label-warning">Pending</span>&nbsp;
                                    <a class="btn btn-xs sbold green" href="{{route("requisition.check", $requisition->id) }}">
                                        <i class="fas fa-check-square"></i>
                                    </a>
                                </td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="">
                                            <a class="btn btn-xs sbold blue" data-toggle="modal" href="#edit{{$requisition->id}}" data-backdrop="static" data-keyboard="false">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- <a data-toggle="modal" href="#delete{{$requisition->id}}" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold red">
                                                <i class="fas fa-trash"></i>
                                            </a> --}}
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- Edit Modal --}}
                            <div class="modal fade bs-modal-md" id="edit{{$requisition->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('requisition.update',$requisition->id)}}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Stock</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Store</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control" name="store" id="store">
                                                                    <option value="" selected disabled>Select One</option>
                                                                    @foreach($stores as $store)
                                                                    <option value="{{ $store->id }}" {{$requisition->product_stores->store_id==$store->id?'selected':''}}>{{ $store->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Product</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control" name="product" id="item">
                                                                    <option value="" selected disabled>Select One</option>
                                                                    @foreach($products as $product)
                                                                        <option value="{{ $product->id }}" {{$requisition->product_stores->product_id==$product->id?'selected':''}}>(Code:{{$product->product_code}})-(Name:{{$product->name}})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Quantity</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="phone" id="quantity" name="quantity" value="{{$requisition->quantity}}" class="form-control" placeholder="Stock Quantity" min="0" step="1" oninput="validity.valid||(value='')" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Deadline (For Entry)</label>
                                                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                                    <input type="text"  name="date" class="form-control" value="{{$requisition->date}}">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn green btn-outline">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Modal Delete   --}}
                            <div class="modal fade bs-modal-md" id="delete{{$requisition->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('requisition.destroy', $requisition->id)}}" class="horizontal-form" method="POST">
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
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-close"></i> No</button>
                                                <button type="submit" class="btn blue btn-outline">Yes <i class="fa fa-check"></i></button>
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
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    {{-- Modal Add --}}
    <div class="modal fade bs-modal-md" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{ route('requisition.store') }}" class="horizontal-form" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                            <i class="fas fa-times font-red"></i>
                        </button>
                        <h4 class="modal-title">Requisition</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Store</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control" name="store" id="store">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Product</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control" name="product" id="item">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">(Code:{{$product->product_code}})-(Name:{{$product->name}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <span class="text-danger">*</span>
                                        <input type="phone" id="quantity" name="quantity" class="form-control" placeholder="Stock Quantity" min="0" step="1" oninput="validity.valid||(value='')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Deadline (For Entry)</label>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text"  name="date" class="form-control" readonly="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn green btn-outline">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
   
    
@endsection
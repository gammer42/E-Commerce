@extends('layouts.master')
@section('head')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('purchases') }}">Purchase</a>
        </li>
        <li class="active">Purchase Items</li>
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
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Purchase Items</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Purchase Item
                        </a>
                    </div> 
                </div>
                <div class="portlet-body">
                    
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>#SL.</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Purchase ID</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $i=>$item)
                            <tr class="odd gradeX text-center">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->purchases->invoice_no }}   (Add Date : {{$item->purchases->date}}) </td>
                                <td>({{ $item->products->product_code }}) {{ $item->products->name}}</td>
                                <form method="POST" action="">
                                    <td>
                                        <a href="#view" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold green">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-xs sbold blue" data-toggle="modal" href="#edit" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" href="#delete" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold red">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </form>    
                            </tr>

                            {{-- View Modal --}}
                            <div class="modal fade bs-modal-md" id="view" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times font-red"></i>
                                            </button>
                                            <h4 class="modal-title">Purchase Item Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <ul class="list-group borderless">
                                                        <li class="list-group-item"><b>Item Quantity : </b> </li>
                                                        <li class="list-group-item"><b>Item Price :</b>  &nbsp; &nbsp; &nbsp; &nbsp;</li>
                                                        <li class="list-group-item"><b>Purchase ID. :</b>   &nbsp; &nbsp; &nbsp; &nbsp;</li>
                                                        <li class="list-group-item"><b>Product Name :</b>   &nbsp; &nbsp; &nbsp; &nbsp;</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade bs-modal-md" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('purchase_item.update', $item->id) }}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Purchase Item</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Quantity</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="100" min="0" step="1" oninput="validity.valid||(value='{{ $item->quantity }}')" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Item Price</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="number" id="price" name="price" class="form-control" placeholder="5000" min="0" step="1" oninput="validity.valid||(value='{{ $item->price }}')" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Purchase ID.</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control" name="purchase_id" id="purchase_id">
                                                                    @foreach($purchases as $purchase)
                                                                    <option value="{{ $purchase->id }}">{{ $purchase->invoice_no }} ({{$purchase->date}} ) </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Product Name</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control" name="product_id" id="product_name">
                                                                    @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}">({{$product->product_code}} ) {{ $product->name }}</option>
                                                                    @endforeach
                                                                </select>
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
                            <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('purchase_item.destroy', $item->id) }}" class="horizontal-form" method="POST">
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
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    {{-- Modal Add --}}
    <div class="modal fade bs-modal-md" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{route('purchase_item.store')}}" class="horizontal-form" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                            <i class="fas fa-times font-red"></i>
                        </button>
                        <h4 class="modal-title">Purchase Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Purchase Item Quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Item Price</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" id="price" name="price" class="form-control" placeholder="Purchase Item Price" required>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Purchase ID.</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control" name="purchase_id" id="purchase_id">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($purchases as $purchase)
                                            <option value="{{$purchase->id}}">{{ $purchase->invoice_no }} ({{$purchase->date}} ) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Product Name</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control" name="product_id" id="product_name">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}">({{$product->product_code}} ) {{ $product->name }}</option>
                                            @endforeach
                                        </select>
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
   
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    
@endsection
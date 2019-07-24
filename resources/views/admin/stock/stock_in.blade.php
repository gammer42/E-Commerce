@extends('layouts.master')
@section('head')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li>
            <i class="fa fa-archive"></i>
            <a href="{{ route('stocks.index') }}">Stocks</a>
        </li>
        <li>
            <span class="active">Stock In</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fas fa-layer-group font-red"></i>
                        <span class="caption-subject bold uppercase">Stock In Lists</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="{{ route('stocks.create') }}" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Stock
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
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

                    <p id="show_value"></p>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>Serial</th>
                                <th>Invoice No</th>
                                <th>Product</th>
                                <th>Supplier</th>
                                <th>Quantity</th>
                                <th>Store</th>
                                <th>user</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $i=>$stock)
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td><b>{{$stock->purchaseItems->purchases->invoice_no}}</b>-({{$stock->purchaseItems->purchases->date}})</td>
                                <td><b>({{$stock->purchaseItems->products->product_code}})</b>-{{$stock->purchaseItems->products->name}}</td>
                                <td>{{$stock->purchaseItems->purchases->suppliers->supplier_name}}</td>
                                <td><b>{{$stock->quantity}}</b></td>
                                <td>{{$stock->stores->name}}</td>
                                <td>{{$stock->users->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="">
                                            <a href="#view{{$stock->id}}" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold green">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-xs sbold blue" data-toggle="modal" href="{{ route('stocks.edit', $stock->id) }}" data-backdrop="static" data-keyboard="false">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a data-toggle="modal" href="#delete{{$stock->id}}" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold red">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- View Modal --}}
                            <div class="modal fade bs-modal-md" id="view{{$stock->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times font-red"></i>
                                            </button>
                                            <h4 class="modal-title">Stock Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <ul class="list-group borderless">
                                                        <li class="list-group-item"><b>Invoice No :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->purchaseItems->purchases->invoice_no}} </li>
                                                        <li class="list-group-item"><b>Supplier Name :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->purchaseItems->purchases->suppliers->supplier_name}} </li>
                                                        <li class="list-group-item"><b>Purchase Date :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->purchaseItems->purchases->date}} </li>
                                                        <li class="list-group-item"><b>Store Name :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->stores->name}} </li>
                                                        <li class="list-group-item"><b>Product Code :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->purchaseItems->products->product_code}} </li>
                                                        <li class="list-group-item"><b>Product Name :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->purchaseItems->products->name}} </li>
                                                        <li class="list-group-item"><b>Stock Date :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->date}}</li>
                                                        <li class="list-group-item"><b>Stock Quantity :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->quantity}}&nbsp;<span style="font-size:12px !important;">{{$stock->purchaseItems->products->units->name}}</span></li>
                                                        <li class="list-group-item"><b>Stock Buy Price :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->buy_price}}&nbsp;৳</li>
                                                        <li class="list-group-item"><b>Stock Sale Price :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$stock->sell_price}}&nbsp;৳</li>
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
                            <div class="modal fade bs-modal-md" id="edit{{$stock->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('stocks.update',$stock->id)}}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Stock</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Quantity</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="phone" id="quantity" name="quantity" class="form-control" value="{{$stock->quantity}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Stock Date</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" class="form-control date-picker" id="date" name="date" value="{{$stock->date}}" required>
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Store Name</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control" name="store" id="store">
                                                                    @foreach($stores as $store)
                                                                    <option value="{{ $store->id }}" {{$stock->store_id==$store->id?'selected':''}}>{{ $store->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Purchase Item</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control" name="item" id="item">
                                                                    @foreach($purchase_item as $item)
                                                                    <option value="{{ $item->id }}" {{$stock->purchase_id==$item->id?'selected':''}}>(INV:{{ $item->purchases->invoice_no }})-(Q:{{$item->quantity}})-(P:{{$item->products->name}}) </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Buy Price</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="number" id="buy_price" name="buy_price" class="form-control" value="{{$stock->quantity}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Sell Price</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="number" id="sell_price" name="sell_price" class="form-control" value="{{$stock->quantity}}" required>
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
                            <div class="modal fade bs-modal-md" id="delete{{$stock->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('stocks.destroy',$stock->id)}}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title"><b>Delete this entry</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger">
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
            <form action="{{ route('stocks.store') }}" class="horizontal-form" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Stock</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
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
                                        <label class="control-label">Stock Date</label>
                                        <span class="text-danger">*</span>
                                        <input name="date" class="form-control date-picker" type = "text" id = "date">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Store Name</label>
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
                                        <label class="control-label">Purchase Item</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control" name="item" id="item">
                                            <option value="" selected>Select One</option>
                                            @foreach($purchase_item as $item)
                                                <option value="{{ $item->id }}">(INV:{{ $item->purchases->invoice_no }})-(Q:{{$item->quantity}})-(P:{{$item->products->name}}) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Buy Price</label>
                                        <span class="text-danger">*</span>
                                        <span id="add_buy_price"></span>
                                        <input type="number" id="default_buy_price" class="form-control" disabled >

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Sell Price</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" id="sell_price" name="sell_price" class="form-control" value="{{ old('sell_price') }}" >
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!--<script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>-->
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('#item').change(function() {
            var item_id = $(this).val();
            $('#default_buy_price').hide();
            $.ajax({
                type:'GET',
                url:"buy/"+item_id,
                data:{id:item_id},
                success:function(result){
                    var buy_price = result.search_price;
                    $('#add_buy_price').append('<input type="number" value="'+buy_price+'" name="buy_price" class="form-control">');
                }
            });
        });
    });
</script>
@endsection

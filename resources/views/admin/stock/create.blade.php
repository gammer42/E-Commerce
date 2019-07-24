@extends('layouts.master')

@section('head')
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('store.index')}}"></a>
        </li>
        <li class="active">&nbsp; Create Store</li>
    </ul>
    
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
           
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-cart font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Create New Store</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <!-- BEGIN FORM-->
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
                                                <label class="control-label">Stock Date</label>
                                                <span class="text-danger">*</span>
                                                <span id="date"></span>
                                                <input type="text" class="form-control" id="default_date">
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
                                                <label class="control-label">Quantity</label>
                                                <span class="text-danger">*</span>
                                                <span id="max_quantity"></span>
                                                <input type="number" id="default_quantity" class="form-control" placeholder="Stock Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Buy Price</label>
                                                <span class="text-danger">*</span>
                                                <span id="add_buy_price"></span>
                                                <input type="number" id="default_buy_price" class="form-control">
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
                                <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    
</div>

@section('script')
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script> --}}



<script>
    $(document).ready(function(){
        $('#item').change(function() {
            var item_id = $(this).val();
            $('#default_buy_price').hide();
            $('#default_quantity').hide();
            $('#default_date').hide();

            $.ajax({
                type:'GET',
                url:"buy/"+item_id,
                data:{id:item_id},

                success:function(result){
                    let buy_price = result.search_price;
                    let quantity = result.quantity;
                    let date = result.date;
                    var start = new Date(date);
                    var end = new Date();
                    countDays = (end- start) / (1000 * 60 * 60 * 24);
                    newDays = '-'+Math.round(countDays)+'d';

                    $('#add_buy_price').empty().append('<input type="number" value="'+buy_price+'" name="add_buy_price" class="form-control" readonly>');
                    $('#max_quantity').empty().append('<input type="number" id="quantity" value="'+quantity+'" name="quantity" class="form-control" max="'+quantity+'" min="1">');
                    $('#date').empty().append('<input type="text" name="date" class="form-control" id="end">');
                    
                    $('#end').datepicker({
                        format: 'dd/mm/yyyy',
                        todayHighlight: true,
                        autoclose: true,
                        startDate: newDays,
                        minDate: 0,

                    });
                }

             });
        });

    });

</script>

@endsection

@endsection

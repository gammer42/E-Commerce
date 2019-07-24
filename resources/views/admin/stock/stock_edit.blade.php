@extends('layouts.master')
@section('head')
<script>
    $(document).ready(function(){
        $('#item').change(function() {
            var item_id = $(this).val();
            $('#default_buy_price').hide();
            $('#default_buy_price').prop( "disabled", true );

            $.ajax({
                type:'GET',
                url:"{{ url('stocks/buy') }}/"+item_id,
                data:{id:item_id},

                success:function(result){
                    var buy_price = result.search_price;
                    $('#append_price').empty().append('<input type="number" value="'+buy_price+'" name="buy_price" class="form-control">');

                }

             });
        });

    });

</script>
@endsection

@section('content')

<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('stocks.index') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Stock</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- <h3 class="page-title">Edit Stock
        <small>dashboard & statistics</small>
    </h3> -->



    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">


                <div class="portlet-body">


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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-cart font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Edit Stock Info</span>
                                </div>
                            </div>
                            <!-- BEGIN FORM-->
                            <form action="{{ route('stocks.update', $stock->id) }}" class="horizontal-form" method="POST">
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
                                                            <option value="{{ $item->id }}" {{$stock->purchase_id = $item->id ? 'selected':''}}>(INV:{{ $item->purchases->invoice_no }})-(Q:{{$item->quantity}})-(P:{{$item->products->name}}) </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Buy Price</label>
                                                            <span class="text-danger">*</span>
                                                            <span id="append_price"></span>
                                                            <input type="text" id="default_buy_price" name="buy_price" class="form-control" value="{{$stock->buy_price}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Sell Price</label>
                                                            <span class="text-danger">*</span>


                                                            <input type="number" id="sell_price" name="sell_price" class="form-control" value="{{$stock->sell_price}}" required>
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
                    </div>               <!-- END FORM-->
                </div>
            </div>
                            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>

@section('script')

@endsection

@endsection

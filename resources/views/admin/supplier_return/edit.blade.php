@extends('layouts.master')

@section('head')
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('supplier.index')}}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <span class="active">&nbsp; Edit Supplier Return</span>
            </li>
        </ul>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- <h3 class="page-title">Edit Supplier Return
        <small>dashboard & statistics</small>
    </h3> -->
    <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-cart font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Edit Supplier Return</span>
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
                    <form method="post" action="{{route('supplier_return.update', $supplier_return->id)}}" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Supplier Return
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="radio" name="supplier_returns" value="1"{{ $supplier_return->supplier_returns == 1? "checked":"" }} >Yes
                                                        <input type="radio" name="supplier_returns" value="0"{{ $supplier_return->supplier_returns == 0? "checked":"" }}>No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="{{ route('supplier_return.index') }}" type="button" class="btn grey-salsa btn-outline">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                                    <!-- END FORM-->
                </div>
            </div>
                            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $('#supplier_id').change(function() {
                $("#supplier_id  option:selected").each(function (){
                    var item_id = $(this).val();
                    $.ajax({
                        type:'GET',
                        url:"{{ url('supplier/purchase') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                        let options;
                        $.each( result.store, function( key, value ) {
                            options =options +'<option value="'+value.id+'">'+value.invoice_no+'</option>';
                            $("#purchase_id").empty().append('<option selected disabled>Select Invoice No</option>'+options);
                        });
                        }
                    });
                });
            });
        });

    </script>
    <script>
        $(document).ready(function(){
            $('#purchase_id').change(function() {
                $("#purchase_id  option:selected").each(function (){
                    var item_id = $(this).val();
                    $.ajax({
                        type:'GET',
                        url:"{{ url('purchase/purchase_item') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                        let options;
                        $.each( result.purchase_item, function( key, value ) {
                            $.each( result.invoice, function( key, value1 ){

                                console.log(value1);
                                console.log(value.name);
                                options =options +'<option value="'+value.id+'">(PC:'+value.name+')--(INV:'+value1+')</option>';
                            });
                            $("#purchase_item_id").empty().append('<option selected disabled>Select Product</option>'+options);
                        });
                        }
                    });
                });
            });
        });

    </script>
@endsection

@extends('layouts.master')
@section('head')
    <link href="{{ asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('promotion.index')}}">Promotion Management</a>
        </li>
        <li class="active">Add New Promotion</li>
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
                        <span class="caption-subject bold uppercase">Add New Promotion</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{route('promotion.store')}}" class="horizontal-form" method="POST">
                        @csrf
                        
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="type">Promotion Type</label>
                                        <span class="text-danger">*</span>
                                        <select name="promotion_type" id="type" class="form-control" required>
                                            <option selected disabled>Select One</option>
                                            <option value="1">Promotion on Product</option>
                                            <option value="2">Promotion on Purchase</option>
                                            <option value="3">Promotion on Card</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="minPurchase">
                                        <label class="control-label" for="amount">Min Purchase Amount</label>
                                        <span class="text-danger" id="min_purchase_span"></span>
                                        <input type="text" id="min_purchase" name="min_purchase" class="form-control" placeholder="Min Purchase Amount" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="title">Title</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" id="title" name="title" class="form-control" id="title" placeholder="Promotion Title" required>
                                    </div>
                                </div>
                                
                            </div>    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="status">Status</label>
                                        <span class="text-danger">*</span>
                                        <select name="status" id="status" class="form-control" required>
                                            <option disabled selected>Select One</option>
                                            <option value="1">active</option>
                                            <option value="2">inactive</option>
                                            <option value="3">pending</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="discount">Discount Type</label>
                                        <span class="text-danger">*</span>
                                        <select name="discount" onchange="discount_type(this.value);" id="discount" class="form-control" required>
                                            <option value="" selected disabled>Select One</option>
                                            <option value="1">Parcent (%)</option></a>
                                            <option value="2">Currency (৳)</option></a>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="amount">Discount Amount (৳ / %)</label>
                                        <input type="number" id="amount" name="amount" class="form-control" placeholder="BDT(৳)/Parcentage(%)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="from_date">From (Date)</label>
                                                <div class="input-group date date-picker">
                                                    <input type="text" name="from_date" class="form-control" id="from_date" placeholder="Promotion Start Date" required>
                                                    <span class="input-group-btn">
                                                        <button class="btn default date-set" type="button">
                                                            <i class="fa fa-calendar font-blue"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="to_date">To (Date)</label>
                                                <div class="input-group date date-picker">
                                                    <input type="text" name="to_date" class="form-control" id="to_date" placeholder="Promotion End Date" required>
                                                    <span class="input-group-btn">
                                                        <button class="btn default date-set" type="button">
                                                            <i class="fa fa-calendar font-red"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="description">Promotion Description</label>
                                                <span class="text-danger">*</span>
                                                <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="my_multi_select1">Store Name</label>
                                        <span class="text-danger">*</span>
                                        <select name="store[]" multiple="multiple" id="my_multi_select1" class="multi-select" style="width:100% !important">
                                            <option disabled selected>Selected Stores</option>
                                            <option disabled>Available Stores</option>
                                            @foreach($stores as $store)
                                            <option value="{{ $store->id }}"> {{ $store->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="promotionRadio" style="display:none">
                                
                                <div class="col-md-4">
                                    <label class="control-label font-red">Promotion On</label>
                                </div>
                                <div class="col-md-8" style="margin-top:6px">
                                    <div class="radio-group">
                                        <label class="radio-inline"><input type="radio" name="promotion_on" onclick="getProID('1')" checked>Cat/SubCat</label>
                                        <label class="radio-inline"><input type="radio" name="promotion_on" onclick="getProID('2')">Brand</label>
                                        <label class="radio-inline"><input type="radio" name="promotion_on" onclick="getProID('3')">Both</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row" id="promotionRow">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="category">Parent Category</label>
                                        <select name="category" id="category" class="form-control select2" required>
                                            <option disabled selected>Parent Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" data-name="{{ $category->name }}" id="category_op{{ $category->id }}"> {{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="sub_category">
                                        <label class="control-label" for="subCat">Sub Category</label>
                                        <select name="subCat" id="subCat" class="form-control select2" required>
                                            <option disabled selected>First Select Category</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="brand">Brand</label>
                                        <select name="brand" id="brand" class="form-control select2" disabled required>
                                            <option disabled selected>Select Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" data-name="{{ $brand->name }}" id="brand_op{{ $brand->id }}"> {{ $brand->name }} </option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-sm sbold blue" id="promotionBtn" style="margin-top:33px">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                                <div class="col-md-12" id="promotionTable" style="display:none">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Sub Catgory</th>
                                                <th>Brand Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableContent">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                 
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn red btn-outline">Submit</button>
                                </div>
                            </div>

                        </div>
                        
                    </form>    
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
@endsection
@section('script')

    <script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/components-multi-select.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        function discount_type(id){
            if(id==1){
                $('#amount').attr({
                    "max":100,
                    "min":1
                });
                $('#amount2').attr({
                    "max":100,
                    "min":1
                });
            }
            if(id==2){
                $('#amount').attr({"min":1});
                $('#amount2').attr({"min":1});
                $('#amount').removeAttr('max');
                $('#amount2').removeAttr('max');
            }
        }
    </script>
    <script>
        $("#type").change(function () {
            $("#type option:selected").each(function () {
                if($(this).val() == "2") {
                    $('#min_purchase').attr('disabled', false);
                    $('#min_purchase_span').html('*');
                    $('#promotionRow').css('display','none');
                    $('#promotionRadio').css('display','none');
                }else if($(this).val() == "1") {
                    $('#min_purchase').attr('disabled', true);
                    $('#promotionRow').css('display','block');
                    $('#promotionRadio').css('display','block');
                }else if($(this).val() == "3") {
                    $('#min_purchase').attr('disabled', true);
                    $('#promotionRow').css('display','none');
                    $('#promotionRadio').css('display','none');
                }
            });
        });
    </script>

    <script type="text/javascript">
        function emultistoreselect(id){
            $('#edit_store_select'+id).multiSelect();
        }
        function multistoreselect(){
            $('#store-select').multiSelect();
        }
    </script>

    <script>
        $(document).ready(function(){
            $('#category').change(function() {
                $("#category option:selected").each(function (){
                    var cat_id = $(this).val();
                    $('#sub_category').html(`<label class="control-label" for="subCat">Sub Category</label>
                                            <select name="subCat" id="subCat" class="form-control select2">
                                               
                                            </select>`);
                    $.ajax({
                        type:'GET',
                        url:"{{ url('sub/category') }}/"+cat_id,
                        data:{id:cat_id},

                        success:function(result){
                            var options;
                           
                            $.each( result.category, function( key, value ) {
                                options = options +'<option value="'+value.id+'" data-name="'+value.name+'" id="op'+value.id+'">'+value.name+'</option>';
                                $("#subCat").empty().append(`<option disabled selected>Select Sub Category</option>`+options);
                            });
                        }

                    });
                });
            });
        });
    </script>
    <script type="text/javascript">
        function getProID(id){
            if(id == 1){
                $("#category, #subCat").attr('disabled', false);
                $("#brand").select2("val", "");
                $("#brand").attr('disabled', true);
            }
            else if(id == 2){
                $("#brand").attr('disabled', false);
                $('#category, #subCat').val('');
                $("#category, #subCat").attr('disabled', true);
            
            }
            else if(id == 3){
                $("#brand, #category, #subCat").attr('disabled', false);
            }
        }
    </script>

    <script>
        $(document).ready(function(){
           
            $("#promotionBtn").click(function () {
                var brand_id = $('#brand').val();
                var brand = $('#brand_op'+brand_id).data('name');

                var category_id = $('#category').val();
                var category = $('#category_op'+category_id).data('name');

                var subCat_id = $('#subCat').val();
                var subCat = $('#op'+subCat_id).data('name');

                if(brand_id == null)
                {
                    var brand = '';
                }
                if(category_id == null)
                {
                    var category = '';
                }
                if(subCat_id == null)
                {
                    var subCat = '';
                }

                $("#promotionTable").css('display','block');
                $("#tableContent").append(`<tr>
                                            <td>
                                                `+category+`
                                                <input type="hidden" name="category[]" value="`+category_id+`">
                                            </td>
                                            <td>
                                                `+subCat+`
                                                <input type="hidden" name="subCats[]" value="`+subCat_id+`">
                                            </td>
                                            <td>
                                                `+brand+`
                                                <input type="hidden" name="brand[]" value="`+brand_id+`">
                                            </td>
                                            <td>
                                                <a class="btn btn-sm sbold red" id="removeBtn">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>`);
                
            });
            $(document).on('click', '#removeBtn', function(){  
                $(this).parents('tr').remove();
            });  
        });
    </script>

   
@endsection
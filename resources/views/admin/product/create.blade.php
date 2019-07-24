@extends('layouts.master')
@section('head')

    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<?php use Illuminate\Support\Facades\URL; ?>
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('products.index') }}">Products</a>
        </li>
        <li class="active">Add New Product</li>
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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Add New Product</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{route('products.store')}}" class="horizontal-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="code">Product Code</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="code" name="product_code" class="form-control" data-required="1" placeholder="Product Code" required> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Product Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="name" class="form-control" data-required="1" placeholder="Product Name" required> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="buy_price">Buy Price</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="buy_price" name="buy_price" class="form-control" data-required="1"  placeholder="Buying Price" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="sell_price">Sell Price</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="sell_price" name="sell_price" class="form-control" data-required="1"  placeholder="Selling Price" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="minimum_stock">Min. Stock</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="minimum_stock" name="minimum_stock" class="form-control" data-required="1" placeholder="Minimum Stock Amount" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="is_vatable">Is Vatable</label>
                                    <span class="font-red">*</span>
                                    <div class="radio-group">
                                        <label class="radio-inline"><input type="radio" name="is_vatable" value="1" checked>Yes</label>
                                        <label class="radio-inline"><input type="radio" name="is_vatable" value="0">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- .row --}}

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" name="category_id" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Brand</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" name="brand_id" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Unit</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" name="unit_id" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
                                    <span class="font-red">*</span>
                                    <select class="form-control" name="supplier_id" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label" for="description">Product Description</label>
                                    <span class="font-red">*</span>
                                    <textarea name="description" id="description" rows="10" class="form-control" placeholder="Product Description" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="image">Product Image</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                            <img src="https://via.placeholder.com/200x200.png" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="image" id="iamge" accept="image/*"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="productTable">  
                                    <tr>
                                        <th style="width:45%">Attribute Name</th>
                                        <th style="width:45%">Attribute Value</th>
                                        <th style="width:10%" class="text-center">
                                            <button type="button" name="add" id="addProduct" class="btn sbold green">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                    <tr>  
                                        <td><input type="text" name="att_name[]" placeholder="Enter your attribute name" class="form-control" required></td>  
                                        <td><input type="text" name="att_value[]" placeholder="Enter your attribute value" class="form-control" required></td>  
                                        <td class="text-center"></td>  
                                    </tr> 
                                </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="reset" class="btn red btn-outline">Reset</button>
                                <button type="submit" class="btn blue btn-outline">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">           
        $("#addProduct").click(function(){
            $("#productTable").append('<tr><td><input type="text" name="att_name[]" placeholder="Enter your attribute name" class="form-control" required></td><td><input type="text" name="att_value[]" placeholder="Enter your attribute value" class="form-control" required></td><td class="text-center"><button type="button" class="btn btn-danger remove-product-tr"><i class="fas fa-times"></i></button></td></tr>');
        });
       
        $(document).on('click', '.remove-product-tr', function(){  
            $(this).parents('tr').remove();
        });  
    </script>
@endsection

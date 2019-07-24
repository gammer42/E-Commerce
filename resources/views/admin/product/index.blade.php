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
        <li class="active">Products</li>
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
                        <span class="caption-subject bold uppercase">List Of Products</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{route('products.create')}}" class="btn sbold red"> Add New Product
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Image</th>
                                <th style="width:10%">Actions</th>
                            </tr>
                           
                        </thead>
                        <tbody>
                        @foreach ($products as $i=>$product)  
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brands->name }}</td>
                                <td><img src="{{Url::to('storage/images/product/image/'.$product->img) }}" alt="product image" style="height:50px; width:50px; margin:0 auto; display:block"></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#view{{ $product->id }}" class="btn btn-xs sbold green" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-xs sbold blue">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a href="#delete{{ $product->id }}" class="btn btn-xs sbold red" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                           
                            {{-- View Modal   --}}
                            <div class="modal fade bs-modal-lg" id="view{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times font-red"></i>
                                            </button>
                                            <h4 class="modal-title">Product Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{Url::to('storage/images/product/image/'.$product->img ) }}" alt="" class="img-responsive profile-square">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Product Code</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->product_code }}</p>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Product Name</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->name }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Buy Price</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->buy_price }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Sell Price</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->sell_price }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Is Vatable</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{$product->is_vatable == 1? 'Yes':'No'}}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Minimum Stock</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->minimum_stock }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Product Category</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->category->name }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Product Brand</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->brands->name }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Product Unit</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->units->name }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p><b>Product Description</b></p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $product->description }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>{{-- /.col-md-8 --}}
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title text-center">Product Attributes</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            @foreach ($product->attributes as $attribute)
                                                                <div class="col-md-4">
                                                                    <div class="col-md-5">
                                                                        <p> {{ $attribute->name }}</p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $attribute->value }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>{{-- /.row --}}
                                        </div> {{-- /.panel-body --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                           
                             {{-- Delete Modal   --}}
                             <div class="modal fade bs-modal-md" id="delete{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('products.destroy', $product->id )}}" class="horizontal-form" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times"></i>
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
</div>

{{-- Add Modal --}}
<div class="modal fade bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('products.store')}}" class="horizontal-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><b>Product Add</b></h4>
                </div>
                <div class="modal-body">
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
                                        <th class="text-center">Attribute Name</th>
                                        <th class="text-center">Attribute Value</th>
                                        <th class="text-center"><button type="button" name="add" id="addProduct" class="btn btn-success">Add More</button></th>
                                    </tr>
                                    <tr>  
                                        <td><input type="text" name="att_name[]" placeholder="Enter your attribute name" class="form-control" /></td>  
                                        <td><input type="text" name="att_value[]" placeholder="Enter your attribute value" class="form-control" /></td>  
                                        <td></td>  
                                    </tr> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
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
        $(".addRow").click(function(){
            var id = jQuery(this).attr('value');
            var row ='<div class="rTableRow"><div class="rTableCell text-center"><input type="text" name="new_name[]" class="form-control" placeholder="Enter your attribute Name"></div><div class="rTableCell text-center"><input type="text" name="new_value[]" class="form-control" placeholder="Enter your attribute value"></div><div class="rTableCell text-center"><button type="button" id="romoveCell" class="btn btn-danger remove-cell">Remove</button></div></div>';
            $("#editTable"+id).append(row);
        });

        $(document).on('click', '.remove-cell', function(){  
            $(this).parents('.rTableRow').remove();
        });  
    </script>
    
    <script type="text/javascript">           
        $("#addProduct").click(function(){
            $("#productTable").append('<tr><td><input type="text" name="att_name[]" placeholder="Enter your attribute name" class="form-control"></td><td><input type="text" name="att_value[]" placeholder="Enter your attribute value" class="form-control"></td><td class="text-center"><button type="button" class="btn btn-danger remove-product-tr">Remove</button></td></tr>');
        });
       
        $(document).on('click', '.remove-product-tr', function(){  
            $(this).parents('tr').remove();
        });  
    </script>
@endsection
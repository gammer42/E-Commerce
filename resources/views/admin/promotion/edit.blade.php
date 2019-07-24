@extends('layouts.master')

@section('content')

<div class="page-content">
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Dashboard</span>
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
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- <h3 class="page-title">Add Brand's Info
        <small>dashboard & statistics</small>
    </h3> -->



    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Add Product</span>
                    </div>
                    <!-- <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                        </div> -->
                </div>
                
                
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
                    <!-- BEGIN FORM-->
                    <form method="post" action="{{route('products.update', $product->id)}}" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-body">
                            <!-- <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                            </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Product Code
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="product_code" data-required="1" class="form-control" value="{{$product->product_code}}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Product Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="name" data-required="1" class="form-control" value="{{$product->name}}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Buy Price
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="buy_price" data-required="1" class="form-control" value="{{$product->buy_price}}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Sell Price
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="sell_price" data-required="1" class="form-control" value="{{$product->sell_price}}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Is Vatable
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="radio" name="is_vatable" value="1" checked>Yes
                                    <input type="radio" name="is_vatable" value="0">No
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Min Stock
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="minimum_stock" data-required="1" class="form-control" value="{{$product->minimum_stock}}"/> 
                                </div>        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Product Logo</label>
                                <div class="col-md-4">
                                    <input name="image" type="file" class="form-control" /> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Category
                                    
                                </label>
                                <div class="col-md-4">
                                <select class="select category" name="category_id">
                                        <option selected value="">Select product category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach    
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                    <label class="control-label col-md-3">Brand
                                        
                                    </label>
                                    <div class="col-md-4">
                                    <select class="select category" name="brand_id">
                                            <option selected value="">Select brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach    
                                    </select>
                                </div>            
                            </div>

                            <div class="form-group">
                                    <label class="control-label col-md-3">Unit
                                        
                                    </label>
                                    <div class="col-md-4">
                                    <select class="select category" name="unit_id">
                                            <option selected value="">Select unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach    
                                    </select>
                                </div>            
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" rows="5" name="description" value="{{$product->description}}"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn grey-salsa btn-outline">Cancel</button>
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

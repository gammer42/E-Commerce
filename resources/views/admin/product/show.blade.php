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
                        <span class="caption-subject font-red sbold uppercase">View Product</span>
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
                
                      <div class="row">
                        <div class="col-md-offset-9 col-md-3">
                          <a class="btn btn-info" href="{{url('/products')}}">Home</a>
                          <a class="btn btn-success" href="{{ route('products.edit',$product->id)}}">Edit</a>
                          <a class="btn btn-warning" href="{{ URL::previous() }}">Back</a>
                        </div>
                      </div>
                      <br>
                      
                    
                      <div class="row" style="padding-left:10px;">
                          <div class="col-md-3">
                              <label for="">Product Code:</label>
                          </div>
                          <div class="col-md-3">{{$product->product_code}}</div>
                          <div class="col-md-3">
                              <label for="">Product Name:</label>
                          </div>
                          <div class="col-md-3">{{$product->name}}</div>
                      </div>
                      <br>

                      

                      <div class="row" style="padding-left:10px;">
                          <div class="col-md-2">
                              <label for="">Buy Price</label>
                            </div>
                            <label class="col-md-1">:</label>
                          <div class="col-md-3">{{$product->buy_price}}</div>
                          <div class="col-md-3">
                              <label for="">Sell Price:</label>
                          </div>
                          <div class="col-md-3">{{$product->sell_price}}</div>
                      </div>
                      <br>

                      
                      <div class="row" style="padding-left:10px;">
                          <div class="col-md-3">
                              <label for="">Is Vatable:</label>
                          </div>
                          <div class="col-md-3">{{$product->is_vatable == 1? 'Yes':'No'}}</div>
                          <div class="col-md-3">
                              <label for="">Minimum Stock:</label>
                          </div>
                          <div class="col-md-3">{{$product->minimum_stock}}</div>
                      </div>
                      <br>

                      <div class="row" style="padding-left:10px;">
                          <div class="col-md-3">
                              <label for="">Product Image:</label>
                          </div>
                          <div class="col-md-3">
                              <img src="{{ URL::to('storage/images/product/image'.$product->img) }}" alt="fgcvbcbc" style="height:50px; width:50px;">
                          </div>

                          <div class="col-md-3">
                              <label for="">Product Category:</label>
                          </div>
                          <div class="col-md-3">{{$product->category->name}}</div>
                      </div>
                      <br>

                      <div class="row" style="padding-left:10px;">
                          <div class="col-md-3">
                              <label for="">Product Brand:</label>
                          </div>
                          <div class="col-md-3">{{$product->brand->name}}</div>

                          <div class="col-md-3">
                              <label for="">Product Unit:</label>
                          </div>
                          <div class="col-md-3">{{$product->unit->name}}</div>
                      </div>
                      <br>

                      <div class="row" style="padding-left:10px;">
                          <div class="col-md-3">
                              <label for="">Product Description:</label>
                          </div>
                          <div class="col-md-3">{{$product->description}}</div>
                      </div><br>

                      <div class="row" style="padding-left:10px;">
                        <div class="col-md-2">
                            <label for="">Product Attribute</label><br>
                        </div>
                        <div class="col-md-1">
                                <label for="">:</label><br>
                        </div>
                        <div class="col-md-3">
                                @foreach($product->attributes as $attribute)
                                <label for="">{{$attribute->name}}:{{$attribute->value}}</label><br>
                                @endforeach
                        </div>
                      </div> 
                       

                        
                        
                    </div>
                      
                      <br><br>
                    
                    <!-- BEGIN FORM-->
                    
                </div>
                            <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
</div>

@endsection

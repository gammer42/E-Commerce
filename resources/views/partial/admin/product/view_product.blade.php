@extends('user')

@section('dashboard')


    @include('admin.partial.admin_navbar')
    <div class="container-fluid-full">
        <div class="row-fluid">
            @include('admin.partial.sidebar_left')
            <div id="content" class="span10">

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="home">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Products</a></li>
                </ul>

                <div class="row-fluid sortable">
                    <div class="box span12">
                        <div style="height: 35px;" class="box-header" data-original-title>
                            <h2><i class="halflings-icon user"></i><span class="break"></span>All Products</h2>
                            <p style="text-align:center; padding-right:300px;"class="alert-success">
                                <?php
                                $message = Session::get('message');
                                if($message){
                                    echo $message;
                                    Session::put('message',NULL);
                                }?>
                            </p>
                        </div>
                        <div class="box-content">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th >Category Name</th>
                                    <th>Brands Name</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                    <th style="">Color</th>
                                    <th style="">Size</th>
                                    <th style="">Price</th>
                                    <th>Slider</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <?php foreach($all_publish_product as $view_product){
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td>{!!$view_product->id!!}</td>
                                        <td class="center"style="width:120px;">{!!$view_product->product_name!!}</td>
                                        <td class="center" style="width:100px;">{!!$view_product->category_name!!}</td>
                                        <td class="center">{!!$view_product->manufacture_name!!}</td>
                                        <td class="center">{!!$view_product->stock!!}</td>
                                        <td><img src="{{URL::to('/img/'.$view_product->product_image)}}" style="width:80px;"></td>
                                        <td class="center">{!!$view_product->product_color!!}</td>
                                        <td class="center">{!!$view_product->product_size!!}</td>
                                        <td class="center">{!!$view_product->product_price!!}</td>
                                        <td class="center">
                                            @if($view_product->slider_status==1)
                                                <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Deactivate Slider" href="{{route('deactivate_slider',[$view_product->id])}}">
                                                    <i class="halflings-icon white fas fa-eye-slash"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Activate Slider" href="{{route('activate_slider',[$view_product->id])}}">
                                                    <i class="halflings-icon white fas fa-eye"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="center">
                                            @if($view_product->product_status==1)
                                                <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Deactivate Product" href="{{route('deactivate_product',[$view_product->id])}}">
                                                    <i class="halflings-icon white thumbs-down"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Activate Product" href="{{route('activate_product',[$view_product->id])}}">
                                                    <i class="halflings-icon white thumbs-up"></i>
                                                </a>
                                            @endif

                                            <a class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Edit Product" href="{{route('edit_product',[$view_product->id])}}">
                                                <i class="halflings-icon white edit"></i>
                                            </a>
                                            <a class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete Product" href="{{route('delete_product',[$view_product->id])}}" id="delete">
                                                <i class="halflings-icon white trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div><!--/span-->

                </div><!--/row-->
            </div>
        </div>
    </div>

@endsection
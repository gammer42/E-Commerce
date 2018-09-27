@extends('user')


@section('content')
<?php $user = Session::get('user');
$id = Session::get('customer_id');
?>
<section id="cart_items">
    <div class="container ">
        <ul><li class="dropdown">
        @if($user)
             <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><h2>Welcome  {{$user}}</h2>
             </a>
        <ul class="dropdown-menu">
            <li class="dropdown-menu-title">

            </li>
            <li style="position: static;"><a href="{{Route('logout')}}"><i class="halflings-icon off"></i>Purchase from another Account?</a></li>
        </ul>
        @else
        <span>Already registered? Please....</span><a id="log" class="btn btn-primary" >Continue</a> <b>OR</b><span></span><a id="reg" class="btn btn-primary" >Register</a>
        <div class="shopper-info" id="log" style="display:none;">
            <form action="{{Route('log_check')}}" method="post" enctype="multipart/form-data">
                @csrf
                <level><input type="text" name="c_email" placeholder="Email or Username" /></level>
                <level><input type="password" name="c_password" placeholder="Password"/></level>
                <level><button type="submit" class="btn btn-primary">Login</button></level>
            </form>
        </div>
        @endif
        </li></ul>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{Route('home')}}">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="table-responsive cart_info" id="reg">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" style="width:120px;">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php $contents = Cart::content(); ?>
                @foreach($contents as $cart_product)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{url('/img').'/'.$cart_product->options->image}}" style="width:80px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart_product->name}}</a></h4>
                            <p>Product ID: {{$cart_product->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>Tk {{$cart_product->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{Route('update_cart')}}" method="post">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="qty" value="{{$cart_product->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" name="rowId" value="{{$cart_product->rowId}}">
                                    <input type="submit" name="submit" value="Update" class="btn btn-sm btn-default">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$cart_product->total}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{Route('delete',[$cart_product->rowId])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="shopper-informations">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-sm-3">
                @if($id)
                    <h3>Information</h3><br/>
                    <p>You are buying this product as <span style="color:blue"><b>{{$user}}</b></span>.</p>
                @else
                    <div class="shopper-info" id="reg show" style="display:none">
                        <p>Shopper Information</p>

                        <form action="{{Route('newcustomer')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="first_name" title="First Name" placeholder="First Name"/>
                            <input type="text" name="last_name" title="Last Name"  placeholder="Last Name"/>
                            <input type="text" name="username" title="User name"  placeholder="User name"/>
                            <input type="email" name="c_email" title="Email Address"  placeholder="Email Address"/>
                            <input type="password" name="c_password" title="Password"  placeholder="Password"/>
                            <input type="text" name="phone" title="Your phone Number"  placeholder="Phone"/>
                            <a id="show"  class="btn btn-primary" ><button type="submit" class="btn btn-default" title="Signup" >Signup</button></a>
                        </form>
                    </div>
                    @endif
                    <div class="login-form" id="log2" style="display:none"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{Route('log_check')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="c_email" placeholder="Email or Username" />
                            <input type="text" name="c_password" placeholder="Password" />
                            <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                            </span>
                            {{--<span>Don't have account???  </span><a id="reg" class="btn btn-primary" >Register</a>--}}
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one" style="width:90%;@if(!$id) opacity:0.4; @endif">
                            <form action="{{Route('save_shipping_address')}}" method="post">
                                @csrf
                                <input type="text" name="s_first_name" placeholder="First Name *">
                                <input type="text" name="s_last_name"  placeholder="Last Name *">
                                <input type="text" name="s_phone_no"  placeholder="Phone">
                                <input type="email" name="s_email"  placeholder="Email">
                                <input type="text" name="s_address"  placeholder="Address">
                                <input type="hidden" name="customer_id"  value="{{$id}}">
                                @if($id)<button class="btn btn-default" type="submit">Ready</button>
                            </form>
                        @else
                            <span style="color:red;">You have to login first!!!</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class=" table-responsive cart_info">
                        <table style="border:5px ;" class="table table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>Cart Sub Total</td>
                                                <td>Tk {{Cart::subtotal()}}</td>
                                            </tr>
                                            <tr>
                                                <td>Exo Tax</td>
                                                <td>Tk {{Cart::tax()}}</td>
                                            </tr>
                                            <tr class="shipping-cost">
                                                <td>Shipping Cost</td>
                                                <td>Free</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><span>Tk {{Cart::total()}}</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive cart_info" id="reg" style="display:none" >
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" style="width:120px;">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php $contents = Cart::content(); ?>
                @foreach($contents as $cart_product)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{url('/img').'/'.$cart_product->options->image}}" style="width:80px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart_product->name}}</a></h4>
                            <p>Product ID: {{$cart_product->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>Tk {{$cart_product->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{Route('update_cart')}}" method="post">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="qty" value="{{$cart_product->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" name="rowId" value="{{$cart_product->rowId}}">
                                    <input type="submit" name="submit" value="Update" class="btn btn-sm btn-default">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$cart_product->total}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{Route('delete',[$cart_product->rowId])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
	</section> <!--/#cart_items-->

@endsection

{{--<form href="{{Route('save_shipping_address')}}" method="post">--}}
{{--<div class="shopper-informations">--}}
{{--<div class="row">--}}
{{--<div class="col-sm-5 clearfix">--}}
{{--<div class="bill-to">--}}
{{--<p>Bill To</p>--}}
{{--<div class="form-one">--}}
{{--<form>--}}
{{--<input type="text" name="s_first_name" placeholder="First Name *">--}}
{{--<input type="text" name="s_last_name"  placeholder="Last Name *">--}}
{{--<input type="text" name="s_phone_no"  placeholder="Phone">--}}
{{--<input type="email" name="s_email"  placeholder="Email">--}}
{{--<input type="text" name="s_address"  placeholder="Address">--}}
{{--<input type="hidden" name="customer_id" value="{{Session::get('customer_id')}}">--}}
{{--<button class="btn btn-default" id="" type="submit">Ready</button>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{----}}
{{--</div>--}}
{{--</div>--}}
	
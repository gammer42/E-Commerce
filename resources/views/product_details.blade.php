@extends('user')


@section('content')	

    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
                    @include('ext.partial.leftsidebar')
				</div>
                <?php foreach($product_detail as $details){ ?>
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
							 <img src="{{URL::to('/img/'.$details->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								{{--<img src="{{URL::to('ecom/images/product-details/new.jpg')}}" class="newarrival" alt="" />--}}
								<h2>{{strtoupper($details->product_name)}}</h2>
								<p>Color:  {{$details->product_color}}</p>
								<span>
                                        <span>{{$details->product_price}} Tk</span>
                                    <form action="{{Route('add_to_cart',[$details->id])}}" method="post">
                                       @csrf
                                        <label>Quantity:</label>
                                        <input name="quantity" type="text" value="1" /><br>
                                        <input name="customer_id" type="hidden" value="{{Session::get('customer_id')}}" />
                                        <input name="product_id" type="hidden" value="{{$details->id}}" /><br>
										<h2 style="color:red;"><?php
                                            $stock1 = Session::get('stock1');
                                            $stock2 = Session::get('stock2');
                                            $stock3 = Session::get('stock3');
                                            if($stock1)
                                                if($stock2)
                                                    if($stock3){
                                                        echo $stock1,$stock2,$stock3;
                                                        Session::put('stock1',null);
                                                        Session::put('stock2',null);
                                                        Session::put('stock3',null);
                                                    } ?></h2>
                                        <button type="submit" class="btn btn-fefault cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    </form>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b>{{$details->manufacture_name}}</p>
                                <br><img src="{{URL::to('ecom/images/product-details/rating.png')}}" alt="" /><br>
								<a href=""><img src="{{URL::to('ecom/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
				<!--/category-tab-->
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<h2>Details</h2>
								<p><span>		</span>	{{$details->product_description}}</p>
							</div>
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{URL::to('ecom/images/home/gallery1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{URL::to('ecom/images/home/gallery1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
										exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
										dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>

									<form action="#" style="background-color:white;">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="{{URL::to('ecom/images/product-details/rating.png')}}" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>

						</div>
					</div>
				<!--/recommended_items-->
				@include('ext.partial.recommended')
			</div>
		<?php } ?>
		</div>
	</div>
</section>
@endsection
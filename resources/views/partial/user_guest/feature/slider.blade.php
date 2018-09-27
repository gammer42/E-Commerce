<?php  $slider_product = DB::table('category_tbls')->join('products','products.category_id','=','category_tbls.id')
    ->where('products.product_status', 1)->where('products.slider_status',1)->orderBy('products.id','DESC')->get();
?>
<div class="container" style="background-color:#f6f6f6;">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="<?php $active = 'active'; echo $active; ?>"></li>
                            <?php foreach($slider_product as $view_product) { ?>
							<li data-target="#slider-carousel" data-slide-to="<?php echo $view_product->id ?>"></li>
							<?php } ?>
						</ol>
						
						<div class="carousel-inner">
							 <?php foreach($slider_product as $view_product){ ?>
							<div class="item <?php echo $active; ?>">
								<div class="col-sm-6">
									<h1><span>{{strtoupper($view_product->category_name)}}</span></h1>
									<h2>{{$view_product->product_name}}</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<h2>Tk {{$view_product->product_price}}</h2>	
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{URL::to('/img/'.$view_product->product_image)}}" class="girl img-responsive" style="height:400px;float: right;max-width:px;" alt="" />
									<!-- <img src="{{URL::to('ecom/images/home/pricing.png')}}" style="height: 100px;" class="pricing" alt="" /> -->
								</div>
							</div>
							<?php $active=''; } ?>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <?php $active = 'active';
        foreach ($publish_product as $item) { ?>
        <div class="carousel-inner">
            <div class="item  <?php echo $active; ?>">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('/img/'.$item->product_image)}}" alt="" />
                                <h2>{{$item->product_price}}</h2>
                                <p>{{$item->product_name}}</p>
                                <button type="button" href="{{Route('add_to_cart',[$item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                {{--<div class="col-sm-4">--}}
                    {{--<div class="product-image-wrapper">--}}
                        {{--<div class="single-products">--}}
                            {{--<div class="productinfo text-center">--}}
                                {{--<img src="{{URL::to('/img/'.$item->product_image)}}" alt="" />--}}
                                {{--<h2>{{$item->product_price}}</h2>--}}
                                {{--<p>{{$item->product_name}}</p>--}}
                                {{--<button type="button" href="{{Route('cart',[$item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="product-image-wrapper">--}}
                        {{--<div class="single-products">--}}
                            {{--<div class="productinfo text-center">--}}
                                {{--<img src="{{URL::to('/img/'.$item->product_image)}}" alt="" />--}}
                                {{--<h2>{{$item->product_price}}</h2>--}}
                                {{--<p>{{$item->product_name}}</p>--}}
                                {{--<button type="button" href="{{Route('cart',[$item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
    <?php $active = ''; } ?>
</div>
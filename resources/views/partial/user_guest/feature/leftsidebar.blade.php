<?php $published_category = DB::table('category_tbls')->where('publication_status', 1)->limit(12)->get();
$published_manufacture = DB::table('manufactures')->where('publication_status',1)->limit(15)->get();?>
<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        <?php
            $all_published_category = DB::table('category_tbls')->where('publication_status', 1)->limit(12)->get();

            foreach ($published_category as $v_category) {
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="{{route('show_category',$v_category->id)}}">
                        <span class="pull-right"><i class="fa fa-plus"></i></span>
                        {{$v_category->category_name}}
                    </a>
                </h4>
            </div>
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" href="#">--}}
                        {{--<span class="badge pull-right"><i class="fa fa-plus"></i></span>--}}
                        {{--{{$v_category->category_name}}--}}
                    {{--</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
<!--             <div id="sportswear" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li><a href="#">Nike </a></li>
                        <li><a href="#">Under Armour </a></li>
                        <li><a href="#">Adidas </a></li>
                        <li><a href="#">Puma</a></li>
                        <li><a href="#">ASICS </a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    <?php } ?>
    </div><!--/category-products-->

    <div class="brands_products"><!--brands_products-->
        <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <?php
                   $published_manufacture = DB::table('manufactures')->where('publication_status',1)->limit(15)->get();
                    foreach($published_manufacture as $v_manufacture)
                    { ?>
                        <li><a href="{{route('$v_manufacture', $v_manufacture->id)}}"> <span class="pull-right"></span>{{$v_manufacture->manufacture_name}}</a></li>
                    <?php } ?>
                </ul>
            
        </div>

    </div><!--/brands_products-->
        
    <div class="price-range"><!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div><!--/price-range-->

    <div class="shipping text-center"><!--shipping-->
        <img src="{{URL::to('ecom/images/home/shipping.jpg')}}" alt="" />
    </div><!--/shipping-->

</div>
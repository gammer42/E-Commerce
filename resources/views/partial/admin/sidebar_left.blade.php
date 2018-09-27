<div id="sidebar-left" class="span2">
	<div class="nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li><a href="{{URL::to('dashboard')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
			
			<li><a href="{{URL::to('category')}}"><i class="icon-envelope"></i><span class="hidden-tablet"> All Category</span></a></li>

			<li><a href="{{URL::to('add_category')}}"><i class="icon-tasks"></i><span class="hidden-tablet"> Add Category</span></a></li>

			<li><a href="{{URL::to('manufacture')}}"><i class="icon-eye-open"></i><span class="hidden-tablet"> All Manufacture</span></a></li>

			<li><a href="{{URL::to('add_manufacture')}}"><i class="icon-dashboard"></i><span class="hidden-tablet"> Add Manufacture</span></a></li>
			<li>
				<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Products</span><span class="label label-important"> New </span></a>
				<ul>
					<li><a class="submenu" href="{{route('add_product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Product</span></a></li>
					<li><a class="submenu" href="{{route('product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All Products</span></a></li>
				</ul>	
			</li>
			<li><a href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Slider</span></a></li>

			<li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Social Link</span></a></li>

			<li><a href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Shope Name</span></a></li>

			<li><a href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Delivery Man</span></a></li>
		</ul>
	</div>
</div>
@extends('user')

@section('dashboard')

@include('admin.partial.admin_navbar')
	
<div class="container-fluid-full">
<div class="row-fluid">

    <!-- start: Main Menu -->
    @include('admin.partial.sidebar_left')
    <!-- end: Main Menu -->
    <div id="content" class="span10">
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/dashboard">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<a href="#">All Category</a>
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Category</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div style="height: 35px;" class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Category</h2><br/>
<!-- 						<p style="text-align:center; padding-right:300px;"class="alert-success">
							<?php

							// $message = Session::get('message');
							// if($message){
							// 	echo $message;
							// 	Session::put('message',NULL);
							// }
							// else {
							// 	echo "";
							// }
						?></p> -->
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{!!route('update_category',$all_category_info->id)!!}" method="post">
							{{csrf_field()}}
							<!-- @method("PUT") -->
						  <fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Category name</label>
							  <div class="controls">
								<input type="text" class="" name="category_name" value="{!!$all_category_info->category_name!!}"  > <!-- input-xlarge datepicker -->
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Category Description</label>
							  <div class="controls">
								<textarea class="" style="height:200px; width:400px;"  name="category_description" rows="3">{!!$all_category_info->category_description!!}</textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Reset</button>
							  <a href="{{URL::to('category')}}" class="btn btn-danger">Cancel</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    </div>	
  
</div><!--/#content.span10-->
</div><!--/fluid-row-->
	
@endsection
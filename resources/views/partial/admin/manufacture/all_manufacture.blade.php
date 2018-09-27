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
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Brands</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div style="height: 35px;" class="box-header" data-original-title>
						<h2><i class="halflings-icon"></i><span class="break"></span>All Brands</h2>
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
								  <th>manufacture Id</th>
								  <th>manufacture Name</th>
								  <th style="max-width:400px">manufacture Description</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
						@foreach($all_manufacture_info as $v_manufacture) 
						  <tbody>
							<tr>
								<td>{!!$v_manufacture->manufacture_id!!}</td>
								<td class="center">{!!$v_manufacture->manufacture_name!!}</td>
								<td class="center" style="max-width:400px">{!!$v_manufacture->manufacture_description!!}</td>
								<td class="center">
									@if($v_manufacture->publication_status==1)
									<span class="label label-success">Active</span>
									@else <span class="label label-danger">Inactive</span>
									@endif
								</td>
								<td class="center">
									@if($v_manufacture->publication_status==1)
										<a class="btn btn-danger" href="{{route('inactive_manufacture',[$v_manufacture->manufacture_id])}}">
											<i class="halflings-icon white thumbs-down"></i>  
										</a>
									@else
										<a class="btn btn-success" href="{{route('active_manufacture',[$v_manufacture->manufacture_id])}}">
											<i class="halflings-icon white thumbs-up"></i>  
										</a>
									@endif

									<a class="btn btn-info" href="{{route('edit_manufacture',[$v_manufacture->manufacture_id])}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{route('delete_manufacture',[$v_manufacture->manufacture_id])}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
						  </tbody>
						  @endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</div>
	</div>
</div>

@endsection
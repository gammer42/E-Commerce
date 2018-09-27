@extends('user')
@section('dashboard')
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2 style="color:red;align:center;font-size:20px;">
					<?php $error = Session::get('error');
					if($error){
					    echo $error;
					    Session::put('error',null);
					} ?>
					</h2>
                    <h2>Login to your account</h2>
                    <form class="form-horizontal" action="{{Route('admin_login')}}" method="post">
						{{ csrf_field() }}
							<fieldset>			
								<div class="input-prepend" title="Username">
									<span class="add-on"><i class="halflings-icon user"></i></span>
									<input class="input-large span10" name="admin_mail" id="username" type="text" placeholder="type username"/>
								</div>
								<div class="clearfix"></div>

								<div class="input-prepend" title="Password">
									<span class="add-on"><i class="halflings-icon lock"></i></span>
									<input class="input-large span10" name="admin_password" id="password" type="password" placeholder="type password"/>
								</div>
								<div class="clearfix"></div>
								
								<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

								<div class="button-login">	
									<button type="submit" class="btn btn-primary">Login</button>
								</div>
								<div class="clearfix"></div>
					</form>
					<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	@endsection

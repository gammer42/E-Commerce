@extends('layouts.app')
@section('content')
<div class="container text-center">
	<div class="logo-404">
		<a href="{{route('home')}}"><img src="{{URL::to('ecom/images/home/logo.png')}}" alt="" /></a>
	</div>
	<div class="content-404">
		<img src="{{URL::to('ecom/images/404/404.png')}}" class="img-responsive" alt="" />
		<h2><a href="{{route('home')}}">Bring me back Home</a></h2>
	</div>
</div>
</body>
</html>
@endsection
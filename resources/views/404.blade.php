@include('master')
    <div class="container text-center">
        <div class="logo-404">
            <a href="{{route('home')}}"><img src="{{URL::to('ecom/images/home/logo.png')}}" alt="" /></a>
        </div>
        <div class="content-404">
            <img src="{{URL::to('ecom/images/404/404.png')}}" class="img-responsive" alt="" />
            <h1><b>OPPS!</b> Sorry!!  We Couldn’t Find the page you want...</h1>
            <p>Uh... The page you are looking for are unavailable right now.</p>
            <h2><a href="{{Route('home')}}">Bring me back Home</a></h2>
        </div>
    </div>
</body>
</html>
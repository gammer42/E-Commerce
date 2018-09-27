@include('master')
@yield('content')

<script src="{{asset('/ecom/js/jquery.js')}}"></script>
<script src="{{asset('/ecom/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/ecom/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('/ecom/js/price-range.js')}}"></script>
<script src="{{asset('/ecom/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('/ecom/ js/main.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $("#log").click(function(){
            $("div#log").toggle();
        });
        $("#reg").click(function(){
            $("div#reg").toggle();
        });
        $("#guest").click(function(){
            $("div#guest").toggle();
        });
    });
</script>
</body>
</html>
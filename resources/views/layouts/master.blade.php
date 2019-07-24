<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>POS | Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="" name="description">
        <meta content="" name="author">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('layouts.include.head')

    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="loader"></div>
        <!-- BEGIN HEADER -->
        @include('layouts.include.navbar')
        
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            
            @include('layouts.include.sidebar')
            
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                
                    @yield('php')
                    @yield('content')

                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        @include('layouts.include.footer')
        @include('layouts.include.script')
    </body>

</html>
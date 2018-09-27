@extends('user')


@section('content')	
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
                    @include('ext/partial/leftsidebar')
				</div>
				<div class="col-sm-9">
                    
                    <!--/Single blog post area-->
                        @include('ext/partial/single_blog_post')                   
                    <!--/End Single blog post area-->
                    
                    <!--/Rating area -->
                        @include('ext/partial/rating')
                    <!--/End Rating area -->

                    <!--/socials-share-->
                        @include('ext/partial/social_share')
                    <!--/socials-share-->

                    <!--Comments-->
                        @include('ext/partial/media_comment')
                    <!--Comments-->
                    
                    <!--/Response-area-->
                        @include('ext/partial/response')
                    <!--/Response-area-->

                    <!--/Repaly Box-->
                        @include('ext/partial/replybox')
                    <!--/Repaly Box-->
                    
				</div>	
			</div>
		</div>
	</section>
@endsection
	2
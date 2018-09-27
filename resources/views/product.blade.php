@extends('layouts.app')

@section('content')
    {{--<section id="slider"><!--slider-->--}}
        {{--@include('ext/partial/slider')--}}
    {{--</section><!--/slider-->--}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('partial.user_guest.feature.leftsidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        @include('partial.user_guest.feature.feature')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
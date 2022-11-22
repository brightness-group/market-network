@extends('layouts.master')

@section('content')
    <home></home>
@endsection

@section('script')
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        // categories-list-slider 
        $(function() {
            // 'use strict';
            $('.categories-list-slider').slick({
                dots: false,
                arrows: true,
                infinite: false,
                speed: 500,
                slidesToShow: 6,
                slidesToScroll: 1,
                centerMode: false,
                variableWidth: true,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        swipeToSlide: true,

                    }
                }]
            });
            $('.categories-list-slider').resize();
            $('.categories-list-slider').slick('setPosition');

                        
        });
    </script>
@endsection

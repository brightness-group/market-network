@extends('layouts.master')

@section('content')
    <search snapshots='@json($snapshots)' category='@json($category)' query='@json($query)' tags='@json($tags)' tag='@json($tag)'></search>
@endsection

@section('script')
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        // explore-search-list-slider 
        $(document).ready(function() {
            $('.explore-search-list-slider').slick({
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
            $('.explore-search-list-slider').resize();
            $('.explore-search-list-slider').slick('setPosition');
        });
    </script>
@endsection

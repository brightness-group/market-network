@extends('layouts.master')

@section('content')
    <snaps-detail snapshot='@json($snapshot)' snapshots='@json($snapshots)' users='@json($users)' comments='@json($comments)' user='@json($user)' usersnaps='@json($usersnaps)' ></snaps-detail>
@endsection

@section('script')
    <script src="{{ asset('js/snaps-detail.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        $(document).ready(function() {
           $('.post-layout-slider').slick({
               dots: false,
               arrows: true,
               infinite: false,
               speed: 500,
               slidesToShow: 3,
               slidesToScroll: 1,
               centerMode: false,
               variableWidth: false,
               responsive: [{
                   breakpoint: 992,
                   settings: {
                       slidesToShow: 2,
                       slidesToScroll: 1,
                   }
               }, {
                   breakpoint: 767,
                   settings: {
                       slidesToShow: 2,
                       slidesToScroll: 1,
                   }
               }, {
                   breakpoint: 545,
                   settings: {
                       slidesToShow: 1,
                       slidesToScroll: 1,
                   }
               }]

           });
           $('.post-layout-slider').resize();
           $('.post-layout-slider').slick('setPosition');
       });
</script>
@endsection

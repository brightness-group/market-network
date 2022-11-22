@extends('layouts.master')

@section('content')
    <follow></follow>
@endsection

@section('script')
    <script src="{{ asset('js/follow.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
    <script> 
        $(function(){
            var target = window.location.hash;
            console.log(target);
            if (target !== '') {
                $('a[href="' + target + '"]').click();
            }
        });
    </script>
@endsection

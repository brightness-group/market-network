@extends('layouts.master')

@section('content')
    <cms></cms>
@endsection

@section('script')
    <script src="{{ asset('js/cms.js') }}"></script>
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

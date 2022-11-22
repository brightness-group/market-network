@extends('layouts.master')

@section('content')
    <section class="project-upload-section tab-accordion-style pb-0">

        @include('settings.tab')

        <div id="package-setting">
            <package-settings></package-settings>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/package-settings.js') }}"></script>
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

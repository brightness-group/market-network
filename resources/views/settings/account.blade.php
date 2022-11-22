@extends('layouts.master')

@section('content')
    <section class="project-upload-section tab-accordion-style pb-0">

        @include('settings.tab')

        <div id="account-setting">
            <account-settings></account-settings>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('js/account-settings.js') }}"></script>
@endsection


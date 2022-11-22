@extends('layouts.master')

@section('content')
    <section class="project-upload-section tab-accordion-style pb-0">

        @include('settings.tab')

        <div id="profile-setting">
            <profile-settings></profile-settings>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('js/profile-settings.js') }}"></script>
@endsection

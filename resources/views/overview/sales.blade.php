@extends('layouts.master')

@section('content')
    <section class="all-utilitys-section">
        <div class="tab-accordion-style">

            @include('overview.tab')

            <div id="sales">
                <sales></sales>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('js/sales.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
         
        });

    </script>
@endsection

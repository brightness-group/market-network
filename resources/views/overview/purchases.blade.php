@extends('layouts.master')

@section('content')
    <section class="all-utilitys-section">
        <div class="tab-accordion-style">

            @include('overview.tab')

            <div id="purchases">
                <purchases></purchases>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('js/purchases.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
    
    <!-- Bar Rating JS -->
    <script src="../assets/js/jquery.barrating.min.js"></script>
@endsection

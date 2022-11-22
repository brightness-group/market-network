@extends('layouts.master')

@section('content')
    <cart-checkout></cart-checkout>
@endsection

@section('script')
    <script src="{{ asset('js/cart-checkout.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script>        
        $(window).on('load', function(jQuery){
            //datepicker script
            $('.month-year-datepicker').datepicker({
                format: "mm/yy",
                startView: "months", 
                minViewMode: "months",
                startDate: '-0m'
            });
        });
    </script>
@endsection

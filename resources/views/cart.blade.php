@extends('layouts.master')

@section('content')
    <cart></cart>
@endsection

@section('script')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.timeentry.min.js') }}"></script>
    <script>
        $(window).on('load', function(jQuery){
            $('.time-dropdown .dropdown-menu').on({
                "click": function(e) {
                    e.stopPropagation();
                }
            });

            //Time Entery script
            $('.timeEntry').timeEntry({
                defaultTime: null,
                show24Hours: true,
                spinnerBigSize: [40, 40, 16],
                initialField: 0,
            });

            //datepicker script
            $('.datepicker').datepicker({
                calendarWeeks: false,
                orientation: "bottom auto",                
                startDate: '-0m'
            });
        });
    </script> 
@endsection

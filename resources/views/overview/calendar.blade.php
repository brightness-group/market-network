@extends('layouts.master')

@section('content')
    <section class="all-utilitys-section">
        <div class="tab-accordion-style">

            @include('overview.tab')

            <div id="calendar">
                <calendar></calendar>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //datetimepicker script
            $(function() {
                $('.datetimepicker').datetimepicker({
                    // focusOnShow: false,
                    // debug: true,
                    
                });
            });

            $('input').on({
                "click": function(e) {
                    e.stopPropagation();
                }
            });

            $('input').on({
                "change": function(e) {
                    e.stopPropagation();
                }
            });
        });
        
        $(function() {
            $("#sidebar-toggle").click(function(e) {
                e.preventDefault();
                $(".right-inner-wrap").toggleClass("open-sidebar");
                $(this).toggleClass("is-active");
            });
        });
    </script>
@endsection

@extends('layouts.master')

@section('content')
    <user-profile user_id='@json($id)' user_uuid='@json($uuid)'></user-profile>
@endsection

@section('script')
    <script src="{{ asset('js/user-profile.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
     <!-- Bar Rating JS -->
     <script src="{{ asset('assets/js/jquery.barrating.min.js') }}"></script>
     <script>
         $(document).ready(function() {
            //Bar Rating JS init
            $(function() {
                $('.bar-ratingstyle').barrating({
                    theme: 'bars-movie',
                    showSelectedRating: false,
                    hoverState: true,
                    initialRating: null,
                    silent: false,
                    triggerChange: true,
                    allowEmpty: true,
                    emptyValue: '',

                });
                $('.bar-rating-readonly').barrating({
                    theme: 'bars-movie',
                    readonly: true,
                });

            });
        });


     </script>


@endsection

@extends('layouts.admin.master')

@section('content')
    <settings></settings>
@endsection

@section('script')
    <script src="{{ asset('js/admin/settings.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
    $(document).ready(function() {

        //datetimepicker script
        $(function() {
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY',
                minDate:new Date()
                // focusOnShow: false,
                // debug: true,
            });
        });

        // For check box-active-deactive
        $(document).ready(function() {
            $(".check-card-box input[type='checkbox']").click(function() {
                var req = $(this).val();
                $("#item-" + req).toggleClass("active-yes");
            });
        });

        // Upload image and Preview
        $(function() {
            $("#inputImage").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $("#inputImageTwo").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#profileImg').attr('src', e.target.result);
            $('#profileImgTwo').attr('src', e.target.result);

        };
        // Upload image and Preview End
    });
    </script>
@endsection

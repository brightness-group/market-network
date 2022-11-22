@extends('layouts.admin.usermaster')

@section('content')
    <users></users>
@endsection

@section('script')
    <script src="{{ asset('js/admin/users.js') }}"></script>   
  
    <script>
        $(document).ready(function() {

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
            });

            function imageIsLoaded(e) {
                $('#profileImg').attr('src', e.target.result);
            };
            // Upload image and Preview End

            // Datatable Tab resize

            $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                $.fn.dataTable.tables({
                    visible: true,
                    api: true
                }).columns.adjust();
            });
           
        });

        //Mobile Header Toggle Searchbar js
        $(document).ready(function() {
            $('#headeSearcBtn').click(function() {
                $('.mob-toggle-search-bar').toggleClass('show-search');
            });
        });
    </script>
@endsection

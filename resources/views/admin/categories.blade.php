@extends('layouts.admin.master')

@section('content')
    <categories></categories>
@endsection

@section('script')
    <script src="{{ asset('js/admin/categories.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Upload image and Preview
            $(function() {
                $("#categuryinputImage").change(function() {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });

            function imageIsLoaded(e) {
                $('#addcategoryImg').attr('src', e.target.result);
            };
            // Upload image and Preview End
        });

    </script>
@endsection

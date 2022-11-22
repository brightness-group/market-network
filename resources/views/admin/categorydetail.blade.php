@extends('layouts.admin.master')

@section('content')
    <category-detail category_id='@json($id)' slug='@json($slug)'></category-detail>
@endsection

@section('script')
    <script src="{{ asset('js/admin/category-detail.js') }}"></script>   
    <script>
        $(document).ready(function() {
            $(function() {
                $('select').selectpicker();
            });
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
                $('#addsubcategoryImg').attr('src', e.target.result);
            };
            // Upload image and Preview End
        });
    </script>
@endsection

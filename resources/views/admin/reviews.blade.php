@extends('layouts.admin.master')

@section('content')
    <reviews></reviews>
@endsection 

@section('script')
    <script src="{{ asset('js/admin/reviews.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.rateit.min.js') }}"></script>
@endsection

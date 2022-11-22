@extends('layouts.admin.master')

@section('content')
    <user-detail user_id='@json($id)' user_uuid='@json($uuid)'></user-detail>
@endsection 

@section('script')
    <script src="{{ asset('js/admin/user-detail.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.rateit.min.js') }}"></script>
@endsection

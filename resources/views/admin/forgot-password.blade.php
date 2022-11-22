@extends('layouts.admin.guest')

@section('content')
    <forgot-password></forgot-password>
@endsection

@section('script')
    <script src="{{ asset('js/admin/forgot-password.js') }}"></script> 
@endsection

@extends('layouts.admin.guest')

@section('content')
    <reset-password reset_token='@json($reset_token)' email_id='@json($email_id)' ></reset-password>
@endsection

@section('script')
    <script src="{{ asset('js/admin/reset-password.js') }}"></script> 
@endsection

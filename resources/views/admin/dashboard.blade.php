@extends('layouts.admin.master')

@section('content')
    <dashboard></dashboard>
@endsection

@section('script')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script> 
@endsection

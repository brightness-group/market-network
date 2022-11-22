@extends('layouts.master')

@section('content')
    <payment payment_status='@json($payment_status)' order='@json($order)' ></payment>
@endsection

@section('script')
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection

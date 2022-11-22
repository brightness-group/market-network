@extends('layouts.master')

@section('content')
    <snaps snapshot_id='@json($id)' ></snaps>
@endsection

@section('script')
    <script src="{{ asset('js/snaps.js') }}"></script>
@endsection

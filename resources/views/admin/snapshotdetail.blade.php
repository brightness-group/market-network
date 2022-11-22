@extends('layouts.admin.master')

@section('content')
    <snapshot-detail snapshot_id='@json($id)' slug='@json($slug)'></snapshot-detail>
@endsection

@section('script')
    <script src="{{ asset('js/admin/snapshot-detail.js') }}"></script>   
@endsection

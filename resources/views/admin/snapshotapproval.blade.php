@extends('layouts.admin.master')

@section('content')
    <snapshot-approval snapshot_id='@json($id)' slug='@json($slug)'></snapshot-approval>
@endsection

@section('script')
    <script src="{{ asset('js/admin/snapshot-approval.js') }}"></script>   
@endsection

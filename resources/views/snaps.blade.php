@extends('layouts.master')

@section('content')
    <snaps></snaps>
@endsection

@section('script')
    <script src="{{ asset('js/snaps.js') }}"></script>

    <!-- Quantity input Js-->
    <script>
	$(document).ready(function() {
		$('.minus').click(function () {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
		});
		$('.plus').click(function () {
			var $input = $(this).parent().find('input');
			$input.val(parseInt($input.val()) + 1);
			$input.change();
			return false;
		});
	});
</script>
@endsection

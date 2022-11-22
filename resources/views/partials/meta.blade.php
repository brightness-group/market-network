<!-- COMMON TAGS -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="api-base-url" content="{{ route('home') }}" />
<meta name="assets-url" content="{{ route('home') }}" />

@if (Auth::check())
    <meta name="user-id" content="{{ Auth::user()->id }}">
@endif

<title>@yield('title', 'SEEN')</title>

@yield('meta')

<link rel="canonical" href="{{ url()->current() }}">

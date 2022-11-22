<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.meta')

        @include('partials.prologue')
    </head>
    <body>
        @include('partials.header')

        @yield('breadcrumb')

        <!-- #masthead -->
        <main role="main">
            <div id="app">
                @yield('content')
            </div>
        </main>

        @stack('modals')

        @include('partials.footer')
        <!-- #page -->
        
        @yield('script')
        
        <script src="{{ asset('assets/js/custom.js') }}"></script>

    </body>
</html>

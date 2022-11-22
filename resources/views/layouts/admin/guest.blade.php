<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.admin-partials.meta')

        @include('admin.admin-partials.prologue')
    </head>
    <body>

        <!-- #masthead -->
        <main role="main">
            <div id="app">
                @yield('content')
            </div>
        </main>

        @stack('modals')

        @include('admin.admin-partials.footer')
        <!-- #page -->
        
        @yield('script')
        
        <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    </body>
</html>

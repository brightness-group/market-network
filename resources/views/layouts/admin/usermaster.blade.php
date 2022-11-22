<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.admin-partials.meta')

        @include('admin.admin-partials.prologue')
    </head>
    <body>
        @include('admin.admin-partials.header')

        @include('admin.admin-partials.sidebar')

        @yield('breadcrumb')

        <!-- #masthead -->
        <div class="main-conatint-wrap">
            <main role="main">
                <div id="userapp">
                    @yield('content')
                </div>
            </main>
        </div>

        @stack('modals')

        @include('admin.admin-partials.footer')
        <!-- #page -->
        
        @yield('script')
        
        <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.meta')

        @include('partials.prologue')
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        @livewireStyles
    </head>
    <body>

        @include('partials.header')

        @yield('breadcrumb')
        <!-- #masthead -->
        <main role="main">
            {{ $slot }}
        </main>

        @stack('modals')

        @livewireScripts

        @include('partials.footer')
        <!-- #page -->
        
        @include('partials.epilogue')
    </body>
</html>
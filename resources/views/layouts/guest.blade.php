<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('partials.meta')

        @include('partials.prologue')

        @livewireStyles
    </head>
    <body>

        @include('partials.header')

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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href='{{ asset('img/logo-pst.svg') }}'>
							{{-- <img class="h-8" src='{{ asset('img/logo-pst.svg') }}' alt="Logo PST" rel='icon'/> --}}

        <title>{{ $title ?? 'PST BPS BUKITTINGGI' }}</title>
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScriptConfig 
    </body>
</html>

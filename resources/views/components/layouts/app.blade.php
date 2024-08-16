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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
   integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

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
  <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" 
    x-show="show"
    x-transition:enter="transition transform ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-x-[-20px]"
    x-transition:enter-end="opacity-100 translate-x-0"
    :class="{ 'invisible': !show, 'relative': show, 'absolute': !show }">
    @livewire('partials.navbar')
  </div>
 <main>
  {{ $slot }}
 </main>
 <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 800)" x-show="show"
  x-transition:enter="transition-opacity ease-out duration-500"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100">
 @livewire('partials.footer')
</div>
 @livewireScriptConfig
</body>

</html>

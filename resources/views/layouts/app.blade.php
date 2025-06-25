<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased overflow-hidden" >
<div class="min-h-screen bg-gray-100 dark:bg-[#1e2020] text-black dark:text-gray-200">
    @include('layouts.navigation')

    <main>
        <div class="flex h-[calc(100%-2.5rem)]"> {{-- Nav yüksekliği: ~2.5rem (h-10) --}}
            @include('components.sidebar')    {{-- Sol: Klasörler --}}
            @include('components.center')      {{-- Orta: Not listesi --}}
            @include('components.editor')     {{-- Sağ: Not düzenleyici --}}
        </div>
    </main>
</div>

</body>
</html>

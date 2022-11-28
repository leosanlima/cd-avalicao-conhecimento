<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?  $title.' | ' : ''}} {{config('app.name', 'CD') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @stack('styles')
</head>
<body class="font-sans antialiased min-h-screen">
<div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
    <!-- Page Content -->
    <main class="py-4 sm:py-12 px-2 w-full">
        {{ $slot }}
    </main>

    <x-layouts.session-messages />

</div>
</div>
@stack('scripts')
</body>
</html>

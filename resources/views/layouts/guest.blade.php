<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Event Organizer Pro') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&family=PT+Sans:wght@400;700&family=Satisfy&display=swap">

    <!-- Scripts -->
    @vite(['/resources/css/app.css', '/resources/sass/app.scss', '/resources/js/app.js'])
</head>

<body>
    @include('layouts.flash-message')
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @include('layouts.footer-simple')
</body>

</html>
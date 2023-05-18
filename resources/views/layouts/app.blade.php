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

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/event_organizer_pro_logo.png.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/event_organizer_pro_logo.png">
    <link rel="manifest" href="/site.webmanifest">


    <!-- Scripts -->
    @vite(['/resources/css/app.css', '/resources/sass/app.scss', '/resources/js/app.js','/resources/css/responsive.css', '/resources/css/bootstrap.min.css'])
</head>

<body>
    @include('layouts.flash-message')

    <!-- Page Content -->
    {{ $slot }}
    @include('components.footer')
</body>

</html>
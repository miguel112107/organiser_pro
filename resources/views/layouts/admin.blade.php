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

        <!-- Page Heading -->
        <header class="container bg-white border-5 border-bottom border-dark-subtle">
            <div class="row py-4">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto d-flex align-items-center gap-lg-4 gap-3">
                    <div class="event-logo">
                    <img src="/images/event_organizer_pro_logo.png">
                    </div>
                    <div class="brand-title">
                        <h2 class="fw-bold text-capitalize mb-lg-0">Event Organizer Pro</h2>
                        <h3 class="text-capitalize mb-lg-0">Admin manager</h3>
                    </div>
                </div>
            </div>
            {{ $header != null ? $header : null }}
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    @include('layouts.footer-last')
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css" />
    @notifyCss
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        //  Reload when registrations open
        $utc_start_datetime = strtotime(date('Y-m-d H:i', strtotime($settings['start_datetime']->value)));
        $utc_end_datetime = strtotime(date('Y-m-d H:i', strtotime($settings['end_datetime']->value)));
        
        $offset = date('Z');
        
        $local_start_datetime_timestamp = date('Y-m-d H:i', $utc_start_datetime + $offset);
        $local_end_datetime_timestamp = date('Y-m-d H:i', $utc_end_datetime + $offset);
        
        $local_start_datetime = strtotime($local_start_datetime_timestamp);
        $local_end_datetime = strtotime($local_end_datetime_timestamp);
        
        $current_datetime = strtotime(date('Y-m-d H:i'));
        if ($current_datetime < $local_start_datetime) {
            $time = abs($local_start_datetime - $current_datetime);
            header("Refresh: $time; url=/inschrijven");
        } elseif ($current_datetime > $local_start_datetime && $current_datetime < $local_end_datetime) {
            $time = abs($local_start_datetime - $local_end_datetime);
            header("Refresh: $time; url=/activiteiten");
        }
    @endphp
</head>

<body class="font-sans antialiased" x-data="{ darkMode: false }" x-init="if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    localStorage.setItem('darkMode', JSON.stringify(true));
}
darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>
    <div x-bind:class="{
        'dark': darkMode === true,
        'bg-gray-900 text-white': darkMode === true,
        'bg-gray-100 text-gray-600': darkMode ===
            false
    }"
        class="min-h-screen h-full">
        <div class="">
            <x-announcement />
            @include('layouts.navigation')

            <x-notify-messages />
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </div>
</body>

</html>

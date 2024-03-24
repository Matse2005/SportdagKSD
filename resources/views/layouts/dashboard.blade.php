<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} > Dashboard</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/DataTables/datatables.min.css') }}" />
    <script type="text/javascript" src="{{ url('/DataTables/datatables.min.js') }}"></script>
    @notifyCss
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        class="h-full min-h-screen">
        <div class="">
            <x-announcement />
            @include('layouts.navigation')

            @include('notify::components.notify')
            <!-- Page Content -->
            <main>
                <!-- component -->
                <div class="w-full h-full mx-auto max-w-7xl">
                    <div class="flex flex-no-wrap">
                        @include('layouts.sidenavigation')
                        <div class="w-full px-6 mx-auto">
                            <div class="w-full">
                                {{ $slot }}
                            </div>
                            @include('layouts.footer')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        var sideBar = document.getElementById("mobile-nav");
        var openSidebar = document.getElementById("openSideBar");
        var closeSidebar = document.getElementById("closeSideBar");
        sideBar.style.transform = "translateX(-260px)";

        function sidebarHandler(flag) {
            if (flag) {
                sideBar.style.transform = "translateX(0px)";
                openSidebar.classList.add("hidden");
                closeSidebar.classList.remove("hidden");
            } else {
                sideBar.style.transform = "translateX(-260px)";
                closeSidebar.classList.add("hidden");
                openSidebar.classList.remove("hidden");
            }
        }
    </script>
</body>

</html>

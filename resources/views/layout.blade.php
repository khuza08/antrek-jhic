<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="icon" href="{{ asset('storage/image/logo.png') }}">
    <link href="{{ asset('tailadmin/build/style.css') }}" rel="stylesheet">
</head>

<body class="flex h-screen overflow-hidden" x-data="{
    page: 'ecommerce',
    selected: 'Dashboard',
    loaded: true,
    darkMode: true,
    stickyMenu: false,
    sidebarToggle: false,
    scrollTop: false
}" x-init="document.documentElement.classList.add('dark');
localStorage.setItem('darkMode', 'true');"
    class="dark bg-gray-900 text-white">

    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>
    <!-- ===== Preloader End ===== -->

    {{-- Sidebar --}}
    @include('template.sidebar')

    {{-- Content Area --}}
    <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">

        {{-- Header --}}
        @include('template.header')

        {{-- Main Content --}}
        <main
            class="flex-1 p-6 bg-gray-100 dark:bg-gray-900 min-h-[calc(100vh-64px)] overflow-auto pb-20 transition-colors duration-300 text-gray-900 dark:text-gray-100">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('template.footer')

    </div>
</body>

</html>

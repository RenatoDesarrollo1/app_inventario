<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - ' . config('app.name', 'Sistema de inventario') : "Sistema de inventario" }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">


    <livewire:layout.navigation />
    {{-- The main content with `full-width` --}}
    <x-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200" collapse-text="Ocultar">



            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-menu activate-by-route>
                <x-menu-item title="Inicio" icon="o-home" link="/" />
                <x-menu-item title="Activos" icon="o-clipboard" link="/activos" />
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{-- TOAST area --}}
    <x-toast />
</body>
@livewireScripts

</html>
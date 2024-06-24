<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Penilaian K3 Laboratorium</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Logobar_K3.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="fixed top-0 left-0 z-50 w-full p-4 bg-green-600 shadow-lg">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Judul -->
            <h1 class="text-lg font-semibold leading-tight text-white">
                {{ __('Penilaian Kompetensi Dasar K3 Laboratorium') }}
            </h1>
        </div>
    </div>
    <div class="flex flex-col items-center min-h-screen pt-32 bg-gray-100 sm:justify-center sm:pt-10">
        <div class="w-full overflow-hidden bg-white shadow-md sm:max-w-sm sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

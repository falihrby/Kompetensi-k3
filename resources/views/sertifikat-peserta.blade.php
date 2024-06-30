<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CETAK DATA SERTIFIKAT</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <style>
        @media print {
            @page {
                margin: 1;
            }

            body {
                margin: 0;
            }
        }

        .image-container {
            position: relative;
            display: inline-block;
            object-fit: contain;
        }

        .overlay-text {
            position: absolute;
            top: 55%;
            left: 38%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            font-weight: bold;
            color: rgb(42, 40, 40);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body class="p-6 text-gray-900 bg-white">
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

    <div class="my-8 text-center">
        <div class="mx-auto image-container" id="certificate">
            <img src="/images/sertifikat-kompetensi.png" alt="Sertifikat Peserta">
            <div class="overlay-text">
                {{ Auth::user()->name }}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>

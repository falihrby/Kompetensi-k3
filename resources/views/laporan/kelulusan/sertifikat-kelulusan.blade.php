<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Data Sertifikat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            body,
            html {
                height: 100%;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            .print-container {
                page-break-inside: avoid;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                padding: 0;
                page-break-after: always;
                position: relative;
            }

            .print-image {
                max-height: 100%;
                max-width: 100%;
                object-fit: contain;
            }

            .scale-down {
                transform: scale(0.9);
                transform-origin: center top;
                width: 100%;
                height: auto;
            }
        }

        .date {
            position: absolute;
            bottom: 21%;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            font-weight: 600;
            font-size: large;
            color: #101010;
            font-family: sans-serif;
        }

        .number-sertif {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: x-large;
            color: #2d2c2c;
            font-family: serif;
            line-height: 0.9;
            z-index: 1;
        }

        .text-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .text-overlay .name {
            margin-top: 17%;
            font-weight: bold;
            font-size: 3rem;
            color: #2f2d2d;
            font-family: serif;
            line-height: 0.9;
        }

        .text-overlay .number {
            margin-top: 0.5rem;
            font-size: x-large;
            font-weight: normal;
            color: #2d2c2c;
            font-family: serif;
            line-height: 0.9;
        }
    </style>
</head>

<body class="p-6 text-gray-900 bg-white">
    @php
        use Illuminate\Support\Facades\Auth;
        use Carbon\Carbon;
        use Carbon\CarbonImmutable;

        // Set locale to Indonesian
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8');

        $userId = str_pad($kelulusan->user_id, 4, '0', STR_PAD_LEFT); // Pad user ID to 4 digits
        $currentDate = Carbon::now();
        $certificateNumber = "PLT-{$userId}{$currentDate->format('mY')}";
        $formattedDate = $currentDate->translatedFormat('j F Y'); // Format tanggal dalam bahasa Indonesia
    @endphp

    <div class="relative w-full my-8 text-center print-container">
        <div class="relative mx-auto image-container scale-down" id="certificate">
            <img src="/images/sertifikat_k3_1.webp" alt="Sertifikat Peserta" class="print-image">
            <div class="number-sertif">No. {{ $certificateNumber }}</div>
            <div class="text-overlay">
                <div class="name">{{ $kelulusan->nama }}</div>
                <div class="number">Nomor Peserta: {{ $kelulusan->nomor ?? 'N/A' }}</div>
            </div>
            <div class="date">Ciputat, {{ $formattedDate }}</div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>

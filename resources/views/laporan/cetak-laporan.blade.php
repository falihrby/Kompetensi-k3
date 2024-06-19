<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CETAK DATA PESERTA</title>

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
    </style>
</head>

<body class="p-6 text-gray-900 bg-white">
    <div class="my-8 text-center form-group">
        <p class="mb-6 text-xl font-bold leading-tight">Laporan Data Peserta <br />Penilaian Kompetensi Dasar K3
            Laboratorium
            <br />
            Pusat Laboratorium Terpadu
            UIN Syarif Hidayatullah Jakarta
        </p>
        <div class="mb-2 text-left">
            <p class="text-xs text-gray-800">Tanggal Dicetak : {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        </div>
        <div class="mx-auto overflow-x-auto">
            <table class="min-w-full overflow-hidden bg-white border border-gray-800 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800 ">
                            No</th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800">
                            Tanggal Dikerjakan
                        </th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800">
                            Nama
                        </th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800">
                            Nomor
                        </th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800 ">
                            Program Studi</th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800 ">
                            Fakultas</th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800 ">
                            Instansi</th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800 ">
                            Kategori Ujian</th>
                        <th class="text-xs tracking-wider text-center text-gray-800 border border-gray-800 ">
                            Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($kompetensiResults as $kompetensiResult)
                        <tr>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $loop->iteration }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->waktu_selesai_ujian }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->name }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->nomor }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->program }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->fakultas }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->instansi }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->kategori_ujian }}</td>
                            <td class="text-xs text-center align-top border border-gray-800 whitespace-nowrap">
                                {{ $kompetensiResult->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>

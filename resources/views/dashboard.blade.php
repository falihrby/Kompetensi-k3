@php
    use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    @include('layouts.navigation')

    <div class="px-4 py-20 space-y-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 py-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between px-4 py-2">
                    <div class="text-xl font-semibold text-gray-900">
                        {{ __('Detail Peserta') }}
                    </div>
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <hr class="h-px my-2 bg-gray-100 border-0 dark:bg-gray-200">
                <div class="p-4 mx-auto">
                    <table class="w-full text-base leading-5">
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-left">Nama</td>
                                <td class="px-4 py-3 font-semibold text-left">{{ Auth::user()->name }}</td>
                            </tr>
                            @if ($peserta)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-left">Nomor</td>
                                    <td class="px-4 py-3 text-left">{{ $peserta->nomor }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-left">Program Studi</td>
                                    <td class="px-4 py-3 text-left">{{ $peserta->program_studi }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-left">Fakultas</td>
                                    <td class="px-4 py-3 text-left">{{ $peserta->fakultas }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-left">Instansi</td>
                                    <td class="px-4 py-3 text-left">{{ $peserta->instansi }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="px-4 py-3 font-medium text-left" colspan="2">Data peserta tidak
                                        ditemukan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 py-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-4">
                    <div class="text-xl font-semibold text-gray-900">
                        {{ __('Panduan Kompetensi Umum ') }}
                    </div>
                </div>
                <hr class="h-px my-2 bg-gray-100 border-0 dark:bg-gray-200">
                <div class="p-4 mx-auto">
                    <div class="p-4 bg-gray-100 rounded-md overscroll-contain"
                        style="max-height: 400px; overflow-y: auto;">
                        <div class="text-sm text-gray-900">
                            <div class="space-y-4">
                                <p><b>Penilaian kompetensi dasar K3 laboratorium ini digunakan
                                    sebagai syarat untuk kegiatan penelitian di pusat laboratorium terpadu UIN
                                    Jakarta</b></p>
                                <li>Ujian sertifikasi K3 Laboratorium dilakukan di rumah masing-masing. Pastikan koneksi
                                    internet Anda stabil selama ujian berlangsung.</li>
                                <li>Soal ujian terdiri dari 10 soal kompetensi umum yang harus
                                    diselesaikan dalam waktu yang telah ditentukan.</li>
                                <li>Selama ujian berlangsung, mahasiswa tidak diperkenankan membuka laman selain
                                    aplikasi ujian untuk menjaga integritas ujian.</li>
                                <li>Mahasiswa/i harus bekerja secara mandiri dan tidak diperkenankan bertanya kepada
                                    mahasiswa lain atau meminta bantuan dari pihak luar.</li>
                                <li>Mahasiswa/i tidak diperkenankan diwakilkan saat melaksanakan ujian. Identitas
                                    peserta akan diverifikasi sebelum ujian dimulai.</li>
                                <li>Mahasiswa/i dapat mengunduh sertifikat jika telah lulus dengan nilai sempurna pada
                                    ujian umum dan ujian khusus. Sertifikat dapat diunduh melalui laman resmi setelah
                                    verifikasi hasil ujian selesai.</li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="p-4 m-4 text-left text-white bg-green-600 border-white rounded-lg"
                        style="opacity: 0.80;">
                        <p class="text-sm font-semibold">WAKTU DIMULAI KETIKA ANDA MENEKAN TOMBOL “MULAI KERJAKAN”</p>
                    </div>
                </div>
                <div class="flex justify-end py-4">
                    <a href="{{ route('kompetensi-umum.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                        <span>Mulai Kerjakan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

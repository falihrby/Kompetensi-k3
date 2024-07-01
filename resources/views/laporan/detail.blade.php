{{-- resources/views/laporan/detail.blade.php --}}

<x-admin-layout>
    <div class="px-8 py-6">
        <div class="flex justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <nav class="text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex gap-4 p-0 list-none">
                        <li class="flex items-center space-x-2">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm text-green-600 hover:text-green-800">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <a href="{{ route('laporan.index') }}"
                                class="text-sm text-green-600 hover:text-green-800">Laporan</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Detail Laporan</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="mb-12 sm:w-1/2">
            <div class="w-full p-4 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-2">
                    <div class="text-base font-semibold text-gray-900">
                        {{ __('Detail Data Laporan Peserta') }}
                    </div>
                </div>
                <hr class="h-px m-1 bg-gray-100 border-0 dark:bg-gray-200">
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>ID</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ str_pad($kompetensiResult->id, 4, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Nama</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->name }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Nomor</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->nomor }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Program Studi</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->program }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Fakultas</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->fakultas }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Instansi</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->instansi }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Kategori Ujian</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->kategori_ujian }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Keterangan</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->keterangan }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Waktu Mulai</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->waktu_mulai_ujian }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Waktu Selesai</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->waktu_selesai_ujian }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Total Soal</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->total_questions }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Jumlah Soal Benar</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->jumlah_soal_benar }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Jumlah Soal Salah</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->jumlah_soal_salah }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Ujian Ke Berapa</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kompetensiResult->ujian_ke_berapa }}</div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('laporan.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-gray-400 rounded-md font-base hover:bg-gray-600">
                        <span class="items-center">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

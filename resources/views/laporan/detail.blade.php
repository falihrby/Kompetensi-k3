<x-admin-layout>
    <div class="p-6">
        <div class="flex flex-wrap justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <h1 class="text-2xl font-bold">Detail Laporan</h1>
                <nav class="text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex gap-4 p-0 list-none">
                        <li class="flex items-center space-x-2">
                            <a href="{{ route('admin.dashboard') }}" class="text-sm text-green-600 hover:text-green-800">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Detail Laporan</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="p-4 mb-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between p-2">
                <div class="text-base font-semibold text-gray-900">
                    {{ __('Detail Data Laporan Peserta') }}
                </div>
            </div>
            <hr class="h-px m-2 bg-gray-100 border-0 dark:bg-gray-200">

            <div class="p-4">
                <p><strong>ID:</strong> {{ $laporan->id }}</p>
                <p><strong>Nama:</strong> {{ $laporan->name }}</p>
                <p><strong>Nomor Ujian:</strong> {{ $laporan->nomor_ujian }}</p>
                <p><strong>Program Studi:</strong> {{ $laporan->program_studi }}</p>
                <p><strong>Fakultas:</strong> {{ $laporan->fakultas }}</p>
                <p><strong>Instansi:</strong> {{ $laporan->instansi }}</p>
                <p><strong>Kategori Ujian:</strong> {{ $laporan->kategori_ujian }}</p>
                <p><strong>Keterangan:</strong> {{ $laporan->keterangan }}</p>
                <p><strong>Waktu Mulai:</strong> {{ $laporan->waktu_mulai }}</p>
                <p><strong>Waktu Selesai:</strong> {{ $laporan->waktu_selesai }}</p>
                <p><strong>Total Soal:</strong> {{ $laporan->total_soal }}</p>
                <p><strong>Jumlah Soal Benar:</strong> {{ $laporan->jumlah_soal_benar }}</p>
                <p><strong>Jumlah Soal Salah:</strong> {{ $laporan->jumlah_soal_salah }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>

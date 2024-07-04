<x-admin-layout>
    <div class="px-8 py-6">
        <div class="flex flex-wrap justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <h1 class="text-2xl font-bold">Data Kelulusan</h1>
                <nav class="text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex gap-4 p-0 list-none">
                        <li class="flex items-center space-x-2">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm text-green-600 hover:text-green-800">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <a href="{{ route('laporan.index') }}"
                                class="text-sm text-green-600 hover:text-green-800">Laporan</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Detail Kelulusan</span>
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
                        {{ str_pad($kelulusan->id, 4, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Nama</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->nama }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>User Id</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->user_id }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Nomor</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->nomor }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Program Studi</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->program_studi }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Fakultas</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->fakultas }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Instansi</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->instansi }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Tanggal Selesai</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->updated_at }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Keterangan</span>
                        <span>:</span>
                    </label>
                    <div class="w-2/3 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        {{ $kelulusan->keterangan }}</div>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Print Sertifikat</span>
                        <span>:</span>
                    </label>
                    <form id="certificateForm" method="GET"
                        action="{{ route('laporan.kelulusan.sertifikat', ['nama' => $kelulusan->nama]) }}">
                        @csrf
                        <a href="{{ route('laporan.kelulusan.sertifikat', ['nama' => $kelulusan->nama]) }}"
                            target="_blank"
                            class="inline-flex items-center justify-center p-4 space-x-1 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                            <span>Cetak Sertifikat</span>
                        </a>
                    </form>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('laporan.kelulusan.data-kelulusan') }}"
                        class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-gray-400 rounded-md font-base hover:bg-gray-600">
                        <span class="items-center">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

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
                            <a href="{{ route('soal.soal-kompetensi') }}"
                                class="text-sm text-green-600 hover:text-green-800">Soal Kompetensi</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Detail Soal</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="mb-12 sm:w-1/2">
            <div class="w-full p-4 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-2">
                    <div class="text-base font-semibold text-gray-900">
                        {{ __('Detail Soal Ujian') }}
                    </div>
                </div>
                <hr class="h-px m-1 bg-gray-100 border-0 dark:bg-gray-200">
                <div class="flex items-center my-2 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>ID</span>
                        <span>:</span>
                    </label>
                    <span class="w-2/3 text-sm text-gray-900">{{ $soalKompetensi->formatted_id }}</span>
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Kategori Ujian</span>
                        <span>:</span>
                    </label>
                    <span class="w-2/3 text-sm text-gray-900">{{ $soalKompetensi->kategori }}</span>
                </div>
                <div class="my-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Pertanyaan</label>
                    <span
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 whitespace-pre-line">{{ $soalKompetensi->pertanyaan }}</span>
                </div>
                @if ($soalKompetensi->gambar)
                    <div class="my-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Gambar</label>
                        <img src="{{ asset('storage/images/' . basename($soalKompetensi->gambar)) }}" alt="Gambar Soal"
                            class="w-24 h-auto rounded-lg">
                    </div>
                @endif
                <!-- Opsi A -->
                <div class="flex items-start my-4 space-x-4">
                    <label class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span class="block">Opsi A</span>
                        <span class="block">:</span>
                    </label>
                    <span
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">{{ $soalKompetensi->opsi_a }}</span>
                </div>

                <!-- Opsi B -->
                <div class="flex items-start my-4 space-x-4">
                    <label class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span class="block">Opsi B</span>
                        <span class="block">:</span>
                    </label>
                    <span
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">{{ $soalKompetensi->opsi_b }}</span>
                </div>

                <!-- Opsi C -->
                <div class="flex items-start my-4 space-x-4">
                    <label class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span class="block">Opsi C</span>
                        <span class="block">:</span>
                    </label>
                    <span
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">{{ $soalKompetensi->opsi_c }}</span>
                </div>

                <!-- Opsi D -->
                <div class="flex items-start my-4 space-x-4">
                    <label class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span class="block">Opsi D</span>
                        <span class="block">:</span>
                    </label>
                    <span
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">{{ $soalKompetensi->opsi_d }}</span>
                </div>

                <div class="flex items-center my-4 space-x-4">
                    <label class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                        <span>Jawaban Benar</span>
                        <span>:</span>
                    </label>
                    <span
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">{{ $soalKompetensi->kunci_jawaban }}</span>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('soal.soal-kompetensi') }}"
                        class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-gray-400 rounded-md font-base hover:bg-gray-600">
                        <span class="items-center">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

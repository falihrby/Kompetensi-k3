// File: resources/views/hasil-kompetensi.blade.php

<x-app-layout>
    @include('layouts.navigation')

    <div class="px-4 py-20 space-y-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 py-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-2">
                    <div class="text-xl font-semibold text-gray-900">
                        {{ __('Hasil Kompetensi') }}
                    </div>
                </div>
                <hr class="h-px my-4 bg-gray-100 border-0 dark:bg-gray-200">
                <div class="p-4">
                    <div class="text-center">
                        @if ($result['isPassed'])
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-24 mx-auto text-green-500 w-18">
                                <path fill-rule="evenodd"
                                    d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h2 class="mt-4 text-2xl font-semibold text-green-500">Lulus</h2>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-24 h-24 mx-auto text-red-500">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h2 class="mt-4 text-2xl font-semibold text-red-500">Tidak Lulus</h2>
                        @endif
                    </div>
                    <div class="space-y-2 text-left mt-14">
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Nama</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base font-bold text-black">{{ $result['user']->name }}</span>
                        </div>
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Nomor</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base text-black">{{ $result['peserta']['nomor'] }}</span>
                        </div>
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Total Soal</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base text-black">{{ $result['totalQuestions'] }}</span>
                        </div>
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Jumlah Soal Benar</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base text-black">{{ $result['correctAnswers'] }}</span>
                        </div>
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Jumlah Soal Salah</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base text-black">{{ $result['incorrectAnswers'] }}</span>
                        </div>
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Waktu Mulai</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base text-black">{{ $result['startTime'] }}</span>
                        </div>
                        <div class="flex items-center my-2 space-x-4">
                            <label class="flex justify-between w-1/3 text-base text-black">
                                <span>Waktu Selesai</span>
                                <span>:</span>
                            </label>
                            <span class="w-2/3 text-base text-black">{{ $result['endTime'] }}</span>
                        </div>
                    </div>
                </div>
                @if (!$result['isPassed'])
                    <div class="p-4 m-4 text-left text-white bg-green-600 border-white rounded-lg"
                        style="opacity: 0.80;">
                        <p class="text-sm font-base">Anda Tidak Dapat Melanjutkan Kompetensi Selanjutnya Karena
                            Tidak Lulus Kompetensi Ini. <span class="font-bold">Silahkan Ulangi Kompetensi Sampai Lulus</span></p>
                    </div>
                    <form method="POST" action="{{ route('retry-kompetensi') }}">
                        @csrf
                        <button class="px-4 py-2 mt-4 text-white bg-green-600 rounded hover:bg-green-800"
                            type="submit">
                            Ulangi
                        </button>
                    </form>
                @else
                    <form method="GET" action="{{ route('pilih-lab') }}">
                        <button class="px-4 py-2 mt-4 text-white bg-green-600 rounded hover:bg-green-800"
                            type="submit">
                            Selanjutnya
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

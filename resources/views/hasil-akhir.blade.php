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
                    <form id="certificateForm" method="POST" action="">
                        @csrf
                        <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                        <a href="{{ route('sertifikat-peserta') }}" target="_blank"
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
    </div>
</x-app-layout>

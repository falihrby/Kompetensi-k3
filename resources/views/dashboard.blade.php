@php
    use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    @include('layouts.navigation')

    <div class="px-4 py-20 space-y-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 py-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-4">
                    <div class="text-xl font-semibold text-gray-900">
                        {{ __('Detail Peserta') }}
                    </div>
                    <x-primary-button href="" class="px-2 py-4 font-bold rounded-full">
                        {{ __('Cetak Sertifikat') }}
                    </x-primary-button>
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
                                <p>Last Revised: December 16, 2013</p>
                                <p>Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors
                                    and may be used for informational purposes only. Because the Terms and Conditions
                                    contain legal obligations, please read them carefully.</p>
                                <p>1. YOUR AGREEMENT</p>
                                <p>By using this Site, you agree to be bound by, and to comply with, these Terms and
                                    Conditions. If you do not agree to these Terms and Conditions, please do not use
                                    this site.</p>
                                <p>PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or
                                    otherwise alter these Terms and Conditions at any time. Unless otherwise indicated,
                                    amendments will become effective immediately. Please review these Terms and
                                    Conditions periodically. Your continued use of the Site following the posting of
                                    changes and/or modifications will constitute your acceptance of the revised Terms
                                    and Conditions and the reasonableness of these standards for notice of changes. For
                                    your information, this page was last updated as of the date at the top of these
                                    terms and conditions.</p>
                                <p>2. PRIVACY</p>
                                <p>Please review our Privacy Policy, which also governs your visit to this Site, to
                                    understand our practices.</p>
                                <p>3. LINKED SITES</p>
                                <p>This Site may contain links to other independent third-party Web sites ("Linked
                                    Sites”). These Linked Sites are provided solely as a convenience to our visitors.
                                    Such Linked Sites are not under our control, and we are not responsible for and does
                                    not endorse the content of such Linked Sites, including any information or materials
                                    contained on such Linked Sites. You will need to make your own independent judgment
                                    regarding your interaction with these Linked Sites.</p>
                                <p>4. FORWARD LOOKING STATEMENTS</p>
                                <p>All materials reproduced on this site speak as of the original date of publication or
                                    filing. The fact that a document is available on this site does not mean that the
                                    information contained in such document has not been modified or superseded by events
                                    or by a subsequent document or filing. We have no duty or policy to update any
                                    information or statements contained on this site and, therefore, such information or
                                    statements should not be relied upon as being current as of the date you access this
                                    site.</p>
                                <p>5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</p>
                                <p>All materials reproduced on this site speak as of the original date of publication or
                                    filing. The fact that a document is available on this site does not mean that the
                                    information contained in such document has not been modified or superseded by events
                                    or by a subsequent document or filing.</p>
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

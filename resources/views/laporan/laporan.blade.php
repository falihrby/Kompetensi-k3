<x-admin-layout>
    <div class="p-6">
        <div class="flex flex-wrap justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <h1 class="text-2xl font-bold">Laporan</h1>
                <nav class="text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex gap-4 p-0 list-none">
                        <li class="flex items-center space-x-2">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm text-green-600 hover:text-green-800">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Laporan</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('laporan.excel') }}"
                    class="inline-flex items-center justify-center px-4 py-2 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span>Export Excel</span>
                </a>
                <button onclick="window.print()"
                    class="inline-flex items-center justify-center px-4 py-2 ml-4 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                    <span>Print</span>
                </button>
            </div>
        </div>

        <div class="p-4 mb-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between p-2">
                <div class="text-base font-semibold text-gray-900">
                    {{ __('Data Laporan Peserta') }}
                </div>
            </div>
            <hr class="h-px m-2 bg-gray-100 border-0 dark:bg-gray-200">

            <div class="overflow-x-auto">
                <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md sm:rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">No
                            </th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">ID
                            </th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Waktu Mulai</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Nama</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Kategori Ujian</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Waktu Selesai</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Keterangan</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $laporan->id }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $laporan->waktu_mulai }}
                                </td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $laporan->name }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">
                                    {{ $laporan->kategori_ujian }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $laporan->waktu_selesai }}
                                </td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $laporan->keterangan }}
                                </td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">
                                    <a href="{{ route('laporan.show', $laporan->id) }}"
                                        class="p-2 text-white bg-green-600 rounded-sm hover:bg-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>

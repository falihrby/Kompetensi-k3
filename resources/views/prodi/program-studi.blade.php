<x-admin-layout>
    <div class="px-2 py-8">
        <div class="sm:px-6 lg:px-8">
            <div class="flex justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold">Program Studi</h1>
                <button id="openModalButton"
                    class="inline-flex items-center justify-center px-4 py-2 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Tambah Program Studi</span>
                </button>
            </div>

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md sm:rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">No
                            </th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">Nama
                                Program Studi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($programStudis as $index => $programStudi)
                            <tr>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $programStudi->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal Content -->
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M12 17h.01M12 5h.01"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                Tambah Program Studi
                            </h3>
                            <div class="mt-2">
                                <form id="programStudiForm" action="{{ route('program-studi.store') }}" method="POST">
                                    @csrf
                                    <div class="my-4">
                                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama Program Studi<span
                                                class="pl-1 text-red-500">*</span></label>
                                        <input id="nama" type="text" name="nama" required
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <button type="button" id="closeModalButton"
                                            class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-gray-400 rounded-md font-base hover:bg-gray-600">
                                            <span class="items-center">Batal</span>
                                        </button>
                                        <button type="submit" value="Save"
                                            class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-green-600 rounded-md font-base hover:bg-green-800">
                                            <span class="items-center">Simpan</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="closeValidationPopupButton" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        document.getElementById('closeValidationPopupButton').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    </script>
</x-admin-layout>

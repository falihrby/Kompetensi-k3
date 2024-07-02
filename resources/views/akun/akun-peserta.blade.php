<x-admin-layout>
    <div class="p-6">
        <div class="flex flex-wrap justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <h1 class="text-2xl font-bold">Akun Peserta</h1>
                <nav class="text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex gap-4 p-0 list-none">
                        <li class="flex items-center space-x-2">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm text-green-600 hover:text-green-800">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Akun Peserta</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('akun-peserta.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Tambah Akun</span>
                </a>
            </div>
        </div>

        <div class="p-4 mb-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between p-2">
                <div class="text-base font-semibold text-gray-900">
                    {{ __('Data Akun Peserta') }}
                </div>
                <div class="col-md-6">
                    <form action="{{ route('akun-peserta.index') }}" method="GET">
                        <input type="text" name="search" class="px-4 py-2 border rounded-md"
                            placeholder="Pencarian..." value="{{ request('search') }}">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-800">Cari</button>
                    </form>
                </div>
            </div>
            <hr class="h-px m-2 bg-gray-100 border-0 dark:bg-gray-200">

            @if (session('success'))
                <div
                    class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md sm:rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">No
                            </th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">ID
                            </th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Email</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Nama</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Program Studi</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Fakultas</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Instansi</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($akunPeserta as $peserta)
                            <tr>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">
                                    {{ str_pad($peserta->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-4 py-2 text-xs break-all whitespace-normal align-top">
                                    {{ $peserta->email }}</td>
                                <td class="px-4 py-2 text-xs break-all whitespace-normal align-top">{{ $peserta->name }}
                                </td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $peserta->program_studi }}
                                </td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $peserta->fakultas }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $peserta->instansi }}</td>
                                <td class="flex px-4 py-2 space-x-1 text-xs font-medium align-top whitespace-nowrap">
                                    <a href="{{ route('akun-peserta.show', $peserta->id) }}"
                                        class="p-2 text-white bg-green-600 rounded-sm hover:bg-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('akun-peserta.edit', $peserta->id) }}"
                                        class="p-2 text-white bg-green-600 rounded-sm hover:bg-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                        </svg>
                                    </a>
                                    <button type="button" data-id="{{ $peserta->id }}"
                                        data-action="{{ route('akun-peserta.destroy', $peserta->id) }}"
                                        class="p-2 text-white bg-green-600 rounded-sm hover:bg-green-800 delete-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 card-footer pagination">
                    {{ $akunPeserta->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-confirmation-modal"
        class="fixed inset-0 z-50 items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="flex flex-col justify-center items-center px-5 py-6 bg-white rounded-2xl shadow-sm max-w-[342px]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="text-green-600 size-12">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            <h3 class="mt-2 text-xl font-bold text-center text-slate-800">Hapus Akun Peserta</h3>
            <h5 class="mt-2 text-sm text-center font-base text-slate-800">Jika dihapus, maka tidak bisa dikembalikan
            </h5>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-8 mt-4">
                    <button type="button" id="cancel-delete-btn"
                        class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300"
                        onclick="hideDeleteModal()">Batal</button>
                    <button type="submit" id="confirm-delete-btn"
                        class="px-4 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-800">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('delete-confirmation-modal');
            const closeDeleteModalButtons = document.querySelectorAll('#cancel-delete-btn');
            const deleteForm = document.getElementById('deleteForm');

            function showDeleteModal() {
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            }

            function hideDeleteModal() {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
            }

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const action = button.getAttribute('data-action');
                    deleteForm.action = action;
                    showDeleteModal();
                });
            });

            closeDeleteModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    hideDeleteModal();
                });
            });
        });
    </script>
    <style>
        /* Custom pagination styles */
        .pagination a,
        .pagination span {
            color: #aaaaaa;
            /* green color */
        }

        .pagination .active span {
            color: #ffffff;
            /* white color */
            background-color: #22c55e;
            /* green background color */
        }

        .pagination a:hover {
            color: #22c55e;
            background-color: #ffffff;
            /* darker green on hover */
        }
    </style>
</x-admin-layout>

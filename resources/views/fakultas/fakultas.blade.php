<x-admin-layout>
    <div class="p-6">
        <div class="flex flex-wrap justify-between py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <h1 class="text-2xl font-bold">Fakultas</h1>
                <nav class="text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex gap-4 p-0 list-none">
                        <li class="flex items-center space-x-2">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm text-green-600 hover:text-green-800">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Fakultas</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="mt-4 sm:mt-0">
                <button id="openCreateModalButton"
                    class="inline-flex items-center justify-center px-4 py-2 font-bold text-white bg-green-600 rounded-md hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Tambah Fakultas</span>
                </button>
            </div>
        </div>

        <div class="p-4 mb-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between p-2">
                <div class="text-base font-semibold text-gray-900">
                    {{ __('Data Fakultas') }}
                </div>
            </div>
            <hr class="h-px m-2 bg-gray-100 border-0 dark:bg-gray-200">
            <!-- Tabel Fakultas -->
            <div class="overflow-x-auto">
                <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md sm:rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">No
                            </th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">ID
                                Fakultas</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Nama Fakultas</th>
                            <th class="px-4 py-2 text-xs font-bold tracking-wider text-left text-gray-800 uppercase">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($fakultas as $item)
                            <tr>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">
                                    {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-4 py-2 text-xs align-top whitespace-nowrap">{{ $item->nama }}</td>
                                <td class="flex px-4 py-2 space-x-1 text-xs font-medium align-top whitespace-nowrap">
                                    <button data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                        class="p-2 text-white bg-green-600 rounded-sm hover:bg-green-800 edit-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                        </svg>
                                    </button>
                                    <button type="button" data-id="{{ $item->id }}"
                                        data-action="{{ route('fakultas.destroy', $item->id) }}"
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
                    {{ $fakultas->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 z-50 items-center justify-center hidden">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
        <div class="p-6 align-middle transition-all transform bg-white rounded-lg shadow-xl sm:max-w-lg sm:w-full">
            <div class="flex items-start justify-between">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Tambah Fakultas</h3>
                <button type="button" id="closeCreateModalButton"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="h-px m-4 bg-gray-100 border-0 dark:bg-gray-200">
            <form action="{{ route('fakultas.store') }}" method="POST" class="mt-5">
                @csrf
                <div class="flex items-center my-2 space-x-4">
                    <label for="id" class="w-1/3 text-sm font-medium text-gray-700">ID</label>
                    <input id="id" type="text" name="id" value="{{ $newId }}" readonly
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label for="nama" class="w-1/3 text-sm font-medium text-gray-700">Nama Fakultas<span>:</span></label>
                    <input id="nama" type="text" name="nama" value="{{ old('nama') }}"
                        class="w-2/3 px-3 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                        required>
                    @error('nama')
                        <p class="mt-1 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between mt-6">
                    <button type="button" id="closeCreateModalButton"
                        class="px-4 py-2 mr-2 text-white bg-gray-400 rounded-md hover:bg-gray-600">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 items-center justify-center hidden">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
        <div class="p-6 align-middle transition-all transform bg-white rounded-lg shadow-xl sm:max-w-lg sm:w-full">
            <div class="flex items-start justify-between">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Edit Fakultas</h3>
                <button type="button" id="closeEditModalButton"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="h-px m-4 bg-gray-100 border-0 dark:bg-gray-200">
            <form id="editForm" action="{{ route('fakultas.update', 0) }}" method="POST" class="mt-5">
                @csrf
                @method('PUT')
                <div class="flex items-center my-2 space-x-4">
                    <label for="editId" class="w-1/3 text-sm font-medium text-gray-700">ID</label>
                    <input id="editId" type="text" name="id" readonly
                        class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                </div>
                <div class="flex items-center my-4 space-x-4">
                    <label for="editNama" class="w-1/3 text-sm font-medium text-gray-700">Nama Fakultas<span>:</span></label>
                    <input id="editNama" type="text" name="nama"
                        class="w-2/3 px-3 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                        required>
                    @error('nama')
                        <p class="mt-1 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between mt-6">
                    <button type="button" id="closeEditModalButton"
                        class="px-4 py-2 mr-2 text-white bg-gray-400 rounded-md hover:bg-gray-600">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-800">Simpan</button>
                </div>
            </form>
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
            <h3 class="mt-2 text-xl font-bold text-center text-slate-800">Hapus Fakultas</h3>
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
            const openCreateModalButton = document.getElementById('openCreateModalButton');
            const closeCreateModalButtons = document.querySelectorAll('#closeCreateModalButton');
            const createModal = document.getElementById('createModal');

            openCreateModalButton.addEventListener('click', function() {
                createModal.classList.remove('hidden');
                createModal.classList.add('flex');
            });

            closeCreateModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    createModal.classList.add('hidden');
                    createModal.classList.remove('flex');
                });
            });

            const editButtons = document.querySelectorAll('.edit-button');
            const editModal = document.getElementById('editModal');
            const closeEditModalButtons = document.querySelectorAll('#closeEditModalButton');
            const editForm = document.getElementById('editForm');
            const editId = document.getElementById('editId');
            const editNama = document.getElementById('editNama');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');

                    editId.value = String(id).padStart(4, '0');
                    editNama.value = nama;

                    editForm.action = `{{ url('fakultas') }}/${id}`;

                    editModal.classList.remove('hidden');
                    editModal.classList.add('flex');
                });
            });

            closeEditModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    editModal.classList.add('hidden');
                    editModal.classList.remove('flex');
                });
            });

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

            window.confirmDelete = function(button, event) {
                event.preventDefault();
                deleteForm.submit();
            };

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

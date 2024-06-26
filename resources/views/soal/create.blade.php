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
                            <span class="text-sm text-gray-700">Tambah Soal</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="mb-12 sm:w-1/2">
            <div class="w-full p-4 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-2">
                    <div class="text-base font-semibold text-gray-900">
                        {{ __('Tambah Soal Ujian') }}
                    </div>
                </div>
                <hr class="h-px m-1 bg-gray-100 border-0 dark:bg-gray-200">
                <form id="soalForm" action="{{ route('soal-kompetensi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center my-4 space-x-4">
                        <label for="id" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>ID</span>
                            <span>:</span>
                        </label>
                        <input id="id" type="text" name="id"
                            value="{{ old('id', str_pad($defaultId, 4, '0', STR_PAD_LEFT)) }}" readonly
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="kategori" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Kategori Ujian<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="kategori" name="kategori" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            <option>Umum</option>
                            <option value="Khusus Agribisnis">Khusus Agribisnis</option>
                            <option value="Khusus Biologi">Khusus Biologi</option>
                            <option value="Khusus FITISIMAT">Khusus FITISIMAT</option>
                            <option value="Khusus Kimia">Khusus Kimia</option>
                            <option value="Khusus Pengujian">Khusus Pengujian</option>
                            <option value="Khusus Pertambangan">Khusus Pertambangan</option>
                        </select>
                    </div>
                    <div class="my-4">
                        <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-700">Pertanyaan<span
                                class="pl-1 text-red-500">*</span></label>
                        <textarea id="pertanyaan" name="pertanyaan" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan pertanyaan Anda..." required></textarea>
                    </div>
                    <div class="my-4">
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-700">Upload file</label>
                        <input id="gambar" name="gambar" type="file"
                            class="block w-full p-2 text-sm text-gray-900 bg-gray-100 cursor-pointer rounded-base focus:outline-none"
                            accept=".jpg, .jpeg, .png">
                        <div class="mt-1 text-xs text-gray-500" id="gambar_help">Jika butuh gambar didalam opsi, maka
                            lampirkan gambar seperti berikut <a href="/images/contoh_soal_gambar.png" target="_blank"
                                class="font-bold text-green-500 hover:text-green-700">Klik ini</a></div>
                        <button type="button" id="removeImageButton"
                            class="px-4 py-2 mt-2 text-xs font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none">Hapus
                            Gambar</button>
                    </div>
                    <!-- Opsi A -->
                    <div class="flex items-start my-4 space-x-4">
                        <label for="opsi_a"
                            class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span class="block">Opsi A</span>
                            <span class="block">:</span>
                        </label>
                        <textarea id="opsi_a" name="opsi_a" rows="4"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5"
                            placeholder="Masukkan jawaban untuk opsi A..." required></textarea>
                    </div>

                    <!-- Opsi B -->
                    <div class="flex items-start my-4 space-x-4">
                        <label for="opsi_b"
                            class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span class="block">Opsi B</span>
                            <span class="block">:</span>
                        </label>
                        <textarea id="opsi_b" name="opsi_b" rows="4"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5"
                            placeholder="Masukkan jawaban untuk opsi B..." required></textarea>
                    </div>

                    <!-- Opsi C -->
                    <div class="flex items-start my-4 space-x-4">
                        <label for="opsi_c"
                            class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span class="block">Opsi C</span>
                            <span class="block">:</span>
                        </label>
                        <textarea id="opsi_c" name="opsi_c" rows="4"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5"
                            placeholder="Masukkan jawaban untuk opsi C..." required></textarea>
                    </div>

                    <!-- Opsi D -->
                    <div class="flex items-start my-4 space-x-4">
                        <label for="opsi_d"
                            class="flex items-center justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span class="block">Opsi D</span>
                            <span class="block">:</span>
                        </label>
                        <textarea id="opsi_d" name="opsi_d" rows="4"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5"
                            placeholder="Masukkan jawaban untuk opsi D..." required></textarea>
                    </div>

                    <div class="flex items-center my-4 space-x-4">
                        <label for="kunci_jawaban"
                            class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Jawaban Benar<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="kunci_jawaban" name="kunci_jawaban" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            <option value="A">Opsi A</option>
                            <option value="B">Opsi B</option>
                            <option value="C">Opsi C</option>
                            <option value="D">Opsi D</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-red-500">*</span>
                        <span class="text-xs text-gray-700">Label bertanda (*) harus diisi</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-red-500">*</span>
                        <span class="text-xs text-gray-700">Ukuran gambar tidak boleh lebih dari 2048 KB/ 2 MB</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('soal.soal-kompetensi') }}"
                            class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-gray-400 rounded-md font-base hover:bg-gray-600">
                            <span class="items-center">Batal</span>
                        </a>
                        <button type="submit" value="Save"
                            class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-green-600 rounded-md font-base hover:bg-green-800">
                            <span class="items-center">Simpan</span>
                        </button>
                    </div>
                    <!-- Validation Popup -->
                    <div id="validationPopup" class="fixed inset-0 z-50 hidden overflow-y-auto">
                        <div
                            class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
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
                                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                            <!-- Heroicon name: outline/exclamation -->
                                            <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01M12 17h.01M12 5h.01"></path>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                                Maaf Ada Kesalahan!
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500" id="modal-description">
                                                    <span id="validationMessage"></span>
                                                </p>
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
                </form>
            </div>
        </div>
    </div>

    <div id="successMessage" class="fixed inset-0 z-50 hidden overflow-y-auto">
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
                            <!-- Heroicon name: outline/check -->
                            <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                Sukses!
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="modal-description">
                                    Soal Kompetensi Berhasil Disimpan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="closeModal()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('soalForm');
            form.addEventListener('submit', function(event) {
                const kategoriUjian = document.getElementById('kategori').value;
                const pertanyaan = document.getElementById('pertanyaan').value;
                const jawabanBenar = document.getElementById('kunci_jawaban').value;
                const gambar = document.getElementById('gambar').files[0];
                const maxFileSize = 2048; // 2048 kilobytes = 2 megabytes

                const validationMessage = document.getElementById('validationMessage');
                const validationPopup = document.getElementById('validationPopup');

                // Cek apakah kategori, pertanyaan, dan jawaban benar diisi
                if (!kategoriUjian || !pertanyaan || !jawabanBenar) {
                    validationMessage.innerText = 'Label bertanda (*) harus diisi';
                    validationPopup.classList.remove('hidden');
                    event.preventDefault();
                    return;
                }

                if (gambar) {
                    if (gambar.size > maxFileSize * 1024) {
                        validationMessage.innerText = 'Ukuran gambar tidak boleh lebih dari 2048 KB/ 2 MB';
                        validationPopup.classList.remove('hidden');
                        event.preventDefault();
                        return;
                    }
                }
            });

            const closeButton = document.getElementById('closeValidationPopupButton');
            closeButton.addEventListener('click', function() {
                const validationPopup = document.getElementById('validationPopup');
                validationPopup.classList.add('hidden');
            });

            const removeImageButton = document.getElementById('removeImageButton');
            removeImageButton.addEventListener('click', function() {
                const gambarInput = document.getElementById('gambar');
                gambarInput.value = ''; // Clear the input value
            });
        });
    </script>
</x-admin-layout>

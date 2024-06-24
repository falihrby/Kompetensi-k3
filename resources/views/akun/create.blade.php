<x-admin-layout>
    <div class="px-8 py-6">
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const successMessage = document.getElementById('successMessage');
                    if (successMessage) {
                        successMessage.classList.remove('hidden');
                    }
                });
            </script>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                            <a href="{{ route('akun-peserta.index') }}"
                                class="text-sm text-green-600 hover:text-green-800">Akun Peserta</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Tambah Akun Peserta</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="mb-12 sm:w-1/2">
            <div class="w-full p-4 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-2">
                    <div class="text-base font-semibold text-gray-900">
                        {{ __('Tambah Akun Peserta') }}
                    </div>
                </div>
                <hr class="h-px m-1 bg-gray-100 border-0 dark:bg-gray-200">
                <form id="akunPesertaForm" action="{{ route('akun-peserta.store') }}" method="POST">
                    @csrf
                    <div class="flex items-center my-4 space-x-4">
                        <label for="user_id" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>User ID<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="user_id" type="text" name="user_id" value="{{ $nextUserId }}" readonly
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="name" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Nama<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autocomplete="name"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                        @error('name')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="email" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Email<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                        @error('email')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="relative flex items-center my-4 space-x-4">
                        <label for="password" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Password<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 pr-10">
                        <button type="button" id="toggle-password"
                            class="absolute inset-y-0 right-0 flex items-center px-3">
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="hidden w-6 h-6 text-green-700">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd"
                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6 text-green-700">
                                <path
                                    d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path
                                    d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path
                                    d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </button>
                        @error('password')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="nomor" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Nomor<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="nomor" type="text" name="nomor" value="{{ old('nomor') }}" required
                            autocomplete="tel"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                        @error('nomor')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="program_studi"
                            class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Program Studi<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="program_studi" name="program_studi" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            @foreach ($programStudis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                            @endforeach
                        </select>
                        @error('program_studi')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="fakultas" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Fakultas<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="fakultas" name="fakultas" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            @foreach ($fakultases as $fakultas)
                                <option value="{{ $fakultas->id }}">{{ $fakultas->nama }}</option>
                            @endforeach
                        </select>
                        @error('fakultas')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="instansi" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Instansi<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="instansi" name="instansi" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            @foreach ($instansis as $instansi)
                                <option value="{{ $instansi->id }}">{{ $instansi->name }}</option>
                            @endforeach
                        </select>
                        @error('instansi')
                            <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-red-500">*</span>
                        <span class="text-xs text-gray-700">Label bertanda (*) harus diisi</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('akun-peserta.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-gray-400 rounded-md font-base hover:bg-gray-600">
                            <span class="items-center">Batal</span>
                        </a>
                        <button type="submit" value="Save"
                            class="inline-flex items-center justify-center px-4 py-2 space-x-2 text-white bg-green-600 rounded-md font-base hover:bg-green-800">
                            <span class="items-center">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Success Message -->
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
                                    Akun Peserta Berhasil Disimpan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="redirectToIndex()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.classList.add('hidden');
            }

            const validationPopup = document.getElementById('validationPopup');
            if (validationPopup) {
                validationPopup.classList.add('hidden');
            }
        }

        function redirectToIndex() {
            window.location.href = "{{ route('akun-peserta.index') }}";
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const eyeOpenIcon = document.getElementById('eye-open');
                const eyeClosedIcon = document.getElementById('eye-closed');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeOpenIcon.classList.remove('hidden');
                    eyeClosedIcon.classList.add('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeOpenIcon.classList.add('hidden');
                    eyeClosedIcon.classList.remove('hidden');
                }
            });

            @if (session('success'))
                document.getElementById('successMessage').classList.remove('hidden');
                {{ session()->forget('success') }} // Clear the session variable
            @endif

            if (document.getElementById('validationPopup')) {
                const validationMessage = document.getElementById('validationMessage');
                validationMessage.innerHTML = `{{ implode('<br>', $errors->all()) }}`;
                document.getElementById('validationPopup').classList.remove('hidden');
            }
        });
    </script>
</x-admin-layout>

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
                            <a href="{{ route('akun-peserta.index') }}"
                                class="text-sm text-green-600 hover:text-green-800">Akun Peserta</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            <span class="text-sm text-gray-700">Ubah Akun Peserta</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="mb-12 sm:w-1/2">
            <div class="w-full p-4 bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-2">
                    <div class="text-base font-semibold text-gray-900">
                        {{ __('Ubah Akun Peserta') }}
                    </div>
                </div>
                <hr class="h-px m-1 bg-gray-100 border-0 dark:bg-gray-200">
                <form id="akunPesertaForm" action="{{ route('akun-peserta.update', $akunPeserta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center my-4 space-x-4">
                        <label for="user_id" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>User ID</span>
                            <span>:</span>
                        </label>
                        <input id="user_id" type="text" name="user_id"
                            value="{{ old('user_id', str_pad($akunPeserta->id, 4, '0', STR_PAD_LEFT)) }}" readonly
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="name" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Nama</span>
                            <span>:</span>
                        </label>
                        <input id="name" type="text" name="name"
                            value="{{ old('name', $akunPeserta->name) }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="email" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Email</span>
                            <span>:</span>
                        </label>
                        <input id="email" type="email" name="email"
                            value="{{ old('email', $akunPeserta->email) }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="password" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Password</span>
                            <span>:</span>
                        </label>
                        <input id="password" type="password" name="password"
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                        <small class="text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="nomor" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Nomor</span>
                            <span>:</span>
                        </label>
                        <input id="nomor" type="text" name="nomor"
                            value="{{ old('nomor', $akunPeserta->nomor) }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="mb-4">
                        <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="program_studi" id="program_studi"
                            class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            required>
                            @foreach ($programStudis as $prodi)
                                <option value="{{ $prodi->nama }}"
                                    {{ old('program_studi', $akunPeserta->program_studi) == $prodi->nama ? 'selected' : '' }}>
                                    {{ $prodi->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_studi')
                            <div class="mt-1 text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="fakultas" class="block text-sm font-medium text-gray-700">Fakultas</label>
                        <select name="fakultas" id="fakultas"
                            class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            required>
                            @foreach ($fakultases as $fakultas)
                                <option value="{{ $fakultas->nama }}"
                                    {{ old('fakultas', $akunPeserta->fakultas) == $fakultas->nama ? 'selected' : '' }}>
                                    {{ $fakultas->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('fakultas')
                            <div class="mt-1 text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                        <select name="instansi" id="instansi"
                            class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            required>
                            @foreach ($instansis as $instansi)
                                <option value="{{ $instansi->name }}"
                                    {{ old('instansi', $akunPeserta->instansi) == $instansi->name ? 'selected' : '' }}>
                                    {{ $instansi->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('instansi')
                            <div class="mt-1 text-red-500">{{ $message }}</div>
                        @enderror
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
</x-admin-layout>

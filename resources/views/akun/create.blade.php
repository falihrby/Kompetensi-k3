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
                        <label for="nama" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Nama<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="nomor" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Nomor<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="nomor" type="text" name="nomor" value="{{ old('nomor') }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="program_studi" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Program Studi<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="program_studi" name="program_studi" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            @foreach($programStudis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="fakultas" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Fakultas<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="fakultas" name="fakultas" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            @foreach($fakultases as $fakultas)
                                <option value="{{ $fakultas->id }}">{{ $fakultas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="instansi" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Instansi<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <select id="instansi" name="instansi" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                            @foreach($instansis as $instansi)
                                <option value="{{ $instansi->id }}">{{ $instansi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="email" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Email<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="password" class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Password<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="password" type="text" name="password" value="{{ old('password') }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
                    </div>
                    <div class="flex items-center my-4 space-x-4">
                        <label for="kategori_ujian_wajib"
                            class="flex justify-between w-1/3 text-sm font-medium text-gray-700">
                            <span>Kategori Ujian Wajib<span class="pl-1 text-red-500">*</span></span>
                            <span>:</span>
                        </label>
                        <input id="kategori_ujian_wajib" type="text" name="kategori_ujian_wajib"
                            value="{{ old('kategori_ujian_wajib') }}" required
                            class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
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
</x-admin-layout>

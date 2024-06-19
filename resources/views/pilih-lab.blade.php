@php
    use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    @include('layouts.navigation')

    <div class="px-4 py-20 space-y-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 text-2xl font-semibold text-center text-gray-900">
                Silahkan Pilih Lab Yang Dituju
            </div>
            <div class="p-4 mx-auto">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        class="flex flex-col justify-start max-w-xs gap-4 p-6 mx-auto transition transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <div class="flex flex-col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="green" class="w-16 h-16 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                            </svg>
                            <div class="text-xl font-medium text-stone-900">Lab FITISIMAT</div>
                            <hr class="w-full h-px my-2 bg-gray-400 border-0 dark:bg-gray-200">
                            <div class="text-sm font-normal text-zinc-600">
                                Lab ini mencakup Fisika, Teknik Informatika, Sistem Informasi dan Matematika
                            </div>
                        </div>
                        <div class="flex w-full py-4">
                            <a href=""
                                class="inline-flex px-4 py-2 font-bold text-white transition bg-green-600 rounded-md hover:bg-green-800">
                                <span>Masuk</span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start max-w-xs gap-4 p-6 mx-auto transition transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <div class="flex flex-col ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="green" class="w-16 h-16 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                            </svg>
                            <div class="text-xl font-medium text-stone-900">Lab Kimia</div>
                            <hr class="w-full h-px my-2 bg-gray-400 border-0 dark:bg-gray-200">
                            <div class="text-sm font-normal text-zinc-600">
                                Lab ini mencakup studi tentang zat dan reaksi kimia
                            </div>
                        </div>
                        <div class="flex w-full py-4">
                            <a href=""
                                class="inline-flex px-4 py-2 font-bold text-white transition bg-green-600 rounded-md hover:bg-green-800">
                                <span>Masuk</span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start max-w-xs gap-4 p-6 mx-auto transition transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <div class="flex flex-col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24"
                                class="mb-4">
                                <rect width="24" height="24" fill="none" />
                                <path fill="green"
                                    d="M4 2h2v2c0 1.44.68 2.61 1.88 3.78c.86.83 2.01 1.63 3.21 2.42l-1.83 1.19C8.27 10.72 7.31 10 6.5 9.21C5.07 7.82 4 6.1 4 4zm14 0h2v2c0 2.1-1.07 3.82-2.5 5.21c-1.41 1.38-3.21 2.52-4.96 3.63c-1.75 1.12-3.45 2.21-4.66 3.38C6.68 17.39 6 18.56 6 20v2H4v-2c0-2.1 1.07-3.82 2.5-5.21c1.41-1.38 3.21-2.52 4.96-3.63c1.75-1.12 3.45-2.21 4.66-3.38C17.32 6.61 18 5.44 18 4zm-3.26 10.61c.99.67 1.95 1.39 2.76 2.18C18.93 16.18 20 17.9 20 20v2h-2v-2c0-1.44-.68-2.61-1.88-3.78c-.86-.83-2.01-1.63-3.21-2.42zM7 3h10v1l-.06.5H7.06L7 4zm.68 3h8.64c-.24.34-.52.69-.9 1.06l-.51.44H9.07l-.49-.44c-.38-.37-.66-.72-.9-1.06m1.41 10.5h5.84l.49.44c.38.37.66.72.9 1.06H7.68c.24-.34.52-.69.9-1.06zm-2.03 3h9.88l.06.5v1H7v-1z" />
                            </svg>
                            <div class="text-xl font-medium text-stone-900">Lab Biologi</div>
                            <hr class="w-full h-px my-2 bg-gray-400 border-0 dark:bg-gray-200">
                            <div class="text-sm font-normal text-zinc-600">
                                Lab ini mencakup studi tentang organisme hidup dan proses biologis
                            </div>
                        </div>
                        <div class="flex w-full py-4">
                            <a href=""
                                class="inline-flex px-4 py-2 font-bold text-white transition bg-green-600 rounded-md hover:bg-green-800">
                                <span>Masuk</span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start max-w-xs gap-4 p-6 mx-auto transition transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <div class="flex flex-col ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="green" class="w-16 h-16 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <div class="text-xl font-medium text-stone-900">Lab Pengujian</div>
                            <hr class="w-full h-px my-2 bg-gray-400 border-0 dark:bg-gray-200">
                            <div class="text-sm font-normal text-zinc-600">
                                Lab ini untuk mendukung kegiatan penelitian dan pengabdian masyarakat dalam bentuk layanan jasa pengujian.
                            </div>
                        </div>
                        <div class="flex w-full py-4">
                            <a href=""
                                class="inline-flex px-4 py-2 font-bold text-white transition bg-green-600 rounded-md hover:bg-green-800">
                                <span>Masuk</span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start max-w-xs gap-4 p-6 mx-auto transition transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <div class="flex flex-col ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24"
                                class="mb-4">
                                <rect width="24" height="24" fill="none" />
                                <path fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M14.881 5.186C13.46 4.314 9.808 2.642 6.52 3.069c1.99 1.37 3.036 2.106 5.86 4.62m6.435 1.43c.872 1.422 2.544 5.073 2.117 8.361c-1.37-1.989-2.106-3.035-4.62-5.859m-5.838-.203l-7.05 7.05c-.572.572-.563 1.507.02 2.09c.582.582 1.518.59 2.09.019l7.049-7.05m-.596-4.301l2.788 2.787c.31.31.81.311 1.119.003l3.453-3.454a.79.79 0 0 0-.002-1.118l-2.788-2.788a.79.79 0 0 0-1.118-.002l-3.454 3.453a.79.79 0 0 0 .002 1.119"
                                    color="currentColor" />
                            </svg>
                            <div class="text-xl font-medium text-stone-900">Lab Pertambangan</div>
                            <hr class="w-full h-px my-2 bg-gray-400 border-0 dark:bg-gray-200">
                            <div class="text-sm font-normal text-zinc-600">
                                Lab ini mencakup studi tentang teknik dan proses pertambangan
                            </div>
                        </div>
                        <div class="flex w-full py-4">
                            <a href=""
                                class="inline-flex px-4 py-2 font-bold text-white transition bg-green-600 rounded-md hover:bg-green-800">
                                <span>Masuk</span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-start max-w-xs gap-4 p-6 mx-auto transition transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <div class="flex flex-col ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 48 48" class="mb-4">
                                <rect width="48" height="48" fill="none" />
                                <g fill="green" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M19.176 21.647a1 1 0 0 0-.33 1.376c.919 1.498 1.7 2.985 2.22 4.336a1 1 0 0 0 1.867-.718c-.578-1.504-1.426-3.105-2.382-4.664a1 1 0 0 0-1.375-.33m10.414-.954a1 1 0 0 1 .217 1.397c-1.157 1.583-2.176 3.7-2.893 5.316a1 1 0 1 1-1.828-.812c.724-1.63 1.814-3.916 3.107-5.684a1 1 0 0 1 1.397-.217" />
                                    <path
                                        d="M27.24 12.037C29.582 9.359 42.105 6 42.105 6s-2.129 13.395-4.002 15.537c-1.395 1.596-5.84.599-8.018-.014c1.628-2.497 3.515-4.936 5.174-6.872a1 1 0 0 0-1.518-1.302c-1.673 1.952-3.612 4.45-5.31 7.047c-.954-1.776-3.043-6.242-1.191-8.36M11 30H6v12h5v-2.043c1.02-.042 2.526-.096 3.047-.075c1.787.073 3.12.499 4.47.93c1.258.401 2.529.807 4.192.934c.418.032.825.073 1.22.112c1.423.144 2.686.272 3.73-.112c1.332-.49 8.946-4.217 9.898-5.198c.952-.98.476-3.628-2.475-3.138c-1.456.242-3.143.938-4.674 1.569c-1.571.647-2.977 1.227-3.797 1.177c-1.618-.098-5.9-.882-5.9-.882l4.917.06s.695.036 1.65-.649s1.808-2.648.38-2.648s-2.95-.49-2.95-.49l-6.092-1.373s-2.094-.392-2.95 0c-.706.323-3.648 1.377-4.666 1.74zM8.878 9.67s10.335 2.772 12.267 4.981c1.493 1.707-.116 5.262-.926 6.792a58 58 0 0 0-3.434-4.829a1 1 0 1 0-1.57 1.239a56 56 0 0 1 3.336 4.695c-1.868.506-5.27 1.203-6.37-.056c-1.546-1.768-3.303-12.823-3.303-12.823" />
                                </g>
                            </svg>
                            <div class="text-xl font-medium text-stone-900">Lab Agribisnis</div>
                            <hr class="w-full h-px my-2 bg-gray-400 border-0 dark:bg-gray-200">
                            <div class="text-sm font-normal text-zinc-600">
                                 ini mencakup studi tentang manajemen dan produksi agribisnis
                            </div>
                        </div>
                        <div class="flex w-full py-4">
                            <a href=""
                                class="inline-flex px-4 py-2 font-bold text-white transition bg-green-600 rounded-md hover:bg-green-800">
                                <span>Masuk</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

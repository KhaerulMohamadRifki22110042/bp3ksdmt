<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            Sertifikat – {{ $pelatihan->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow-xl p-8 text-center relative overflow-hidden">

                <!-- Ornamen Background -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-100 rounded-full opacity-40"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-100 rounded-full opacity-40"></div>

                <!-- Icon -->
                <div class="mb-6">
                    <div class="w-20 h-20 mx-auto bg-emerald-100 rounded-full flex items-center justify-center shadow">
                        <span class="text-3xl">🎓</span>
                    </div>
                </div>

                <!-- Nama Peserta -->
                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    {{ $peserta->nama }}
                </h3>

                <!-- Jurusan -->
                <p class="text-gray-500 mb-6">
                    Jurusan: <span class="font-medium text-gray-700">{{ $peserta->jurusan }}</span>
                </p>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6"></div>

                <!-- Informasi -->
                <p class="text-gray-600 mb-8">
                    Sertifikat pelatihan <span class="font-semibold text-gray-800">
                        {{ $pelatihan->nama_pelatihan }}
                    </span> siap untuk diunduh.
                </p>

                <!-- Tombol Download -->
                <a href="{{ route('sertifikat.downloadPeserta', $pelatihan->id) }}"
                   target="_blank"
                   class="inline-flex items-center px-8 py-3
                          bg-emerald-600 hover:bg-emerald-700
                          text-white font-semibold text-sm
                          rounded-xl shadow-lg
                          transition duration-200 ease-in-out">
                    Download Sertifikat
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
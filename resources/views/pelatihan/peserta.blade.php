<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    👥 Daftar Peserta
                </h2>
                <p class="text-sm text-gray-500">
                    {{ $pelatihan->nama_pelatihan }}
                </p>
            </div>

            <a href="{{ route('pelatihan.index') }}"
               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 
                      text-white text-sm rounded-lg shadow transition">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto">

            <!-- TABLE BOX -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">

                <!-- CARD HEADER -->
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Total Peserta: {{ $pelatihan->pesertas->count() }}
                    </h3>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
<table class="min-w-full text-sm text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
    <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 uppercase text-xs tracking-wider">
        <tr>
            <th class="px-6 py-4 text-center">No</th>
            <th class="px-6 py-4 text-left">Nama</th>
            <th class="px-6 py-4 text-left">NIM</th>
            <th class="px-6 py-4 text-left">Email</th>
            <th class="px-6 py-4 text-center">Nilai</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-100">
        @forelse($pelatihan->pesertas as $peserta)
        <tr class="hover:bg-gray-50 transition duration-150">
            <td class="px-6 py-4 text-center font-medium text-gray-600">
                {{ $loop->iteration }}
            </td>

            <td class="px-6 py-4 font-semibold text-gray-800">
                {{ $peserta->nama }}
            </td>

            <!-- NIM dari tabel users -->
            <td class="px-6 py-4 text-gray-600">
                {{ optional($peserta->user)->nim ?? '-' }}
            </td>

            <!-- Email dari tabel users -->
            <td class="px-6 py-4 text-gray-600">
                {{ optional($peserta->user)->email ?? '-' }}
            </td>

            <td class="px-6 py-4 text-center">
                <span class="px-3 py-1 text-xs font-semibold 
                             bg-green-100 text-green-600 
                             rounded-full">
                    {{ $peserta->nilai ?? '-' }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-10 text-gray-400">
                Belum ada peserta pada pelatihan ini
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
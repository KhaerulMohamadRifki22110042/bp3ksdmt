<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 flex items-center gap-2">
            📊 Data Nilai Pelatihan
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-lg">

            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 p-3 rounded-lg shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4 text-left">Nama Pelatihan</th>
                        <th class="px-6 py-4 text-center">Tanggal Mulai</th>
                        <th class="px-6 py-4 text-center">Tanggal Selesai</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($pelatihans as $pelatihan)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-center font-medium text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $pelatihan->nama_pelatihan }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-600 rounded-full">
                                    {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->format('d M Y') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-semibold bg-pink-100 text-pink-600 rounded-full">
                                    {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->format('d M Y') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                @auth
                                    @if(auth()->user()->role === 'pelatih')
                                        <a href="{{ route('nilai.create', $pelatihan->id) }}"
                                           class="inline-flex items-center gap-1 px-4 py-2 text-xs font-semibold bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition">
                                            ✏ Input Nilai
                                        </a>
                                    @endif
                                @endauth

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('nilai.rekap', $pelatihan->id) }}"
                                           class="inline-flex items-center gap-1 px-4 py-2 text-xs font-semibold bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">
                                            📑 Rekap Nilai
                                        </a>
                                    @endif
                                @endauth

                                @auth
                                    @if(auth()->user()->role === 'peserta')
                                        <a href="{{ route('nilai.rekap', $pelatihan->id) }}"
                                           class="inline-flex items-center gap-1 px-4 py-2 text-xs font-semibold bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">
                                            👀 Lihat Nilai
                                        </a>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400">
                                Belum ada data pelatihan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
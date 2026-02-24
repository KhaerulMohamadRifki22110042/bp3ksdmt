<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            📊 Dashboard
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto">

            {{-- ================= ADMIN DASHBOARD ================= --}}
            @if(auth()->user()->role == 'admin')

                <div class="space-y-8">

                    <!-- STATISTIC CARDS -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Total Pelatihan -->
                        <div class="bg-white p-6 rounded-xl shadow-md border">
                            <h3 class="text-gray-500 text-sm">Total Pelatihan</h3>
                            <p class="text-3xl font-bold text-blue-700 mt-2">
                                {{ $totalPelatihan }}
                            </p>
                        </div>

                        <!-- Total Peserta -->
                        <div class="bg-white p-6 rounded-xl shadow-md border">
                            <h3 class="text-gray-500 text-sm">Total Peserta</h3>
                            <p class="text-3xl font-bold text-green-600 mt-2">
                                {{ $totalPeserta }}
                            </p>
                        </div>

                        <!-- Total Nilai -->
                        <div class="bg-white p-6 rounded-xl shadow-md border">
                            <h3 class="text-gray-500 text-sm">Total Nilai</h3>
                            <p class="text-3xl font-bold text-purple-600 mt-2">
                                {{ $totalNilai }}
                            </p>
                        </div>

                    </div>

                    <!-- PELATIHAN TERBARU -->
                    <div class="bg-white p-6 rounded-xl shadow-md border">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">
                            Pelatihan Terbaru
                        </h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-gray-700">
                                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Nama Pelatihan</th>
                                        <th class="px-4 py-3 text-left">Tanggal Mulai</th>
                                        <th class="px-4 py-3 text-left">Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @forelse($pelatihanTerbaru as $pelatihan)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 font-semibold">
                                                {{ $pelatihan->nama_pelatihan }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $pelatihan->tanggal_mulai }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $pelatihan->tanggal_selesai }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-6 text-gray-400">
                                                Belum ada pelatihan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            {{-- ================= PELATIH / PESERTA ================= --}}
            @else

                <div class="max-w-3xl mx-auto">
                    <div class="bg-white p-8 rounded-xl shadow-md text-center">
                        
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">
                            Selamat Datang, {{ auth()->user()->name }}
                        </h3>

                        <p class="text-gray-500">
                            Silakan gunakan menu navigasi untuk mengakses fitur sistem.
                        </p>

                    </div>
                </div>

            @endif

        </div>
    </div>

</x-app-layout>
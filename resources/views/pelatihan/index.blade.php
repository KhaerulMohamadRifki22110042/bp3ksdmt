<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                📚 Data Pelatihan
            </h2>

            <a href="{{ route('pelatihan.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 
                      bg-gradient-to-r from-indigo-600 to-indigo-700 
                      hover:from-indigo-700 hover:to-indigo-800 
                      text-white text-sm font-semibold 
                      rounded-xl shadow-lg transition duration-200">
                ➕ Tambah Pelatihan
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <!-- ALERT SUCCESS -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- TABLE BOX -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <table class="min-w-full text-sm text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
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
                                <span class="px-3 py-1 text-xs font-semibold 
                                             bg-blue-100 text-blue-600 
                                             rounded-full">
                                    {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->format('d M Y') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-semibold 
                                             bg-pink-100 text-pink-600 
                                             rounded-full">
                                    {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->format('d M Y') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                <!-- LIHAT PESERTA -->
                                <a href="{{ route('pelatihan.peserta', $pelatihan->id) }}"
                                   class="inline-flex items-center gap-1 px-4 py-2 text-xs font-semibold 
                                          bg-blue-600 hover:bg-blue-700 
                                          text-white rounded-lg shadow transition">
                                    👥 Peserta
                                </a>

                                <!-- EDIT -->
                                <a href="{{ route('pelatihan.edit', $pelatihan->id) }}"
                                   class="inline-flex items-center gap-1 px-4 py-2 text-xs font-semibold 
                                          bg-yellow-500 hover:bg-yellow-600 
                                          text-white rounded-lg shadow transition">
                                    ✏ Edit
                                </a>

                                <!-- HAPUS -->
                                <form action="{{ route('pelatihan.destroy', $pelatihan->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin hapus pelatihan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-4 py-2 text-xs font-semibold 
                                                   bg-red-600 hover:bg-red-700 
                                                   text-white rounded-lg shadow transition">
                                        🗑 Hapus
                                    </button>
                                </form>
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
    </div>

</x-app-layout>
<x-app-layout>

    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Absensi - {{ $pelatihan->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">

            <!-- Info Pelatihan -->
            <div class="mb-6 border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $pelatihan->nama_pelatihan }}
                </h3>
                <p class="text-sm text-gray-500">
                    Tanggal Pelatihan: {{ $pelatihan->tanggal }}
                </p>
            </div>

            <!-- Form Absensi -->
            <form action="{{ route('absensi.store', $pelatihan->id) }}" method="POST">
                @csrf

                <!-- Input Tanggal -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Absensi
                    </label>
                    <input type="date"
                        name="tanggal"
                        value="{{ $tanggal }}"
                        required
                        class="w-60 rounded-lg border-gray-300 shadow-sm
                               focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Tabel Peserta -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Nama Peserta</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Jurusan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($pesertas as $peserta)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>

                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        {{ $peserta->nama }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $peserta->jurusan }}
                                    </td>

                                    <!-- STATUS BUTTON -->
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">

                                            <!-- HADIR -->
                                            <label class="cursor-pointer">
                                                <input type="radio"
                                                    name="status[{{ $peserta->id }}]"
                                                    value="Hadir"
                                                    required
                                                    class="hidden peer">
                                                <span
                                                    class="px-3 py-1 rounded-lg border text-sm
                                                    peer-checked:bg-green-600
                                                    peer-checked:text-white
                                                    peer-checked:border-green-600
                                                    hover:bg-green-100">
                                                    Hadir
                                                </span>
                                            </label>

                                            <!-- IZIN -->
                                            <label class="cursor-pointer">
                                                <input type="radio"
                                                    name="status[{{ $peserta->id }}]"
                                                    value="Izin"
                                                    class="hidden peer">
                                                <span
                                                    class="px-3 py-1 rounded-lg border text-sm
                                                    peer-checked:bg-yellow-500
                                                    peer-checked:text-white
                                                    peer-checked:border-yellow-500
                                                    hover:bg-yellow-100">
                                                    Izin
                                                </span>
                                            </label>

                                            <!-- ALPHA -->
                                            <label class="cursor-pointer">
                                                <input type="radio"
                                                    name="status[{{ $peserta->id }}]"
                                                    value="Alpha"
                                                    class="hidden peer">
                                                <span
                                                    class="px-3 py-1 rounded-lg border text-sm
                                                    peer-checked:bg-red-600
                                                    peer-checked:text-white
                                                    peer-checked:border-red-600
                                                    hover:bg-red-100">
                                                    Alpha
                                                </span>
                                            </label>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="text-center py-6 text-gray-500">
                                        Tidak ada peserta terdaftar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end mt-6 gap-3">
                    <a href="{{ route('absensi.pilih') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300
                               text-gray-700 hover:bg-gray-100">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-indigo-600
                               text-white hover:bg-indigo-700 shadow">
                        Simpan Absensi
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>

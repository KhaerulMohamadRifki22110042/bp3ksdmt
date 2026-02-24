<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            Sertifikat – {{ $pelatihan->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow-lg p-6">

                <div class="mb-6 border-b pb-3">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Daftar Peserta Pelatihan
                    </h3>
                    <p class="text-sm text-gray-500">
                        Unduh sertifikat masing-masing peserta.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                                <th class="p-4 text-center w-16 rounded-tl-xl">No</th>
                                <th class="p-4">Nama Peserta</th>
                                <th class="p-4">Jurusan</th>
                                <th class="p-4 text-center w-56 rounded-tr-xl">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach($pelatihan->pesertas as $peserta)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="p-4 text-center font-medium text-gray-600">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-4 font-semibold text-gray-800">
                                    {{ $peserta->nama }}
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $peserta->jurusan }}
                                </td>

                                <td class="p-4 text-center">
                                    <a href="{{ route('sertifikat.pdf', [$pelatihan->id, $peserta->id]) }}"
                                       target="_blank"
                                       class="inline-flex items-center px-5 py-2
                                              bg-emerald-600 hover:bg-emerald-700
                                              text-white text-sm font-semibold
                                              rounded-xl shadow-md
                                              transition duration-200 ease-in-out">
                                        Download Sertifikat
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($pelatihan->pesertas->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        Belum ada peserta yang terdaftar.
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                📋 Rekap Absensi – {{ $pelatihan->nama_pelatihan }}
            </h2>

            <a href="{{ route('absensi.pdf', $pelatihan->id) }}"
               target="_blank"
               class="px-5 py-2.5 bg-red-600 hover:bg-red-700 
                      active:scale-95 text-white 
                      font-semibold rounded-xl 
                      shadow-lg transition">
                Download PDF
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-200 overflow-x-auto">

            <table class="min-w-full border border-gray-200 rounded-lg text-sm text-gray-700">
                <thead>
                    {{-- HEADER BARIS 1 --}}
                    <tr class="bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 text-center font-semibold">
                        <th rowspan="2" class="border px-3 py-2">No</th>
                        <th rowspan="2" class="border px-3 py-2">Nama</th>
                        <th rowspan="2" class="border px-3 py-2">Jurusan</th>
                        <th colspan="{{ $tanggalList->count() }}" class="border px-3 py-2">
                            Tanggal
                        </th>
                    </tr>

                    {{-- HEADER BARIS 2 --}}
                    <tr class="bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 text-center">
                        @foreach($tanggalList as $tgl)
                            <th class="border px-3 py-2 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($tgl)->translatedFormat('d M y') }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach($pelatihan->pesertas as $peserta)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="border px-3 py-2 text-center font-medium text-gray-600">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border px-3 py-2 font-semibold text-gray-800">
                                {{ $peserta->nama }}
                            </td>
                            <td class="border px-3 py-2 text-gray-600">
                                {{ $peserta->jurusan }}
                            </td>

                            @foreach($tanggalList as $tgl)
                                @php
                                    $absen = $peserta->absensis->where('tanggal', $tgl)->first();
                                    $kode = '-';
                                    $badgeClass = 'text-gray-400';
                                    if ($absen) {
                                        if ($absen->status === 'Hadir') {
                                            $kode = 'H';
                                            $badgeClass = 'text-green-600 font-bold';
                                        } elseif ($absen->status === 'Alpha') {
                                            $kode = 'A';
                                            $badgeClass = 'text-red-600 font-bold';
                                        } elseif ($absen->status === 'Izin') {
                                            $kode = 'I';
                                            $badgeClass = 'text-yellow-600 font-bold';
                                        }
                                    }
                                @endphp
                                <td class="border px-3 py-2 text-center {{ $badgeClass }}">
                                    {{ $kode }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 text-sm text-gray-700">
                <b class="text-green-600">H</b> = Hadir |
                <b class="text-red-600">A</b> = Alpha |
                <b class="text-yellow-600">I</b> = Izin
            </div>

        </div>
    </div>
</x-app-layout>
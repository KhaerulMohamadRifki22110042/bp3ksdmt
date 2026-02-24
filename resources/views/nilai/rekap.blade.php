<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Rekap Nilai
                </h2>
                <p class="text-sm text-gray-500">
                    {{ $pelatihan->nama_pelatihan }}
                </p>
            </div>

            <a href="{{ route('nilai.pdf', $pelatihan->id) }}"
               target="_blank"
               class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition">
                Download PDF
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-left">Nama Peserta</th>
                            <th class="px-4 py-3 text-center">Interpersonal</th>
                            <th class="px-4 py-3 text-center">Intrapersonal</th>
                            <th class="px-4 py-3 text-center">Organisasi</th>
                            <th class="px-4 py-3 text-center">Spiritual</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($pelatihan->pesertas as $peserta)
                            @php
                                $nilai = $peserta->nilais->first();
                            @endphp

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-700">
                                    {{ $peserta->nama }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $nilai->interpersonal ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $nilai->intrapersonal ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $nilai->organisasi ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $nilai->spiritual ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 text-right">
                <a href="{{ route('nilai.index') }}"
                   class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

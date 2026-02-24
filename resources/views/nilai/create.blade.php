<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Input Nilai – {{ $pelatihan->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow">

            <form action="{{ route('nilai.store', $pelatihan->id) }}" method="POST">
                @csrf

                <table class="min-w-full border rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Nama</th>
                            <th class="px-3 py-2">Jurusan</th>
                            <th class="px-3 py-2">Interpersonal</th>
                            <th class="px-3 py-2">Intrapersonal</th>
                            <th class="px-3 py-2">Organisasi</th>
                            <th class="px-3 py-2">Spiritual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelatihan->pesertas as $peserta)
                            @php
                                $nilai = $pelatihan->nilais
                                    ->where('peserta_id', $peserta->id)
                                    ->first();
                            @endphp
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $peserta->nama }}</td>
                                <td class="px-3 py-2">{{ $peserta->jurusan }}</td>

                                <td class="px-3 py-2">
                                    <input type="number" min="0" max="100"
                                        name="interpersonal[{{ $peserta->id }}]"
                                        value="{{ $nilai->interpersonal ?? '' }}"
                                        class="w-20 rounded border-gray-300">
                                </td>

                                <td class="px-3 py-2">
                                    <input type="number" min="0" max="100"
                                        name="intrapersonal[{{ $peserta->id }}]"
                                        value="{{ $nilai->intrapersonal ?? '' }}"
                                        class="w-20 rounded border-gray-300">
                                </td>

                                <td class="px-3 py-2">
                                    <input type="number" min="0" max="100"
                                        name="organisasi[{{ $peserta->id }}]"
                                        value="{{ $nilai->organisasi ?? '' }}"
                                        class="w-20 rounded border-gray-300">
                                </td>

                                <td class="px-3 py-2">
                                    <input type="number" min="0" max="100"
                                        name="spiritual[{{ $peserta->id }}]"
                                        value="{{ $nilai->spiritual ?? '' }}"
                                        class="w-20 rounded border-gray-300">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-6">
                    <button class="px-6 py-2 bg-indigo-600 text-white rounded-lg">
                        Simpan Nilai
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Peserta – {{ $pelatihan->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">

            <form action="{{ route('pelatihan.peserta.store', $pelatihan->id) }}" method="POST">
                @csrf

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left w-20">Pilih</th>
                                <th class="px-4 py-3 text-left">Nama Peserta</th>
                                <th class="px-4 py-3 text-left">Jurusan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pesertas as $peserta)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <input type="checkbox"
                                               name="peserta_id[]"
                                               value="{{ $peserta->id }}"
                                               class="w-4 h-4 text-indigo-600 rounded"
                                               {{ $pelatihan->pesertas->contains($peserta->id) ? 'checked' : '' }}>
                                    </td>

                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        {{ $peserta->nama }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $peserta->jurusan }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                                        Data peserta belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('pelatihan.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Kembali
                    </a>

                    <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow">
                        Simpan Peserta
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

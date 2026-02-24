<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            📄 Sertifikat Pelatihan
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-200">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-center w-16">No</th>
                            <th class="px-6 py-4 text-left">Pelatihan</th>
                            <th class="px-6 py-4 text-center w-56">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach($pelatihans as $p)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-center font-medium text-gray-600">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $p->nama_pelatihan }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('sertifikat.peserta', $p->id) }}"
                                       class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold 
                                              bg-indigo-600 hover:bg-indigo-700 
                                              text-white rounded-lg shadow transition">
                                        👥 Lihat Peserta
                                    </a>
                                @else
                                    <a href="{{ route('sertifikat.show', $p->id) }}"
                                       class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold 
                                              bg-green-600 hover:bg-green-700 
                                              text-white rounded-lg shadow transition">
                                        📄 Lihat Sertifikat
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($pelatihans->isEmpty())
                <p class="text-center py-10 text-gray-400">
                    Belum ada data pelatihan
                </p>
            @endif

        </div>
    </div>
</x-app-layout>
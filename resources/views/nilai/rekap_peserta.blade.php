<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Nilai Saya - {{ $pelatihan->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            @php
                $nilai = $peserta->nilais
                    ->where('pelatihan_id', $pelatihan->id)
                    ->first();
            @endphp

            @if(!$nilai)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow">
                    <p class="font-semibold">Informasi</p>
                    <p>Nilai belum tersedia.</p>
                </div>
            @else
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    
                    <h3 class="text-lg font-semibold text-gray-700 mb-6 border-b pb-2">
                        Detail Nilai Peserta
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="bg-blue-50 p-4 rounded-xl shadow-sm">
                            <p class="text-sm text-gray-500">Interpersonal</p>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ $nilai->interpersonal }}
                            </p>
                        </div>

                        <div class="bg-green-50 p-4 rounded-xl shadow-sm">
                            <p class="text-sm text-gray-500">Intrapersonal</p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $nilai->intrapersonal }}
                            </p>
                        </div>

                        <div class="bg-purple-50 p-4 rounded-xl shadow-sm">
                            <p class="text-sm text-gray-500">Organisasi</p>
                            <p class="text-2xl font-bold text-purple-600">
                                {{ $nilai->organisasi }}
                            </p>
                        </div>

                        <div class="bg-pink-50 p-4 rounded-xl shadow-sm">
                            <p class="text-sm text-gray-500">Spiritual</p>
                            <p class="text-2xl font-bold text-pink-600">
                                {{ $nilai->spiritual }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-8 text-right">
                        <a href="{{ route('nilai.pdf', $pelatihan->id) }}"
                           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-200">
                            Download PDF
                        </a>
                    </div>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>
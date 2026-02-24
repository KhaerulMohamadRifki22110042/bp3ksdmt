<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Pelatihan</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-200 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-6">
            @foreach($pelatihans as $pelatihan)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="font-bold">{{ $pelatihan->nama_pelatihan }}</h3>
                    <p>{{ $pelatihan->tanggal }}</p>

                    @if($peserta && $peserta->pelatihans->contains($pelatihan->id))
                        <button class="mt-3 px-4 py-2 bg-gray-400 text-white rounded" disabled>
                            Sudah Terdaftar
                        </button>
                    @else
                        <form action="{{ route('peserta.pelatihan.daftar', $pelatihan->id) }}" method="POST">
                            @csrf
                            <button class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded">
                                Daftar
                            </button>
                        </form>
                    @endif

                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>

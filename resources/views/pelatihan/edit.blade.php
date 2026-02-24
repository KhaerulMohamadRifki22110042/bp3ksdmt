<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Pelatihan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">

            <form action="{{ route('pelatihan.update', $pelatihan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Pelatihan -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Nama Pelatihan
                    </label>
                    <input type="text"
                           name="nama_pelatihan"
                           value="{{ old('nama_pelatihan', $pelatihan->nama_pelatihan) }}"
                           class="w-full mt-1 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                    @error('nama_pelatihan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">
                        Tanggal
                    </label>
                    <input type="date"
                           name="tanggal"
                           value="{{ old('tanggal', $pelatihan->tanggal) }}"
                           class="w-full mt-1 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                    @error('tanggal')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('pelatihan.index') }}"
                       class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shadow">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>

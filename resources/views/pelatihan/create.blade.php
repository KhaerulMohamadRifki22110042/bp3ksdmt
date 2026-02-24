<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Tambah Pelatihan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

            <form action="{{ route('pelatihan.store') }}" method="POST">
                @csrf

                <!-- Nama Pelatihan -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Pelatihan
                    </label>
                    <input type="text"
                           name="nama_pelatihan"
                           value="{{ old('nama_pelatihan') }}"
                           class="w-full rounded-xl border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">

                    @error('nama_pelatihan')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Mulai
                    </label>
                    <input type="date"
                           name="tanggal_mulai"
                           value="{{ old('tanggal_mulai') }}"
                           class="w-full rounded-xl border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">

                    @error('tanggal_mulai')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Selesai -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Selesai
                    </label>
                    <input type="date"
                           name="tanggal_selesai"
                           value="{{ old('tanggal_selesai') }}"
                           class="w-full rounded-xl border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">

                    @error('tanggal_selesai')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('pelatihan.index') }}"
                       class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-xl
                                   hover:bg-indigo-700 shadow transition">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
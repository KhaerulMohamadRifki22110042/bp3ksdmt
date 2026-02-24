<x-app-layout>
    <h2 class="text-xl font-bold mb-4">
        Tambah Foto - {{ $kegiatan->nama_kegiatan }}
    </h2>

    <form action="{{ route('foto.store', $kegiatan->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <input type="file"
               name="foto[]"
               multiple
               class="border p-2 mb-4 w-full">

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Upload Foto
        </button>
    </form>
</x-app-layout>

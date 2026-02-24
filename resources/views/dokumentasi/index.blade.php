<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Dokumentasi
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola folder dokumentasi kegiatan
                </p>
            </div>

            @auth
                @if(auth()->user()->role === 'admin')
                    <button
                        onclick="openModal()"
                        class="inline-flex items-center gap-2
                               bg-indigo-600 hover:bg-indigo-700
                               text-white px-5 py-2
                               rounded-xl shadow-md transition">
                        ➕ Tambah Folder
                    </button>
                @endif
            @endauth
        </div>

        <!-- CARD CONTAINER -->
        <div class="bg-white rounded-2xl shadow-lg p-6">

            @if($kegiatans->isEmpty())
                <div class="text-center py-16 text-gray-500">
                    Belum ada folder dokumentasi.
                </div>
            @else
                <!-- GRID -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($kegiatans as $kegiatan)
                        <a href="{{ route('dokumentasi.show', $kegiatan->id) }}"
                           class="group bg-gray-50 hover:bg-white
                                  border border-gray-200 hover:border-indigo-500
                                  rounded-xl p-6 text-center
                                  shadow-sm hover:shadow-lg
                                  transition duration-200">

                            <div class="text-5xl mb-4 transition group-hover:scale-110">
                                📁
                            </div>

                            <div class="font-semibold text-gray-800 text-sm truncate">
                                {{ $kegiatan->nama_kegiatan }}
                            </div>

                            <div class="text-xs text-gray-500 mt-2">
                                {{ $kegiatan->foto_count }} foto
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>


    <!-- MODAL TAMBAH -->
    <div id="modalTambah"
         class="hidden fixed inset-0 bg-black bg-opacity-50
                flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl w-full max-w-md p-8 shadow-2xl relative">

            <!-- Close -->
            <button onclick="closeModal()"
                    class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>

            <h3 class="text-xl font-semibold text-gray-800 mb-6">
                Tambah Folder Dokumentasi
            </h3>

            <form action="{{ route('dokumentasi.folder.store') }}" method="POST">
                @csrf

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kegiatan
                </label>

                <input type="text"
                       name="nama_kegiatan"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2
                              focus:ring-2 focus:ring-indigo-300 focus:outline-none mb-6"
                       placeholder="Masukkan nama kegiatan..."
                       required>

                <div class="flex justify-end gap-3">
                    <button type="button"
                            onclick="closeModal()"
                            class="px-4 py-2 rounded-lg border border-gray-300
                                   hover:bg-gray-100 transition">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white
                                   rounded-lg hover:bg-indigo-700
                                   shadow-md transition">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>


    <!-- SCRIPT -->
    <script>
        function openModal() {
            document.getElementById('modalTambah').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            document.getElementById('modalTambah').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // klik background untuk menutup
        document.getElementById('modalTambah').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

</x-app-layout>
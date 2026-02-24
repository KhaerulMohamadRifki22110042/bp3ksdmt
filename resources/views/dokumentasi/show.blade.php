<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-wide flex items-center gap-2">
                    📷 {{ $kegiatan->nama_kegiatan }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Galeri Dokumentasi Kegiatan
                </p>
            </div>

            <a href="{{ route('foto.create', $kegiatan->id) }}"
               class="inline-flex items-center gap-2 px-5 py-2
                      bg-emerald-600 hover:bg-emerald-700
                      text-white text-sm font-semibold
                      rounded-xl shadow-md transition duration-200">
                ➕ Tambah Foto
            </a>
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            @if($kegiatan->foto->isEmpty())
                <div class="text-center py-16 text-gray-500">
                    Belum ada dokumentasi foto.
                </div>
            @else
                <!-- GRID FOTO -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                    @foreach ($kegiatan->foto as $index => $foto)
                        @php
                            $src = url('storage/dokumentasi/'.$kegiatan->id.'/'.$foto->nama_file);
                        @endphp

                        <div class="group relative overflow-hidden rounded-xl shadow-md ring-1 ring-gray-200">
                            <img
                                src="{{ $src }}"
                                class="w-full aspect-square object-cover
                                       group-hover:scale-110 transition duration-300 cursor-pointer"
                                onclick="openModal({{ $index }})"
                            >
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- MODAL -->
    <div id="fotoModal"
         class="hidden fixed inset-0 bg-black bg-opacity-90 backdrop-blur-sm
                flex items-center justify-center z-50 transition-opacity duration-300">

        <div class="relative max-w-6xl w-full px-6 flex flex-col items-center justify-center">

            <!-- Close -->
            <button onclick="closeModal()"
                    class="absolute top-4 right-4 bg-white/20 hover:bg-white/40
                           text-white rounded-full p-2 transition z-50">
                ✖
            </button>

            <!-- Wrapper untuk navigasi + gambar -->
            <div class="relative flex items-center justify-center w-full">
                <!-- Prev -->
                <button onclick="prevImage()"
                        class="absolute left-4 text-white text-4xl font-bold hover:text-gray-300">
                    ‹
                </button>

                <!-- Image -->
                <img id="modalImage"
                     src=""
                     class="mx-auto max-h-[80vh] rounded-2xl shadow-2xl transition-transform duration-300">

                <!-- Next -->
                <button onclick="nextImage()"
                        class="absolute right-4 text-white text-4xl font-bold hover:text-gray-300">
                    ›
                </button>
            </div>

            <!-- Download di bawah foto -->
            <div class="text-center mt-6">
                <a id="downloadLink"
                   href=""
                   download
                   class="inline-flex items-center gap-2 px-6 py-2
                          bg-indigo-600 hover:bg-indigo-700
                          text-white text-sm font-semibold
                          rounded-xl shadow-md transition duration-200">
                    ⬇ Download Foto
                </a>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById('fotoModal');
            const img = document.getElementById('modalImage');
            const link = document.getElementById('downloadLink');

            // simpan semua foto ke array
            const photos = @json($kegiatan->foto->map(fn($f) => url('storage/dokumentasi/'.$kegiatan->id.'/'.$f->nama_file)));
            let currentIndex = 0;

            window.openModal = function (index) {
                currentIndex = index;
                updateModal();
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            window.closeModal = function () {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            window.nextImage = function () {
                currentIndex = (currentIndex + 1) % photos.length;
                updateModal();
            }

            window.prevImage = function () {
                currentIndex = (currentIndex - 1 + photos.length) % photos.length;
                updateModal();
            }

            function updateModal() {
                img.src = photos[currentIndex];
                link.href = photos[currentIndex];
            }

            // klik background untuk menutup
            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        window.closeModal();
                    }
                });
            }
        });
    </script>
</x-app-layout>
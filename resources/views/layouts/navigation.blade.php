{{-- NAVBAR UTAMA --}}
<nav x-data="{ open: false }"
     class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 
            shadow-xl border-b border-blue-700 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- ================= LEFT SIDE ================= --}}
            <div class="flex items-center">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="bg-yellow-500 w-10 h-10 flex items-center 
                                justify-center rounded-full shadow-md 
                                overflow-hidden group-hover:scale-110 transition">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="Logo" 
                             class="w-8 h-8 object-cover">
                    </div>
                    <div class="text-white leading-tight">
                        <div class="font-semibold text-sm tracking-wide">
                            Sistem Pelatihan
                        </div>
                        <div class="text-xs text-blue-200">
                            Pembangunan Karakter
                        </div>
                    </div>
                </a>

                {{-- ===== MENU DESKTOP ===== --}}
                <div class="hidden sm:flex sm:ms-10 space-x-2">

                    <x-nav-link :href="route('dashboard')" 
                        class="menu-item"
                        :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('pelatihan.index')" class="menu-item">Pelatihan</x-nav-link>
                            <x-nav-link :href="route('nilai.index')" class="menu-item">Nilai</x-nav-link>
                            <x-nav-link :href="route('absensi.pilih')" class="menu-item">Absensi</x-nav-link>
                            <x-nav-link :href="route('dokumentasi.index')" class="menu-item">Dokumentasi</x-nav-link>
                            <x-nav-link :href="route('sertifikat.index')" class="menu-item">Sertifikat</x-nav-link>
                        @endif

                        @if(auth()->user()->role === 'pelatih')
                            <x-nav-link :href="route('nilai.index')" class="menu-item">Nilai</x-nav-link>
                            <x-nav-link :href="route('absensi.pilih')" class="menu-item">Absensi</x-nav-link>
                            <x-nav-link :href="route('dokumentasi.index')" class="menu-item">Dokumentasi</x-nav-link>
                        @endif

                        @if(auth()->user()->role === 'peserta')
                            <x-nav-link :href="route('peserta.pelatihan')" class="menu-item">Pelatihan Saya</x-nav-link>
                            <x-nav-link :href="route('nilai.index')" class="menu-item">Nilai</x-nav-link>
                            <x-nav-link :href="route('dokumentasi.index')" class="menu-item">Dokumentasi</x-nav-link>
                            <x-nav-link :href="route('sertifikat.index')" class="menu-item">Sertifikat</x-nav-link>
                        @endif
                    @endauth

                </div>
            </div>

            {{-- ================= RIGHT SIDE ================= --}}
            <div class="flex items-center space-x-4">

                {{-- Role Badge --}}
                <span class="hidden sm:inline-block bg-yellow-500 text-blue-900 
                             text-xs font-semibold px-3 py-1 
                             rounded-full shadow">
                    {{ ucfirst(Auth::user()->role) }}
                </span>

                {{-- User Dropdown Desktop --}}
                <div class="hidden sm:block">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 
                                           text-sm text-white hover:text-yellow-400 transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="#">Profile</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="#"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- ================= HAMBURGER MOBILE ================= --}}
                <button @click="open = !open"
                        class="sm:hidden text-white focus:outline-none relative w-8 h-8">

                    <span class="absolute h-0.5 w-6 bg-white transform transition duration-300"
                          :class="open ? 'rotate-45 top-3' : 'top-2'"></span>

                    <span class="absolute h-0.5 w-6 bg-white transform transition duration-300"
                          :class="open ? 'opacity-0' : 'top-4'"></span>

                    <span class="absolute h-0.5 w-6 bg-white transform transition duration-300"
                          :class="open ? '-rotate-45 top-3' : 'top-6'"></span>
                </button>

            </div>
        </div>
    </div>

    {{-- ================= MOBILE MENU ================= --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="sm:hidden bg-blue-900 border-t border-blue-700">

        <div class="px-5 py-4 space-y-3 text-blue-100">

            <a href="{{ route('dashboard') }}"
               class="mobile-menu">
                Dashboard
            </a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('pelatihan.index') }}" class="mobile-menu">Pelatihan</a>
                    <a href="{{ route('nilai.index') }}" class="mobile-menu">Nilai</a>
                    <a href="{{ route('absensi.pilih') }}" class="mobile-menu">Absensi</a>
                    <a href="{{ route('dokumentasi.index') }}" class="mobile-menu">Dokumentasi</a>
                    <a href="{{ route('sertifikat.index') }}" class="mobile-menu">Sertifikat</a>
                @endif

                @if(auth()->user()->role === 'pelatih')
                    <a href="{{ route('nilai.index') }}" class="mobile-menu">Nilai</a>
                    <a href="{{ route('absensi.pilih') }}" class="mobile-menu">Absensi</a>
                    <a href="{{ route('dokumentasi.index') }}" class="mobile-menu">Dokumentasi</a>
                @endif

                @if(auth()->user()->role === 'peserta')
                    <a href="{{ route('peserta.pelatihan') }}" class="mobile-menu">Pelatihan Saya</a>
                    <a href="{{ route('nilai.index') }}" class="mobile-menu">Nilai</a>
                    <a href="{{ route('dokumentasi.index') }}" class="mobile-menu">Dokumentasi</a>
                    <a href="{{ route('sertifikat.index') }}" class="mobile-menu">Sertifikat</a>
                @endif
            @endauth

            <hr class="border-blue-700">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left py-2 px-3 rounded-lg 
                               hover:bg-red-600 hover:text-white transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>
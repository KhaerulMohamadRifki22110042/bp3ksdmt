<x-guest-layout>

    <!-- Header -->
    <div class="text-center mb-6">
        <div class="flex justify-center mb-3">
            <div class="w-20 h-20 rounded-full flex items-center justify-center shadow-lg bg-white">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Logo Sistem Pelatihan" 
                     class="w-16 h-16 object-contain">
            </div>
        </div>

        <h2 class="text-2xl font-bold text-blue-900">
            Sistem Pelatihan
        </h2>
        <p class="text-gray-500 text-sm">
            Pembangunan Karakter SDM
        </p>
    </div>
    

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">
                Email
            </label>
            <input type="email" name="email"
                value="{{ old('email') }}"
                required autofocus
                class="w-full mt-1 px-4 py-2 border rounded-lg 
                       focus:ring-2 focus:ring-blue-700 focus:border-blue-700 
                       transition"
                placeholder="Masukkan email anda">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">
                Password
            </label>
            <input type="password" name="password"
                required
                class="w-full mt-1 px-4 py-2 border rounded-lg 
                       focus:ring-2 focus:ring-blue-700 focus:border-blue-700 
                       transition"
                placeholder="Masukkan password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember -->
        <div class="flex items-center mb-6">
            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-blue-700 focus:ring-blue-700">
                <span class="ml-2">Ingat Saya</span>
            </label>
        </div>

        <!-- Button Login -->
        <button type="submit"
            class="w-full py-2.5 bg-blue-900 hover:bg-blue-800 
                   text-white font-semibold rounded-lg 
                   shadow-md transition duration-300">
            Login
        </button>

        <!-- Links bawah tombol -->
        <div class="text-center mt-4 space-y-2">

            <a href="{{ route('register') }}" 
               class="text-sm text-blue-700 hover:underline font-medium">
                Belum punya akun? Register
            </a>
        </div>
    </form>

    <!-- Footer -->
    <div class="text-center mt-6 text-xs text-gray-400">
        © {{ date('Y') }} Sistem Informasi Pelatihan Karakter
    </div>
</x-guest-layout>
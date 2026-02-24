<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" 
                    class="block mt-1 w-full"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- NIM -->
            <div class="mb-4">
                <x-input-label for="nim" value="NIM" />
                <x-text-input id="nim" 
                    class="block mt-1 w-full"
                    type="text"
                    name="nim"
                    :value="old('nim')"
                    required />
                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" 
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation"
                    required />
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full py-2.5 bg-blue-900 hover:bg-blue-800 
                       text-white font-semibold rounded-lg 
                       shadow-md transition duration-300">
                Register
            </button>

            <!-- Login Link -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" 
                   class="text-sm text-blue-700 hover:underline font-medium">
                    Sudah punya akun? Login
                </a>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center mt-6 text-xs text-gray-400">
            © {{ date('Y') }} Sistem Informasi Pelatihan Karakter
        </div>

    </div>

</x-guest-layout>
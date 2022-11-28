<x-guest-layout>

    <x-slot name="title">Login</x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/cd-logo.png') }}" class="h-20" />
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />



        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="'E-mail'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                @error('email')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="'Senha'" />

                <x-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                @error('password')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Continuar conectado</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        Esqueceu a senha ?
                    </a>
                @endif

                <x-button class="ml-3" kind="primary">
                    Entrar
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

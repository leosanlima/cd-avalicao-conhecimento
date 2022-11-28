<x-guest-layout>

    <x-slot name="title">Recuperar senha</x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/cd-logo.png') }}" class="h-20" />
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}" novalidate>
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="'E-mail'" />

                <x-input id="email" class="block mt-1 w-full bg-gray-200 not-allowed" type="email" name="email" :value="old('email', $request->email)" required readonly />

                @error('email')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror

            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">
                    Senha
                </label>

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus />

                @error('password')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror

            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                    Confirme a senha
                </label>

                <x-input
                    id="password_confirmation"
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation" required
                />

                @error('password_confirmation')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button kind="primary">
                    Alterar senha
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

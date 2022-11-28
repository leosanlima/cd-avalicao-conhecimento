<x-guest-layout>

    <x-slot name="title">Recuperar senha</x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/cd-logo.png') }}" class="h-20" />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Informe seu e-mail para que seja enviado um link que irá permitir alterar sua senha.
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="'E-mail'" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            @error('email')
            <x-input-error>{{ $message }}</x-input-error>
            @enderror

            <div class="flex items-center justify-end mt-4">
                <x-button kind="primary">
                    Enviar link para o e-mail
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

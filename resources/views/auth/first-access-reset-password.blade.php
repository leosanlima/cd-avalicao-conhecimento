<x-guest-layout>

    <x-slot name="title">Alterar senha</x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/cd-logo.png') }}" class="h-20" />
        </x-slot>

        <h1 class="text-xl font-medium text-gray-600 my-4">
            Altere a senha preenchendo os campos abaixo.
        </h1>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('first-access.update') }}" novalidate>
            @csrf
            @method('PUT')
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="'Senha'" />

                <x-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    placeholder="Digite uma senha"
                    required
                    autocomplete="current-password"
                />
                @error('password')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password_confirm" :value="'Confirme a senha'" />

                <x-input
                    id="password_confirm"
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirm"
                    placeholder="Confirme a senha digitada acima"
                    required
                />
                @error('password_confirm')
                <x-input-error>{{ $message }}</x-input-error>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3" kind="primary" type="submit">
                    Salvar
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

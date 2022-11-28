<x-layouts.default>
    <x-slot name="title">Editar usuário</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Editar usuário</h1>
        </header>

        <div class="w-full mt-5">
            <form action="{{route('usuarios.update', ['user' => $user->id])}}" method="POST" novalidate>
                @method('PUT')
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden px-4 py-5 bg-white space-y-6 sm:p-6 rounded-md clear">
                    <h2 class="text-2xl font-medium text-gray-600 mb-4">Dados pessoais:</h2>
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="name">Nome</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="name"
                                    name="name"
                                    type="text"
                                    placeholder="Digite o nome"
                                    value="{{ old('name', $user->name) }}"
                                    class="flex-1 block w-full"
                                />

                            </div>
                            @error('name')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <p class="font-medium text-gray-600 mb-4">Email: {{ $user->email }}</p>
                        </div>

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="cpf">CPF</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="cpf"
                                    name="cpf"
                                    type="text"
                                    placeholder="Digite o CPF"
                                    value="{{ old('cpf', $user->cpf) }}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('cpf')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <h2 class="text-2xl font-medium text-gray-600 my-4">Perfil:</h2>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full sm:col-span-4 flex rounded p-1.5 text-blue-500">
                            <x-icons.information-circle class="w-6 mr-1"/>
                            <p class="font-medium">
                                Exibindo somente funções disponíveis para o usuário selecionado
                            </p>
                        </div>
                        <div class="col-span-full sm:col-span-4">
                            <x-label for="role">Função:</x-label>

                            <x-select id="role" name="role_id">
                                <option value="">Selecione</option>
                                @foreach($roles as $role)
                                    <option
                                        value="{{ $role->id }}"
                                        {{ old('role_id', $user?->role->id) == $role->id ? 'selected' : ''  }}
                                    >
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('role_id')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        @if(auth()->user()->isAdministrator() || auth()->user()->id === $user->id)
                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="password">Senha <span class="text-sm text-gray-500">(opcional)</span></x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Digita a senha inicial"
                                    value=""
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('password')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="password_confirm">Confirme a senha</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="password_confirm"
                                    name="password_confirm"
                                    type="password"
                                    placeholder="Confirme a senha"
                                    value=""
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('password_confirm')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <h2 class="text-2xl font-medium text-gray-600 my-4">Endereço:</h2>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-start-1 sm:col-end-3 col-span-4">
                            <x-label for="name">CEP</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="cep"
                                    name="cep"
                                    type="text"
                                    placeholder="Digite o CEP"
                                    value="{{old('cep', $user?->address?->cep)}}"
                                    class="flex-1 block w-full"
                                />

                            </div>
                            @error('cep')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <x-label for="state">Rua</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="street"
                                    name="street"
                                    type="text"
                                    placeholder="Digite a nome da rua"
                                    value="{{old('street', $user?->address?->street)}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('street')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <x-label for="cnpj">Bairro</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="neighborhood"
                                    name="neighborhood"
                                    type="text"
                                    placeholder="Digite o nome do bairro"
                                    value="{{old('neighborhood', $user?->address?->neighborhood)}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('neighborhood')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <x-label for="company_name">Cidade</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="city"
                                    name="city"
                                    type="text"
                                    placeholder="Digite a nome da cidade"
                                    value="{{old('city', $user?->address?->city)}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('city')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <x-label for="state">Estado</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="state"
                                    name="state"
                                    type="text"
                                    placeholder="Digite a nome do estado"
                                    value="{{old('state', $user?->address?->state)}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('state')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <x-label for="state">Número</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="address_number"
                                    name="address_number"
                                    type="text"
                                    placeholder="Digite a nome do número"
                                    value="{{old('address_number', $user?->address?->address_number)}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('address_number')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <x-label for="state">Complemento</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="complement"
                                    name="complement"
                                    type="text"
                                    placeholder="Digite um complemento."
                                    value="{{old('complement', $user?->address?->complement)}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('complement')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <x-button type="submit" kind="primary" class="ml-auto">
                        Salvar
                        <x-icons.check></x-icons.check>
                    </x-button>

                </div>
            </form>
        </div>
    </section>

    @push('scripts')
        <script defer>
            window.addEventListener('load', function () {
                HGM.utils.masks.cep('#cep');
                HGM.utils.masks.cpf('#cpf');
                HGM.pages.users.create();
            })
        </script>
    @endpush
</x-layouts.default>

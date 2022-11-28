<x-layouts.default>
    <x-slot name="title">Cadastro de usuário</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Cadastrar usuário</h1>
        </header>

        <div class="w-full mt-5">
            <form action="{{route('usuarios.store')}}" method="POST" novalidate>
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
                                    value="{{old('name')}}"
                                    class="flex-1 block w-full"
                                />

                            </div>
                            @error('name')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="email">E-mail</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="Digite o e-mail"
                                    value="{{old('email')}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('email')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="cpf">CPF</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="cpf"
                                    name="cpf"
                                    type="text"
                                    placeholder="Digite o CPF"
                                    value="{{old('cpf')}}"
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
                        <div class="col-span-full sm:col-span-4">
                            <x-label for="role">Função:</x-label>

                            <x-select id="role" name="role_id">
                                <option value="">Selecione</option>
                                @foreach($roles as $role)
                                    <option
                                        value="{{ $role->id }}"
                                        {{ old('role_id') == $role->id ? 'selected' : ''  }}
                                    >
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('role_id')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-start-1 md:col-span-4 col-span-full">
                            <x-label for="cpf">Senha inicial <span class="text-sm text-gray-500">(opcional)</span></x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Digita a senha inicial"
                                    value="{{old('password')}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('password')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
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
                                    value="{{old('cep')}}"
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
                                    value="{{old('street')}}"
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
                                    value="{{old('neighborhood')}}"
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
                                    value="{{old('city')}}"
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
                                    value="{{old('state')}}"
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
                                    value="{{old('address_number')}}"
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
                                    value="{{old('complement')}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('complement')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div id="allocation-form-section" class="hidden opacity-0 transition-opacity duration-500 ease-in-out ">

                        <h2 class="text-2xl font-medium text-gray-600 mb-4">Alocação:</h2>

                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-full sm:col-span-4">
                                <x-label for="customer_id">Cliente:</x-label>

                                <x-select id="customer_id" name="customer_id">
                                    <option value="">Selecione</option>
                                    @foreach($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : ''  }}
                                    >
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                </x-select>

                                @error('customer_id')
                                <x-input-error>{{ $message }}</x-input-error>
                                @enderror
                            </div>

                            <div class="col-span-full sm:col-span-4">
                                <x-label for="customer_address_id">Endereço:</x-label>

                                <x-select id="customer_address_id" name="customer_address_id" disabled>
                                    <option value="">Selecione</option>
                                    {{-- Filled with JS --}}
                                </x-select>

                                @error('customer_address_id')
                                <x-input-error>{{ $message }}</x-input-error>
                                @enderror
                            </div>

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
                HGM.pages.users.create({!! $customerEmployeeRoles !!}, {{old('customer_address_id') }});
            })
        </script>
    @endpush
</x-layouts.default>

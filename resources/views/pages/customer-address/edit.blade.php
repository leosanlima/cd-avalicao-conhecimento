<x-layouts.default>
    <x-slot name="title">Editar endereço</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Editar endereço</h1>
        </header>


        <div class="w-full mt-5">
            <form action="{{ route('enderecos.update', ['customer_address' => $customerAddress->id]) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 rounded-md clear">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-full sm:col-span-3">
                                <x-label for="customer_id">Cliente:</x-label>

                                <x-select id="customer_id" name="customer_id">
                                    <option>Selecione</option>
                                    @foreach($customers as $customer)
                                        <option
                                            value="{{ $customer->id }}"

                                            {{
                                                (old('customer_id') ?? $customerAddress->customer_id) == $customer->id
                                                    ? 'selected'
                                                    : ''
                                            }}
                                        >
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                @error('customer_id')
                                <x-input-error>{{ $message }}</x-input-error>
                                @enderror
                            </div>

                            <div class="col-start-1 sm:col-end-3 col-span-4">
                                <x-label for="name">CEP</x-label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <x-input
                                        id="cep"
                                        name="cep"
                                        type="text"
                                        placeholder="Digite o CEP"
                                        value="{{old('cep') ?? $customerAddress->cep}}"
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
                                        value="{{old('street') ?? $customerAddress->street}}"
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
                                        value="{{old('neighborhood') ?? $customerAddress->neighborhood}}"
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
                                        value="{{old('city') ?? $customerAddress->city}}"
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
                                        value="{{old('state') ?? $customerAddress->state}}"
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
                                        value="{{old('address_number') ?? $customerAddress->address_number}}"
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
                                        value="{{old('complement') ?? $customerAddress->complement}}"
                                        class="flex-1 block w-full"
                                    />
                                </div>
                                @error('complement')
                                <x-input-error>{{ $message }}</x-input-error>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="ml-auto flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Salvar
                            <x-icons.check></x-icons.check>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @push('scripts')
        <script defer>
            window.addEventListener('load', function () {
                HGM.utils.masks.cep('#cep');
                HGM.pages.enderecos.criar();
            })
        </script>
    @endpush

</x-layouts.default>


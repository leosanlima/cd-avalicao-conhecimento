<x-layouts.default>
    <x-slot name="title">Edição de fornecedores</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Editar fornecedor</h1>
        </header>

        <div class="w-full mt-5">
            <form action="{{ route('fornecedores.update', ['supplier' => $supplier->id]) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 rounded-md clear">

                        <div class="col-span-3 sm:col-span-2">
                            <x-label for="name">Nome</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="name"
                                    name="name"
                                    type="text"
                                    placeholder="Digite o nome do fornecedor"
                                    value="{{old('name') ?? $supplier->name}}"
                                    class="flex-1 block w-full"
                                    required
                                />

                            </div>
                            @error('name')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-2">
                            <x-label for="cnpj">CNPJ</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="cnpj"
                                    name="cnpj"
                                    type="text"
                                    placeholder="Digite o CNPJ"
                                    value="{{old('cnpj') ?? $supplier->cnpj }}"
                                    class="flex-1 block w-full"
                                    required
                                    size="18"
                                />
                            </div>
                            @error('cnpj')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-2">
                            <x-label for="company_name">Razão Social</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="company_name"
                                    name="company_name"
                                    type="text"
                                    placeholder="Digite a Razão Social"
                                    value="{{old('company_name') ?? $supplier->company_name}}"
                                    class="flex-1 block w-full"
                                />
                            </div>
                            @error('company_name')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <button type="submit" class="ml-auto flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Salvar
                            <!-- Heroicon name: check -->
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
                HGM.utils.masks.cnpj('#cnpj');
            })
        </script>
    @endpush

</x-layouts.default>


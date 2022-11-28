<x-layouts.default>
    <x-slot name="title">Cadastro de clientes</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Cadastrar cliente</h1>
        </header>

        <div class="w-full mt-5">
            <form action="{{url('clientes')}}" method="POST" novalidate>
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 rounded-md clear">

                        <div class="col-span-3 sm:col-span-2">
                            <x-label for="name">Nome</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="name"
                                    name="name"
                                    type="text"
                                    placeholder="Digite o nome do cliente"
                                    value="{{old('name')}}"
                                    class="flex-1 block w-full"
                                    required
                                />

                            </div>
                            @error('name')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-2">
                            <x-label for="cpf">CPF</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="cpf"
                                    name="cpf"
                                    type="text"
                                    placeholder="Digite o cpf"
                                    value="{{old('cpf')}}"
                                    class="flex-1 block w-full"
                                    required
                                    size="18"
                                />
                            </div>
                            @error('cpf')
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
                HGM.utils.masks.cpf('#cpf')
            })
        </script>
    @endpush

</x-layouts.default>


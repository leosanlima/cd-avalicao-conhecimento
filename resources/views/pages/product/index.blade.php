<x-layouts.default>
    <x-slot name="title">Listagem de produtos</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Listagem de produtos</h1>
        </header>

        <div class="container mx-auto">
            <div class="py-8">
                    <a href="{{ url('produtos/criar')  }}" class="max-w-max ml-auto flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">
                        <x-icons.plus />
                        Adicionar
                    </a>
                <div class="py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal mx-auto">
                            <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Quantidade
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($productsPagination as $product)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $product->name }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $product->quantity  }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
 
                                        <a href="{{ url("/produtos/{$product->id}/editar") }}" class="mr-1 text-blue-600 hover:text-blue-900">Editar</a>

                                        <a role="button" class="mr-1 text-red-600 hover:text-red-900" x-data @click="$dispatch('open-removeproduct{{ $product->id }}', null)">Remover</a>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                            {{ $productsPagination->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach($productsPagination as $product)
        <x-modals.danger
            title="Remover fornecedor"
            message="
                Tem certeza que deseja remover o produto {{ $product->name }} ? </br>
            "
            show="removeproduct{{ $product->id }}"
            visible="false"
        >
            <form  action="{{ route('produtos.destroy', ['product' => $product->id] ) }}" method="POST" novalidate>
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar
                </button>
                <button
                    type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="removeproduct{{ $product->id }} = false"
                >
                    Cancelar
                </button>
            </form>
        </x-modals.danger>
    @endforeach

</x-layouts.default>

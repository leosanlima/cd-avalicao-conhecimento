<x-layouts.default>
    <x-slot name="title">Listagem de endereços</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Listagem de endereços</h1>
        </header>

        <div class="container mx-auto">
            <div class="py-8">
                @can('create',  App\Models\CustomerAddress::class)
                    <a href="{{ url('enderecos/criar')  }}" class="max-w-max ml-auto flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">
                        <x-icons.plus />
                        Adicionar
                    </a>
                @endcan
                <div class="py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal mx-auto">
                            <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Rua
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Bairro
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Cidade
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($addressesPagination as $address)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $address->street }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $address->neighborhood }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $address->city }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $address->customer->name }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ route('enderecos.edit', ['customer_address' => $address->id]) }}" class="mr-1 text-blue-600 hover:text-blue-900">Editar</a>
                                    <a role="button" class="mr-1 text-red-600 hover:text-red-900" x-data @click="$dispatch('open-removeaddress{{ $address->id }}', null)">Remover</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                            {{ $addressesPagination->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach($addressesPagination as $address)
        <x-modals.danger
            title="Remover endereço"
            message="
                Tem certeza que deseja remover o endereço
                {{ $address->street }}, {{ $address->neighborhood }}, {{ $address->city  }}
                do cliente {{ $address->customer->name }}?"
            show="removeaddress{{ $address->id }}"
            visible="false"
        >
            <form  action="{{ route('enderecos.destroy', ['customer_address' => $address->id] ) }}" method="POST" novalidate>
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar
                </button>
                <button
                    type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="removeaddress{{ $address->id }} = false"
                >
                    Cancelar
                </button>
            </form>
        </x-modals.danger>
    @endforeach

</x-layouts.default>

<x-layouts.default>
    <x-slot name="title">Listagem de usuários</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Listagem de usuários</h1>
        </header>

        <div class="container mx-auto">
            <div class="py-8">
                <a href="{{ route('usuarios.create') }}" class="max-w-max ml-auto flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">
                    <x-icons.plus />
                    Adicionar
                </a>
                <div class="py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal mx-auto">
                            <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nome
                                </th>

                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    E-mail
                                </th>

                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Função
                                </th>

                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->role->name }}</p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if (auth()->user()->isAdministrator() || auth()->user()->id == $user->id)
                                            <a href="{{ route('usuarios.edit', ['user' => $user->id]) }}" class="mr-1 text-blue-600 hover:text-blue-900">Editar</a>
                                        @endif
                                        @if (auth()->user()->id !== $user->id)
                                            @can('administrator')
                                                <a role="button" class="mr-1 text-red-600 hover:text-red-900" x-data @click="$dispatch('open-remove{{ $user->id }}', null)">Remover</a>
                                            @endcan
                                        @endif
                                        @can('associate-customer-address', [$user])
                                            <a href="{{ route('customer-address-association.edit', ['user' => $user->id]) }}" class="mr-1 text-blue-600 hover:text-blue-900 block">Associar endereço do cliente</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach($users as $user)
        <x-modals.danger
            title="Remover usuário"
            message="Tem certeza que deseja remover o usuário {{ $user->name }} ?"
            show="remove{{ $user->id }}"
            visible="false"
        >
            <form action="{{ route('usuarios.destroy', ['user' => $user->id] ) }}" method="POST" novalidate>
                @csrf
                @method('DELETE')
                <x-button kind="danger" class="inline-flex">
                    Confirmar
                </x-button>
                <x-button
                    type="button"
                    class="w-full inline-flex sm:ml-3"
                    @click="remove{{ $user->id }} = false"
                >
                    Cancelar
                </x-button>
            </form>
        </x-modals.danger>
    @endforeach

</x-layouts.default>

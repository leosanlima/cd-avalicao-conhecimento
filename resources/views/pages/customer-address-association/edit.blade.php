<x-layouts.default>
    <x-slot name="title">Associar a endereços de cliente</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Associar a endereços de cliente</h1>
        </header>

        <div class="w-full mt-5">
            <form action="{{ route('customer-address-association.update', ['user' => $user->id]) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 rounded-md clear">
                        <div class="grid grid-cols-3 gap-6">

                            <div class="col-start-1 col-span-full sm:col-span-3">
                                <p class="font-medium text-lg text-gray-600">{{ $user->name }}</p>
                                <p class="font-medium text-gray-400">{{ $user->role->name }}</p>
                            </div>

                            <div class="col-start-1 col-span-full sm:col-span-3">
                                <p class="font-medium text-gray-600">Cliente: {{ $user->customer()->name }}</p>
                                <p class="font-medium text-gray-600 mb-4">CNPJ: {{ $user->customer()->cnpj }}</p>
                            </div>

                            <div class="col-start-1 col-span-full lg:col-span-2">
                                <x-label for="customer-address">Endereços do cliente:</x-label>
                                @if (in_array($user->role->identifier, \App\Models\Role::ALLOWED_ONLY_WITH_ONE_CUSTOMER_ADDRESS_ROLES_IDENTIFIER))
                                    <x-select id="customer-address" name="customerAddresses[]">
                                        <option>Selecione</option>
                                        @foreach($customerAddresses as $customerAddress)
                                            <option
                                                @if(old('customerAddresses', false))
                                                {{  in_array($customerAddress->id, old('customerAddresses')) ? 'selected' : '' }}
                                                @else
                                                {{ $user->hasCustomerAddressAssociated($customerAddress) ? 'selected' : '' }}
                                                @endif
                                                value="{{ $customerAddress->id  }}"
                                            >
                                                {{ $customerAddress?->getFullAddress() }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                @else
                                    <x-multiselect name="customerAddresses[]" id="customer-address">
                                        @foreach($customerAddresses as $customerAddress)
                                            <option
                                                @if(old('customerAddresses', false))
                                                {{  in_array($customerAddress->id, old('customerAddresses')) ? 'selected' : '' }}
                                                @else
                                                {{ $user->hasCustomerAddressAssociated($customerAddress) ? 'selected' : '' }}
                                                @endif
                                                value="{{ $customerAddress->id  }}"
                                            >
                                                {{ $customerAddress?->getFullAddress() }}
                                            </option>
                                        @endforeach
                                    </x-multiselect>
                                @endif

                                @error('customerAddresses')
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
</x-layouts.default>


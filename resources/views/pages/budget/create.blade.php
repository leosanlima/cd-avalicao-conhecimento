<x-layouts.default>
    <x-slot name="title">Cadastro de orçamento</x-slot>

    <section class="container mx-auto">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">Cadastrar orçamento</h1>
        </header>

        <div class="w-full mt-5">
            <form action="{{url('orcamentos')}}" method="POST" novalidate>
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
                                    placeholder="Digite o nome do orçamento"
                                    value="{{old('name')}}"
                                    class="flex-1 block w-full"
                                    required
                                />

                            </div>
                            @error('name')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-4">
                            <x-label for="customer_id">Cliente:</x-label>

                            <x-select id="customer_id" name="customer_id">
                                <option value="">Selecione</option>
                                @foreach($customers as $customer)
                                    <option
                                        value="{{ $customer->id  }}"
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
                            <x-label for="supplier_id">Fornecedor:</x-label>

                            <x-select id="supplier_id" name="supplier_id">
                                <option value="">Selecione</option>
                                @foreach($suppliers as $supplier)
                                    <option
                                        value="{{ $supplier->id  }}"
                                        {{ old('supplier_id') == $supplier->id ? 'selected' : ''  }}
                                    >
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('supplier_id')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-4">
                            <x-label for="product_id">Produto:</x-label>

                            <x-select id="product_id" name="product_id">
                                <option value="">Selecione</option>
                                @foreach($products as $product)
                                    <option
                                        value="{{ $product->id  }}"
                                        {{ old('product_id') == $product->id ? 'selected' : ''  }}
                                    >
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('product_id')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>


                        <div class="col-span-3 sm:col-span-2">
                            <x-label for="quantity">Quantidade</x-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-input
                                    id="quantity"
                                    name="quantity"
                                    type="text"
                                    placeholder="1.000"
                                    value="{{ only_numbers(old('quantity')) }}"
                                    class="flex-1 block w-full"
                                    required
                                    size="9"
                                    max="9"
                                />
                            </div>
                            @error('quantity')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-4">
                            <x-label for="status">Status:</x-label>

                            <x-select id="status" name="status">
                                <option value="">Selecione</option>
                                @foreach($budgetStatusOptions as $key => $status)
                                    <option
                                        value="{{ $key  }}"
                                        {{ old('status') == $key ? 'selected' : ''  }}
                                    >
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('status')
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
                HGM.utils.masks.number('#quantity')
            })
        </script>
    @endpush

</x-layouts.default>


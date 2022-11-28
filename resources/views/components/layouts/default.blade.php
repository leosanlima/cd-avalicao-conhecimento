<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?  $title.' | ' : ''}} {{config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @stack('styles')
</head>
<body class="font-sans antialiased min-h-screen">
    <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
        <x-navbar>
            <x-nav-link href="/dashboard">Início</x-nav-link>
            <x-nav-link href="/usuarios">Usuários</x-nav-link>
            
            
            <x-dropdown width="w-full">
                <x-slot name="trigger">
                    <button class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        <span>Clientes</span>
                        <x-icons.arrow-animated state="open" />
                    </button>
                </x-slot>

                <x-slot name="content">

                            <x-nav-link href="/clientes">Lista de clientes</x-nav-link>



                            <x-nav-link href="/enderecos">Lista de endereços</x-nav-link>

                </x-slot>
            </x-dropdown>
        
            <x-nav-link href="/fornecedores">Fornecedores</x-nav-link>
            <x-nav-link href="/produtos">Produtos</x-nav-link>
            <x-nav-link href="/orcamentos">Orçamentos</x-nav-link>
            

            

        </x-navbar>
        <!-- Page Content -->

        <x-loading.loading-bar />

        <main class="py-4 sm:py-12 px-2 w-full">
            {{ $slot }}
        </main>

        <x-layouts.session-messages />

    </div>
</div>
@stack('scripts')
</body>
</html>

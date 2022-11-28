        <div @click.away="open = false" class="flex flex-col w-full md:w-64 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
            {{--      Brand     --}}
            <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
                <a href="/" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:shadow-outline sm:m-auto">
                    <img src="{{ asset('img/cd-logo.png') }}" />
                </a>

                {{--      Menu Icon     --}}
                <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                    <x-icons.menu />
                </button>

            </div>

            {{--     Navigation       --}}
            <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
                <x-dropdown width="w-full">

                    <x-slot name="trigger">
                        <button class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <div>
                                <p>{{ Auth::user()->name }}</p>
                                <p class="font-bold text-gray-800 mt-2">{{ Auth::user()->role->name }}</p>
                                <p class="font-medium text-gray-600">{{ Auth::user()->email }}</p>
                            </div>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline ml-auto w-4 h-4 mt-1 ml-1 transition-transform duration-100 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <hr />
                    </x-slot>

                    <x-slot name="content">
                        {{--<x-nav-link href="#">Perfil</x-nav-link>--}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link
                                href="route('logout')"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();"
                            >
                                <span class="inline">Sair</span>
                                <x-icons.logout class="inline-block ml-2 w-5 h-5 text-gray-800" />
                            </x-nav-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                {{ $slot }}
            </nav>
        </div>

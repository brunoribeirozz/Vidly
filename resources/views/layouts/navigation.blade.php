<nav x-data="{ open: false }" class="bg-aurora-deep ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('series.index') }}">
                        <x-application-logo class="block h-9 w-auto text-aurora-light fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ">
                    <!-- No PC -->
                    <x-nav-link :href="route('series.index')" :active="request()->routeIs('series.index')" class="bg-aurora-card hover:border-gray-50 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Series') }}
                    </x-nav-link>

                    <x-nav-link :href="route('series.create')" :active="request()->routeIs('series.create')" class="bg-aurora-card hover:border-gray-50 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Add') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <div class="flex items-center space-x-4">
                            {{-- Nome do Usuário --}}
                            <div class="text-sm font-medium text-aurora-light bg-black/20 px-3 py-2 rounded-md">
                                {{ Auth::user()->name ?? 'Guest'}}
                            </div>

                            {{-- Botão Logout --}}
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="text-sm font-bold text-white hover:text-red-500 transition duration-150 ease-in-out uppercase leading-none">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>

                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-red-400 hover:bg-red-500/10 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('series.index')" :active="request()->routeIs('series.index')">
                {{ __('Series') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? 'Guest' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? 'Guest'}}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>

<nav x-data="{ open: false }" class="bg-aurora-deep shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('series.index') }}">
                        <x-application-logo class="w-10 h-10" color="white"/>
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('series.index')" :active="request()->routeIs('series.index')"
                                class="text-white font-black uppercase tracking-widest hover:text-white/70 transition">
                        {{ __('Series') }}
                    </x-nav-link>

                    {{-- só o adm pode ver esse botão --}}
                    @if(auth()->user()->is_admin)
                        <x-nav-link :href="route('series.create')" :active="request()->routeIs('series.create')"
                                    class="text-white font-black uppercase tracking-widest hover:text-white/70 transition">
                            {{ __('Add') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center focus:outline-none group relative">

                            <div class="flex items-center pl-10 pr-4 py-1.5 bg-white hover:bg-gray-50 rounded-xl transition-all duration-300 shadow-md border border-gray-100 ml-5">
                                   <span
                                         class="text-[11px] font-black tracking-widest text-aurora-deep uppercase whitespace-nowrap">
                                            {{ Auth::user()->name ?? 'Guest' }}
                                   </span>
                            </div>

                            <div
                                class="absolute left-0 w-10 h-10 flex-shrink-0 rounded-full overflow-hidden ring-2 ring-violet-900 ring-offset-2 ring-offset-white bg-white shadow-lg">
                                <img src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="w-full h-full object-cover bg-white">
                            </div>

                            <div>
                            </div>
                        </button>
                    </x-slot>


                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"
                                         class="font-bold uppercase text-xs tracking-widest">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full px-4 py-2 text-start text-xs font-black uppercase tracking-widest leading-5 text-red-400 hover:bg-red-500/10 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-black/20 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-aurora-deep border-t border-white/5">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('series.index')" :active="request()->routeIs('series.index')"
                                   class="text-white font-black uppercase tracking-widest">
                {{ __('Series') }}
            </x-responsive-nav-link>

            @if(auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('series.create')" :active="request()->routeIs('series.create')"
                                       class="text-white font-black uppercase tracking-widest">
                    {{ __('Add') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="px-4">
                <div
                    class="font-black text-base text-aurora-light uppercase tracking-widest">{{ Auth::user()->name ?? 'Guest' }}</div>
                <div class="font-medium text-sm text-aurora-light/50">{{ Auth::user()->email ?? 'Guest'}}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                                       class="text-white/70 font-bold uppercase text-xs tracking-widest">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="text-red-400 font-bold uppercase text-xs tracking-widest">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

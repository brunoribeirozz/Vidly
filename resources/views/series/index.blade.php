<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            {{-- Título --}}
            <h2 class="font-bold text-2xl text-aurora-vibrant leading-tight tracking-tighter">
                {{ __('My Series Library') }}
            </h2>

            {{-- Barra de Pesquisa --}}
            <form action="{{ route('series.index') }}" method="GET" class="relative w-full md:w-80">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search for a series..."
                       class="w-full bg-aurora-light border border-gray-300 text-aurora-dark text-sm rounded-xl py-2 pl-10 pr-4 focus:border-aurora-vibrant focus:ring-1 focus:ring-aurora-vibrant transition-all placeholder-gray-600 shadow-sm hover:shadow-gray-400 duration-300 group">

                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-aurora-deep">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>

        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="shadow-gray-500 shadow-2xl  overflow-hidden sm:rounded-2xl mt-10">

                <div class="max-h-[650px] overflow-y-auto custom-scrollbar p-6">
                    <div class="text-aurora-light">
                        @include('series.partials.list')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-aurora-vibrant leading-tight">
            {{ __('My Series Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-aurora-card border border-gray-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-aurora-light">
                    @include('series.partials.list')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

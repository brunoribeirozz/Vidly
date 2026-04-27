<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-aurora-vibrant leading-tight">
            {{ __('Edit Series:') }} <span class="text-aurora-deep">{{ $series->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-aurora-light min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-aurora-card overflow-hidden shadow-2xl sm:rounded-xl p-8 border border-white/5">

                <form action="{{ route('series.update', $series) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Name --}}
                        <div>
                            <x-input-label for="name" :value="__('Series Title')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name', $series->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Description --}}
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full border-white/10 bg-gray-300 text-aurora-dark rounded-md shadow-sm focus:border-aurora-vibrant focus:ring-aurora-vibrant"
                            >{{ old('description', $series->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        {{-- Thumbnail --}}
                        <div>
                            <x-input-label for="thumbnail" :value="__('Thumbnail URL')" />
                            <x-text-input id="thumbnail" name="thumbnail" type="text" class="mt-1 block w-full"
                                          :value="old('thumbnail', $series->thumbnail)" />
                            <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end space-x-6">
                        <a href="{{ route('series.index') }}" class="text-sm font-medium text-white/40 hover:text-aurora-light transition">
                            Cancel
                        </a>
                        <x-primary-button class="bg-aurora-vibrant hover:bg-aurora-deep">
                            {{ __('Update Series') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

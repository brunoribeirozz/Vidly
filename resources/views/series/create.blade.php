<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-aurora-vibrant leading-tight">
{{ __('Add New Series') }}
</h2>
</x-slot>

<div class="py-12 bg-aurora-light min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-aurora-card overflow-hidden shadow-gray-500 shadow-2xl sm:rounded-xl p-8 border border-gray/90">

            {{-- Mensagens de Erro --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-aurora-deep/20 border border-aurora-vibrant/50 text-aurora-vibrant rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('series.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-aurora-deep mb-2">Series Title</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full rounded-md border-white/10 bg-gray-200 text-aurora-dark shadow-sm focus:border-aurora-vibrant focus:ring-aurora-vibrant placeholder-gray-700"
                               placeholder="Ex: Breaking Bad">
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-aurora-deep mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full rounded-md border-white/10 bg-gray-200 text-aurora-dark shadow-sm focus:border-aurora-vibrant focus:ring-aurora-vibrant placeholder-gray-700"
                                  placeholder="A high school chemistry teacher..."></textarea>
                    </div>

                    {{-- Thumbnail --}}
                    <div>
                        <label for="thumbnail" class="block text-sm font-semibold text-aurora-deep mb-2">Thumbnail URL</label>
                        <input type="text" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}"
                               class="w-full rounded-md border-white/10 bg-gray-200 text-aurora-dark shadow-sm focus:border-aurora-vibrant focus:ring-aurora-vibrant placeholder-gray-700"
                               placeholder="https://image.url">
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end space-x-6">
                    <a href="{{ route('series.index') }}" class="text-[16px] font-bold text-aurora-dark hover:text-aurora-deep transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex justify-center rounded-md bg-aurora-deep py-2.5 px-8 text-sm font-bold text-white shadow-[0_0_20px_rgba(139,50,244,0.4)] hover:bg-aurora-vibrant focus:outline-none focus:ring-2 focus:ring-aurora-vibrant transition-colors duration-300">
                        Save Series
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>

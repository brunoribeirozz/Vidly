<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-aurora-vibrant leading-tight">
            Edit Episode #{{ $episode->number }}
        </h2>
    </x-slot>

    <div class="py-12 bg-aurora-light min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-aurora-card p-8 rounded-xl border border-white/5 shadow-2xl">
                <form action="{{ route('seasons.episodes.update', [$season, $episode]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Title --}}
                        <div>
                            <x-input-label for="title" value="Episode Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $episode->title)" required />
                        </div>

                        {{-- Duration --}}
                        <div>
                            <x-input-label for="duration" value="duration (ex: 45:00)" />
                            <x-text-input id="duration" name="duration" type="text" class="mt-1 block w-full" :value="old('duration', $episode->duration)" />
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('seasons.episodes.index', $season) }}" class="text-sm text-aurora-dark hover:text-aurora-deep py-2 transition font-semibold">Cancel</a>
                        <x-primary-button>Update Episode</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

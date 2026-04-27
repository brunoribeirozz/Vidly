<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-aurora-vibrant leading-tight">
                Episodes: Season {{ $season->number }}
            </h2>
            <form action="{{ route('seasons.episodes.store', $season) }}" method="POST">
                @csrf
                <button type="submit"
                        class="bg-aurora-deep hover:bg-aurora-vibrant text-white px-4 py-2 rounded font-bold uppercase text-xs transition">
                    + Add Episode
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-aurora-light min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-aurora-card rounded-xl border border-gray-400 shadow-2xl overflow-hidden">
                <ul class="divide-y divide-white/5">
                    @forelse ($episodes as $episode)

                        <li class="p-4 flex justify-between items-center hover:bg-white/[0.02] transition">

                            <div class="flex items-center space-x-4">
                                <span class="text-aurora-vibrant font-black text-lg w-8">{{ $episode->number }}</span>
                                <span class="text-aurora-dark font-medium">{{ $episode->title }}</span>
                            </div>

                            <div class="flex items-center space-x-6">

                                <form action="{{ route('seasons.episodes.destroy', [$season, $episode]) }}" method="POST" class="m-0 flex items-center">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('seasons.episodes.edit', [$season, $episode]) }}"
                                       class="text-[11px] px-2 py-1 font-black uppercase text-gray-500 hover:text-aurora-vibrant transition-all leading-none">
                                        Edit
                                    </a>

                                    <button type="submit"
                                            onclick="return confirm('Delete this episode?')"
                                            class="text-[11px] px-2 py-1 font-black uppercase text-red-500/70 hover:text-red-500 transition-all leading-none">
                                        Remove
                                    </button>
                                </form>

                                <span class="bg-black/40 text-white px-2 py-1 rounded text-xs font-mono">
                                    {{ $episode->duration ?? '--:--' }}
                                </span>
                            </div>
                        </li>


                    @empty
                        <li class="p-8 text-center text-aurora-deep font-semibold">No episodes added yet.</li>
                    @endforelse
                </ul>
            </div>

            <div class="mt-6">
                <a href="{{ route('series.seasons.index', $season->serie_id) }}"
                   class="text-aurora-vibrant hover:underline text-sm font-bold">
                    ← Back to Seasons
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

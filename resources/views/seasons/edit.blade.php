<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-aurora-vibrant leading-tight tracking-tighter">
            Edit Season: {{ $season->number }}<span class="text-white/20">—</span>{{ $series->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-aurora-light min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-aurora-card p-8 rounded-2xl border shadow-gray-400 shadow-2xl ">

                <form action="{{ route('series.seasons.update', [$series, $season]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Número da Temporada --}}
                        <div>
                            <x-input-label for="number" value="Season Number" class="text-aurora-vibrant font-black uppercase text-xs tracking-widest" />
                            <x-text-input id="number" name="number" type="number" class="mt-2 block w-full bg-aurora-dark border-white/10 text-aurora-dark focus:border-aurora-vibrant focus:ring-aurora-vibrant rounded-xl" :value="old('number', $season->number)" required />
                            <p class="mt-2 text-sm text-gray-800">Change the sequence number of this season.</p>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-end items-center space-x-6">
                        <a href="{{ route('series.seasons.index', $series) }}" class="text-xs font-black uppercase text-aurora-dark hover:text-aurora-deep transition tracking-widest">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 bg-aurora-deep hover:bg-aurora-vibrant text-white font-black uppercase text-xs tracking-widest rounded-xl transition-all shadow-[0_0_20px_rgba(139,50,244,0.3)]">
                            Update Season
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

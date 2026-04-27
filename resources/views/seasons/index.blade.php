<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-aurora-vibrant leading-tight">
                Seasons of {{ $serie->name }}
            </h2>

            <form action="{{ route('seasons.store', $serie) }}" method="POST">
                @csrf
                <button type="submit" class="bg-aurora-deep hover:bg-aurora-vibrant text-white px-4 py-2 rounded shadow-lg font-bold uppercase text-xs transition">
                    + Add Season
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-aurora-light min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensagem de Sucesso (Boas Práticas) --}}
            @if(session('message.success'))
                <div class="mb-6 p-4 bg-green-900/20 border border-green-500/50 text-green-400 rounded-lg">
                    {{ session('message.success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse ($seasons as $season)
                    <div class="bg-aurora-card p-6 rounded-xl border border-white/5 shadow-xl group hover:border-aurora-vibrant transition duration-300">
                        <div class="flex flex-col items-center text-center">
                            <span class="text-4xl font-black text-aurora-vibrant mb-2">
                                {{ $season->number }}
                            </span>
                            <h3 class="text-gray-800 font-bold uppercase text-sm tracking-widest">
                                Season
                            </h3>

                            {{-- Link para os episódios (Próximo passo) --}}
                            <a href="#" class="mt-6 text-xs font-bold text-white/30 group-hover:text-aurora-dark transition uppercase">
                                Show episodes →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-aurora-deep font-bold">
                        No seasons registered yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                <a href="{{ route('series.index') }}" class="text-aurora-vibrant hover:underline text-sm font-bold">
                    ← Home
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

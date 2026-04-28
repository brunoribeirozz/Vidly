<div class="p-6">
    <ul class="space-y-4">
        @forelse ($series as $serie)

            <li class="p-4 flex flex-row justify-between items-center bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-gray-400 transition-all duration-300 group">

                <div class="flex items-center space-x-6">

                    <a href="{{ route('series.seasons.index', $serie) }}"
                       class="shrink-0 overflow-hidden rounded-xl w-44 h-32 border border-black/5">

                        {{-- Lógica de Fallback: verifica se existe thumbnail e se não é apenas um link quebrado --}}
                        @if(!empty($serie->thumbnail) && strlen($serie->thumbnail) > 5)
                            <img src="{{ $serie->thumbnail }}"
                                 alt="{{ $serie->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                        @else
                            {{-- Logo V (Fallback) --}}
                            <div class="w-full h-full bg-gradient-to-br from-aurora-deep to-aurora-vibrant flex items-center justify-center transition-transform duration-500 ease-in-out group-hover:scale-110">
                                <x-application-logo class="w-12 h-12 text-white opacity-50 group-hover:opacity-100 transition-opacity" />
                            </div>
                        @endif
                    </a>

                    <div class="flex flex-col">
                        <h3 class="text-xl font-black text-aurora-deep tracking-tighter">
                            {{ $serie->name }}
                        </h3>

                        <div class="my-1">
                            <span class="text-[12px] text-gray-900 font-bold uppercase tracking-widest">
                                {{ $serie->seasons->count() }} Seasons • {{ $serie->episodes_count }} Episodes
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 line-clamp-1 max-w-xs">
                            {{ $serie->description ?? 'No description available' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 w-48 flex-shrink-0 ml-6">
                    <form action="{{ route('series.destroy', $serie) }}" method="POST" class="m-0 flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to remove {{ $serie->name }}?')"
                                class="text-xs font-black uppercase text-gray-400 hover:text-red-500 transition-colors leading-none">
                            Remove
                        </button>
                    </form>

                    <a href="{{ route('series.edit', $serie) }}"
                       class="text-xs font-black uppercase text-gray-400 hover:text-aurora-vibrant transition-colors leading-none">
                        Edit
                    </a>
                </div>
            </li>
        @empty
            <li class="py-12 text-center text-gray-400 font-bold uppercase text-xs tracking-widest">
                No series found. <a href="{{ route('series.create') }}" class="text-aurora-vibrant hover:underline">Add
                    one!</a>
            </li>
        @endforelse
    </ul>
</div>

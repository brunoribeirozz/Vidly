<div class="p-6">
    <ul class="divide-y divide-white/10">
        @forelse ($series as $serie)
            <li class="py-4 flex justify-between items-center group">
                <div class="flex items-center space-x-4">

                    {{-- Espaço da Thumb --}}
                    <a href="{{ route('series.seasons.index', $serie) }}" class="shrink-0">
                        <div class="w-44 h-36 flex-shrink-0 overflow-hidden rounded shadow-lg border border-white/5 group">
                            @if($serie->thumbnail)
                                <img src="{{ $serie->thumbnail}}"
                                     alt="{{ $serie->name}}"
                                     class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                            @else
                                {{-- Logo V --}}
                                <div class="w-full h-full bg-gradient-to-br from-aurora-deep to-aurora-vibrant flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                                    <x-application-logo class="w-12 h-12 text-aurora-light opacity-50 group-hover:opacity-100 transition-opacity" />
                                </div>
                            @endif
                        </div>

                    </a>

                    <div class="flex flex-col">
                        <a href="{{ route('series.seasons.index', $serie) }}" class="group/title">
                            <span class="text-lg font-bold text-aurora-deep group-hover/title:text-aurora-vibrant transition-colors">
                                {{ $serie->name }}
                            </span>
                        </a>

                        <div class="flex flex-col">
                            <span class="text-xs text-aurora-dark font-semibold uppercase tracking-widest">
                                {{ $serie->seasons->count() }} Seasons • {{ $serie->episodes_count }} Episodes
                            </span>
                        </div>

                        <span class="text-xs text-aurora-dark line-clamp-1 max-w-xs">
                            {{ $serie->description ?? 'No description available' }}
                        </span>
                    </div>
                </div>

                <div class=" items-center inline-flex space-x-4">

                    <form action="{{ route('series.destroy', $serie) }}" method="POST" class="m-0 flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to remove {{ $serie->name }}?')"
                                class="text-gray-500 hover:text-red-500 transition font-bold uppercase text-[16px]">
                            Remove
                        </button>
                    </form>

                    <a href="{{ route('series.edit', $serie) }}" class="text-[16px] font-bold uppercase text-gray-500 hover:text-blue-700 transition-colors">
                        Edit
                    </a>

                </div>
            </li>
        @empty
            <li class="py-8 text-center text-gray-800">
                No series found. <a href="{{ route('series.create') }}" class="text-aurora-vibrant hover:underline not-italic font-bold">Add your first one!</a>
            </li>
        @endforelse
    </ul>
</div>





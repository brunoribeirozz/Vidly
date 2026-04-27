<div class="p-6">
    <ul class="divide-y divide-white/10">
        @forelse ($series as $serie)
            <li class="py-4 flex justify-between items-center group">
                <div class="flex items-center space-x-4">

                    {{-- Espaço da Thumbnail --}}
                    <a href="{{ route('seasons.index', $serie) }}" class="shrink-0">
                    <div class="w-44 h-36 flex-shrink-0 overflow-hidden rounded shadow-lg border border-white/5">
                        @if($serie->thumbnail)
                            {{-- Se existir imagem, exibe ela --}}
                            <img src="{{ $serie->thumbnail }}" alt="{{ $serie->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            {{-- se nãou tiver, exibe um fallback, de inicio usei um quadrado roxo --}}
                            <div class="w-full h-full bg-aurora-deep flex items-center justify-center text-aurora-vibrant font-bold">
                                {{ substr($serie->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    </a>

                    <div class="flex flex-col">
                        <a href="{{ route('seasons.index', $serie) }}" class="group/title">
                            <span class="text-lg font-semibold text-aurora-deep group-hover/title:text-aurora-vibrant transition-colors">
                                {{ $serie->name }}
                            </span>
                        </a>

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
                                class="text-aurora-dark hover:text-red-500 transition font-bold uppercase text-[16px]">
                            Remove
                        </button>
                    </form>

                    <a href="{{ route('series.edit', $serie) }}" class="text-[16px] font-bold uppercase text-black hover:text-blue-700 transition-colors">
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





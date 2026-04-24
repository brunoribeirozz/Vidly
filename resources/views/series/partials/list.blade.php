<div class="p-6"> {{-- Removi o text-aurora-deep daqui para não dar conflito --}}
    <ul class="divide-y divide-white/10">
        @forelse ($series as $serie)
            <li class="py-4 flex justify-between items-center group">
                <div class="flex items-center space-x-4">

                    {{-- Espaço da Thumbnail --}}
                    <div class="w-44 h-36 flex-shrink-0 overflow-hidden rounded shadow-lg border border-white/5">
                        @if($serie->thumbnail)
                            {{-- Se existir imagem, exibe ela --}}
                            <img src="{{ $serie->thumbnail }}" alt="{{ $serie->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            {{-- Se não existir, exibe o fallback roxo que você já criou --}}
                            <div class="w-full h-full bg-aurora-deep flex items-center justify-center text-aurora-vibrant font-bold">
                                {{ substr($serie->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col">
                        <span class="text-lg font-semibold text-aurora-deep group-hover:text-aurora-vibrant transition-colors">
                            {{ $serie->name }}
                        </span>
                        {{-- Pequeno detalhe de "Boas Práticas": mostrar a descrição curta se houver --}}
                        <span class="text-xs text-aurora-dark line-clamp-1 max-w-xs">
                            {{ $serie->description ?? 'No description available' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-4">

                    <form action="{{ route('series.destroy', $serie) }}" method="POST" class="flex items-center m-0 p-0" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs font-bold uppercase text-black hover:text-red-600 transition leading-none">
                            Remove
                        </button>
                    </form>

                    <a href="{{ route('series.edit', $serie) }}" class="text-xs font-bold uppercase text-black hover:text-blue-700 transition-colors">
                        Edit
                    </a>

                    <a href="#" class="text-xs font-bold uppercase text-aurora-deep hover:text-aurora-vibrant transition">
                        Seasons</a>

                </div>
            </li>
        @empty
            <li class="py-8 text-center text-aurora-light/50 italic">
                No series found. <a href="{{ route('series.create') }}" class="text-aurora-vibrant hover:underline not-italic font-bold">Add your first one!</a>
            </li>
        @endforelse
    </ul>
</div>


<div class="p-6">
    <ul class="space-y-4">
        @forelse ($series as $serie)

            <li class="p-4 flex flex-col justify-between items-center group bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-gray-500 transition-all duration-300 relative">

                <div class="absolute top-4 right-4 flex items-center space-x-2 z-10 mb-6">
                        <a href="{{ route('series.reviews.create', $serie) }}"
                           class="p-2 hover:bg-aurora-vibrant hover:text-white text-gray-400 rounded-lg transition-all shadow-sm "
                           title="Write a Review">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                </div>

                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6 w-full">
                    {{-- Thumbnail --}}
                    <a href="{{ route('series.seasons.index', $serie) }}"
                       class="shrink-0 overflow-hidden rounded-xl w-44 h-32 border border-black/5">
                        @if(!empty($serie->thumbnail) && strlen($serie->thumbnail) > 5)
                            <img src="{{ $serie->thumbnail }}" alt="{{ $serie->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-aurora-deep to-aurora-vibrant flex items-center justify-center transition-transform duration-500 ease-in-out group-hover:scale-110">
                                <x-application-logo class="w-10 h-10" color="white"/>
                            </div>
                        @endif
                    </a>

                    {{-- Container de Texto --}}
                    <div class="flex flex-col justify-between h-auto md:h-32 flex-1 min-w-0 w-full">
                        <div class="w-full">
                            <h3 class="text-xl font-black text-aurora-deep tracking-tighter truncate uppercase leading-none">
                                {{ $serie->name }}
                            </h3>

                            <div class="flex flex-col md:flex-row md:items-center justify-between w-full mt-2 md:mt-1 space-y-2 md:space-y-0">
                                <span class="text-[13px] text-gray-900 font-bold uppercase tracking-widest">
                                    {{ $serie->seasons_count }} {{ Str::plural('Season', $serie->seasons_count) }}
                                        •
                                    {{ $serie->episodes_count }} {{ Str::plural('Episode', $serie->episodes_count) }}

                                    @if($serie->reviews_count > 0)
                                        <span class="ml-2 text-yellow-500 font-black">
                                            ★ {{ number_format($serie->reviews_avg_stars, 1) }}
                                            <span class="text-[10px] text-gray-400 font-normal">({{ $serie->reviews_count }})</span>
                                        </span>
                                    @endif
                                </span>

                                @if(auth()->user()->is_admin)
                                    <div class="flex items-center space-x-4 mt-2">
                                        <a href="{{ route('series.edit', $serie) }}"
                                           class="text-[13px] md:text-xs font-black uppercase text-gray-400 hover:text-aurora-vibrant transition-colors leading-none mt-4">
                                            Edit
                                        </a>

                                        <form action="{{ route('series.destroy', $serie) }}" method="POST" class="flex items-center mt-4">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="text-[13px] md:text-xs font-black uppercase text-gray-400 hover:text-red-500 transition-colors leading-none">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <p class="text-[12px] text-gray-600 font-medium tracking-normal line-clamp-2 mt-2 mb-2">
                                {{ Str::limit($serie->description ?? 'No description available.', 130) }}
                            </p>
                        </div>

                        {{-- Barra de progresso --}}
                        <div class="w-full mt-4 md:mt-auto">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-[11px] font-black uppercase text-aurora-vibrant tracking-widest">Progress</span>
                                <span class="text-[11px] font-bold text-gray-900">{{ $serie->progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-aurora-vibrant h-1.5 rounded-full shadow-[0_0_10px_rgba(139,50,244,0.3)] transition-all duration-1000"
                                     style="width: {{ $serie->progress }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="py-12 text-center text-gray-400 font-bold uppercase text-xs tracking-widest">No series found.</li>
        @endforelse
    </ul>
</div>

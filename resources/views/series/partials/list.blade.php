
<div class="p-6">
    <ul class="space-y-4">
        @forelse ($series as $serie)

            <li class="p-4 flex flex-col justify-between items-center group bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-gray-500 transition-all duration-300 relative">

                <div class="absolute top-4 right-4 flex items-center space-x-2 z-10 mb-6">

                    @if(auth()->user()->is_admin)
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('series.edit', $serie) }}"
                               class="text-[13px] md:text-xs font-black uppercase text-gray-400 hover:text-blue-700 transition-colors duration-300 leading-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>

                            <form action="{{ route('series.destroy', $serie) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('DELETE')
                                <button x-data="{ confirmDelete: false }"
                                        :class="confirmDelete ? 'text-red-500 scale-110 animate-pulse' : 'text-gray-400'"
                                        @click.prevent="if (!confirmDelete) { confirmDelete = true; setTimeout(() => confirmDelete = false, 3000); } else { $el.closest('form').submit(); }"
                                        class="text-[13px] md:text-xs font-black uppercase text-gray-400 hover:text-red-500 transition-colors duration-300 leading-none"
                                        type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endif

                        <a href="{{ route('series.reviews.create', $serie) }}"
                           class="p-2 text-gray-400 hover:text-aurora-deep duration-300 rounded-lg transition-colors "
                           title="Write a Review">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
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

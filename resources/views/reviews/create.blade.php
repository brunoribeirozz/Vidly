<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-aurora-deep">
        <div class="max-w-4xl w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl shadow-aurora-vibrant border border-white/10">

            {{-- Cabeçalho com Nome da Série --}}
            <div class="text-center">
                <h2 class="text-3xl font-black text-aurora-vibrant uppercase tracking-tighter">
                    What did you think of <span class="text-aurora-deep">{{ $series->name }}</span>?
                </h2>
                <p class="mt-2 text-sm text-gray-500 italic">
                    Your opnion help other users to find a lot of experiences.
                </p>
            </div>

            <form action="{{ route('series.reviews.store', $series) }}" method="POST" class="mt-8 space-y-6">
                @csrf

                <div class="flex flex-col md:flex-row gap-8 items-center">

                    <div x-data="{ rating: 0, hoverRating: 0 }" class="w-full md:w-1/3 flex flex-col items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Avaliation</span>

                        <div class="w-full md:w-1/3 flex flex-col items-center">
                            <div class="flex flex-row-reverse justify-center items-center">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}" class="hidden peer" required>
                                    <label for="star{{ $i }}" class="cursor-pointer text-gray-200 peer-checked:text-yellow-400 hover:text-yellow-300 peer-hover:text-yellow-300 transition-all duration-200">
                                        <svg class="w-10 h-10 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                        </div>

                    </div>

                    <div class="w-full md:w-2/3">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Your comentary (Optional)</label>
                        <textarea name="comment" rows="5"
                                  class="w-full rounded-2xl border-gray-100 focus:border-aurora-vibrant focus:ring-aurora-vibrant text-sm shadow-inner"
                                  placeholder="Write here what you most liked. (or hated)..."></textarea>
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                    <a href="{{ route('series.seasons.index', $series) }}" class="text-xs font-black uppercase tracking-widest text-aurora-dark hover:text-aurora-deep transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-4 bg-aurora-deep text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-aurora-vibrant transition-all shadow-xl shadow-aurora-vibrant/30">
                        Send avaliation
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

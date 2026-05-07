<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-aurora-vibrant leading-tight">
                Seasons of {{ $series->name }}
            </h2>

            <form action="{{ route('series.seasons.store', ['series' => $series->id]) }}" method="POST">
                @csrf
                @if(auth()->user()->is_admin)
                <button type="submit"
                        class="bg-aurora-deep hover:bg-aurora-vibrant text-white px-4 py-2 rounded shadow-lg font-bold uppercase text-xs transition">
                    + Add Season
                </button>
            </form>
            @endif
        </div>
    </x-slot>

    <div x-data="{ openEditSeasonModal: false, seasonNumber: '', actionUrl: '', comment: '', stars: 0,  isEditModalOpen: false}"
         class="py-12 bg-aurora-light min-h-screen ml-10 mr-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse ($seasons as $season)

                    <div class="relative bg-aurora-card p-6 rounded-xl border border-black/5 shadow-xl group hover:border-aurora-vibrant transition duration-300">

                        <div class="absolute top-3 right-3 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                            @if(auth()->user()->is_admin)
                            <button @click="openEditSeasonModal = true;
                                            seasonNumber = {{ $season->number }};
                                            actionUrl = '{{ route('series.seasons.update', [$series, $season])}}'"
                               class="text-[10px] font-black uppercase text-gray-400 hover:text-aurora-vibrant">
                                Edit
                            </button>
                            <form action="{{ route('series.seasons.destroy', [$series, $season]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this season?')"
                                        class="text-[10px] font-black uppercase text-gray-400 hover:text-red-500">
                                    Del
                                </button>
                            </form>
                            @endif

                        </div>

                        <div class="flex flex-col items-center text-center">
                <span class="text-4xl font-black text-aurora-vibrant mb-2">
                    {{ $season->number }}
                </span>
                            <h3 class="text-gray-800 font-bold uppercase text-sm tracking-widest">
                                Season
                            </h3>

                            {{-- Link para os eps --}}
                            <a href="{{ route('seasons.episodes.index', $season) }}"
                               class="mt-6 text-xs font-bold text-white/30 group-hover:text-aurora-dark transition uppercase">
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

        <h2 class="text-xl font-bold tracking-tighter text-aurora-deep ml-6 mt-6">
            Reviews <span class="text-gray-500 font-medium ml-2">{{ $reviews->count() }}</span>
        </h2>

        <div class="mt-8 max-w-5xl overflow-y-auto max-h-[500px] flex-col">
            <div class="space-y-8">
                @forelse($reviews as $review)
                    <div class="flex space-x-3 ml-5 mt-1">
                        <img src="{{ $review->user->profile_photo_url }}" class="w-12 h-12 rounded-full ring-1 ring-gray-500" alt="">

                        <div class="flex-1 border-gray-300 pt-4 border rounded-xl shadow-xl shadow-gray-300 mx-auto max-w-4xl">

                                <div class="flex justify-between px-6 mb-2">
                                    @if (auth()->id() === $review->user_id)
                                        <button type="button"
                                                @click="isEditModalOpen = true;
                                                        comment = '{{ addslashes($review->comment) }}';
                                                        stars = {{ $review->stars  }};
                                                        actionUrl = '{{ route('series.reviews.update', [$series, $review]) }}'"
                                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-blue-700 transition-colors">
                                            Edit Comment
                                        </button>
                                    @endif

                                    @if(auth()->id() === $review->user_id || auth()->user()->is_admin)
                                        <form action="{{auth()->user()->is_admin ? route('admin.reviews.destroy', $review) : route('series.reviews.destroy', [$series, $review]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-red-600 transition-colors">Delete comment</button>
                                        </form>
                                    @endif
                                </div>

                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-xl font-black text-aurora-deep tracking-tighter truncate uppercase leading-none ml-6 mb-2">
                                    {{ $review->user->name }}
                                </h3>

                                <span class="flex items-center text-yellow-500 text-lg mr-6">
                                    <svg xmlns="http://w3.org" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>
                                        {{ $review->stars }}
                                </span>

                            </div>

                            <p class="text-sm text-gray-600 leading-tight ml-6 mb-2">
                                {{ $review->comment }}
                            </p>

                        </div>
                    </div>
                @empty
                    <p>There's no review for this Serie.</p>
                @endforelse
            </div>
            <template x-if="isEditModalOpen">

                <div class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden animate-in zoom-in dura">
                        <form :action="actionUrl" method="POST">
                            @csrf
                            @method('PATCH')

                            <input type="number" x-model="stars" name="stars" class="w-full rounded-xl border-gray-200 focus:ring-aurora-vibrant">

                            <textarea x-model="comment" rows="4" class="w-full rounded-xl border-gray-200 mt-4 focus:ring-2 focus:ring-aurora-vibrant" name="comment"></textarea>

                            <div class="flex justify-end space-x-3 mt-6">
                                <button @click="isEditModalOpen = false" type="button" class="text-gray-400 hover:text-aurora-dark font-bold uppercase text-xs">Cancel</button>

                                <button type="submit" class="bg-aurora-deep hover:bg-aurora-vibrant text-white px-6 py-2 rounded-xl font-black uppercase text-xs">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </template>

            <template x-if="openEditSeasonModal">
                <div class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50">
                    <div class="bg-white p-8 rounded-3xl max-w-sm w-full shadow-2xl">
                        <form :action="actionUrl" method="POST">
                            @csrf @method('PATCH')
                            <h3 class="font-bold mb-4 ">Edit Season Number</h3>

                            <input type="number" name="number" x-model="seasonNumber" class="w-full rounded-xl border-gray-200 text-center text-2xl font-black">

                            <div class="mt-6 flex justify-end space-x-3">

                                <button type="button" @click="openEditSeasonModal = false" class="text-gray-400 font-bold uppercase text-xs">Cancel</button>
                                <button type="submit" class="bg-aurora-vibrant text-white px-6 py-2 rounded-xl text-xs font-black uppercase">Update</button>

                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>

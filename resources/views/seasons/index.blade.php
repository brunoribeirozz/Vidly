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
                               class="text-[10px] font-black uppercase text-gray-400 hover:text-blue-600">
                                Edit
                            </button>
                            <form action="{{ route('series.seasons.destroy', [$series, $season]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button x-data="{ confirmDelete: false }"
                                        :class="confirmDelete ? 'text-red-500 scale-110 animate-pulse text-[10px]' : 'text-gray-400'"
                                        @click.prevent="if (!confirmDelete) { confirmDelete = true; setTimeout(() => confirmDelete = false, 3000); } else { $el.closest('form').submit(); }"
                                        class="text-[13px] md:text-xs font-black uppercase text-gray-400 hover:text-red-500 transition-colors leading-none"
                                        type="submit">
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

            <div class="flex items-center mt-8 gap-2">
                <a href="{{ route('series.index') }}" class="text-gray-500 hover:underline hover:text-aurora-deep text-sm font-bold flex items-center gap-2 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 transition-transform group-hover:-translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <span>Home</span>
                </a>
            </div>

        </div>

        <div class="mt-8 max-w-5xl mx-auto">

            <div class="flex items-center ml-6 mt-8 mb-4">
                <h2 class="text-2xl font-bold tracking-tighter text-aurora-deep  leading-none">
                    Reviews
                </h2>

                <!-- Contador estilizado como um badge discreto -->
                <span class="ml-3 px-2.5 py-0.5 bg-aurora-vibrant/10 text-aurora-vibrant text-sm font-bold rounded-full border border-aurora-vibrant/20">
        {{ $reviews->count() }}
    </span>
            </div>

            <div class="overflow-y-auto pr-4 space-y-6 max-h-[600px]">
                @forelse($reviews as $review)
                    <div class="flex items-start space-x-4">
                        <img src="{{ $review->user->profile_photo_url }}" class="w-12 h-12 rounded-full ring-1 ring-gray-500 mt-1 ml-1" alt="">

                        <div class="flex-1 border-gray-300 pt-4 border rounded-2xl shadow-xl hover:shadow-gray-400 transition-shadow mx-auto max-w-4xl">

                            <div class="flex items-center justify-between px-6 pt-4">
                                <h3 class="text-xl font-black text-aurora-deep tracking-tighter truncate uppercase leading-none ml-6 mb-2">
                                    {{ $review->user->name }}
                                </h3>

                                <div class="flex items-center space-x-3">
                                    @if (auth()->id() === $review->user_id)
                                        <button type="button"
                                                @click="isEditModalOpen = true;
                                                        comment = '{{ addslashes($review->comment) }}';
                                                        stars = {{ $review->stars  }};
                                                        actionUrl = '{{ route('series.reviews.update', [$series, $review]) }}'"
                                                class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-blue-700 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>
                                    @endif

                                    @if(auth()->id() === $review->user_id || auth()->user()->is_admin)
                                        <form action="{{auth()->user()->is_admin ? route('admin.reviews.destroy', $review) : route('series.reviews.destroy', [$series, $review]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button x-data="{ confirmDelete: false }"
                                                    :class="confirmDelete ? 'text-red-500 scale-110 animate-pulse' : 'text-gray-500'"
                                                    @click.prevent="if (!confirmDelete) { confirmDelete = true; setTimeout(() => confirmDelete = false, 3000); } else { $el.closest('form').submit(); }"
                                                    class="text-[13px] md:text-xs font-black uppercase text-gray-400 hover:text-red-500 transition-colors leading-none"
                                                    type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <p class="text-sm text-gray-600 leading-tight ml-6 ">
                                {{ $review->comment }}

                                <span class="flex items-center text-yellow-500 text-lg mr-6 justify-end mb-4">
                                    <svg xmlns="http://w3.org" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>
                                        {{ $review->stars }}
                                </span>

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
                            <h3 class="font-bold mb-4 uppercase">Edit Season Number</h3>

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

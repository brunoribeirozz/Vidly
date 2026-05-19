<x-app-layout>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mt-2 ml-2 mr-2">
            <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Series</p>
            <h3 class="text-3xl font-black text-aurora-deep mt-1">{{ $stats['total_series'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mt-4 ml-4 mr-4">
            <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Reviews</p>
            <h3 class="text-3xl font-black text-aurora-vibrant mt-1">{{ $stats['total_reviews'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mt-4 ml-4 mr-4">
            <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Overall Average</p>
            <h3 class="text-3xl font-black text-yellow-500 mt-1">★ {{ $stats['avg_rating'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mt-4 ml-4 mr-4">
            <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Users</p>
            <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $stats['total_users'] }}</h3>
        </div>
    </div>
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mt-4 ml-4 mr-4">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-black uppercase tracking-tighter text-aurora-deep">Recent Reviews</h3>
            <a href="#" class="text-xs font-bold text-aurora-vibrant hover:underline uppercase">See all</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-50 text-[11px] font-black uppercase tracking-widest text-gray-400">
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Serie</th>
                    <th class="px-6 py-4">Avaliation</th>
                    <th class="px-6 py-4">Comment</th>
                    <th class="px-6 py-4 text-right">Data</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                @foreach($recentReviews as $review)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $review->user->profile_photo_url }}" class="w-8 h-8 rounded-full border" alt="">
                                <span class="text-sm font-bold text-gray-900">{{ $review->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-600">
                            {{ $review->serie->name }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-yellow-500 font-black">★ {{ $review->stars }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 italic max-w-xs truncate">
                            "{{ $review->comment ?? 'No comment added' }}"
                        </td>
                        <td class="px-6 py-4 text-right text-xs text-gray-400">
                            {{ $review->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

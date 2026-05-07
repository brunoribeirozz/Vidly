<div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl flex flex-col items-center">
    <section class="w-full max-w-xl text-center">
        <header>
            <h2 class="text-xl font-black uppercase tracking-tighter text-aurora-vibrant">
                Profile Photo
            </h2>
            <p class="mt-1 text-sm text-gray-500 italic">
                Customize your Photo!
            </p>
        </header>

        <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data"
              class="mt-8 space-y-6">
            @csrf
            @method('patch')

            <div class="flex flex-col items-center space-y-6">
                {{-- Preview da foto --}}
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <div
                            class="w-36 h-36 rounded-full overflow-hidden border-2 border-violet-900 shadow-xl shadow-gray-400 group-hover:scale-105 transition-all duration-300">
                            <img src="{{ Auth::user()->profile_photo_url }}"
                                 alt=""
                                 class="w-full h-full object-cover">
                        </div>

                        {{-- tag do adm --}}
                        @if(Auth::user()->is_admin)
                            <span class="absolute -top-1 -right-1 bg-aurora-vibrant text-white text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-tighter shadow-lg z-10">
                                    Admin
                            </span>
                        @endif
                    </div>

                    <div class="mt-4"></div>
                </div>

                <label class="cursor-pointer mt-10 flex justify-center">
                    <span
                        class="px-6 py-3 bg-aurora-deep hover:bg-aurora-vibrant text-white font-black uppercase text-xs tracking-widest rounded-xl transition-all shadow-[0_10px_20px_rgba(139,50,244,0.3)]">
                        Change avatar
                    </span>

                    <input type="file" name="profile_photo_path" class="hidden mt-8" accept="image/*"
                           onchange="this.form.submit()">
                </label>

                @if(Auth::user()->profile_photo_path)
                    <form method="post" action="{{ route('profile.photo.destroy') }}" class="mt-4">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-red-500 hover:text-red-700 transition-colors">
                            Delete avatar
                        </button>
                    </form>
                @endif


                <x-input-error class="mt-2" :messages="$errors->get('profile_photo_path')"/>
            </div>
        </form>
    </section>
</div>

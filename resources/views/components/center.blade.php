<section class="w-60 bg-[#1e2020] border-r border-[#0f0f14] overflow-y-auto text-gray-200">
    <div class="container mx-auto flex justify-between items-center mb-3">
        <div class="w-60 bg-[#1e2020 rounded shadow">
            <div
                class="bg-[#27282b] h-8 p-1 justify-between pl-3 pt-2.5 pb-3 border-b border-[#0f0f14] flex items-center gap-2 px-3">
                <div>
                    <span class="text-[15px]">Get Started</span>
                </div>

                <div class="flex items-center space-x-2 pt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 cursor-pointer hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-5 cursor-pointer hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                    </svg>
                </div>
            </div>

            <!-- Pinned Toggle -->
            <div x-data="{ open: true }" class="border-b border-[#0f0f14] bg-[#27282b]">
                <button @click="open = !open"
                        class="flex justify-between items-center w-full px-2 py-1 text-left ">
                    <span class="text-[12px] pl-1.5">Pinned</span>

                    <svg :class="{ 'rotate-90': open }" class="transform transition-transform size-3.5"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>

                <div x-show="open" class="space-y-3 px-2 py-2 bg-[#1e2020]">
                    <div
                        class="bg-[#2d2e31] rounded-[4px] p-3 flex justify-between items-start transition-all cursor-pointer">
                        <div>
                            <div
                                class="text-sm font-semibold text-white flex items-center gap-2 rounded">
                                <x-hugeicons-pin class="w-4 h-4 text-[#4889ed]" stroke-width="1"/>
                                <span class="font-medium">Title</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1 truncate max-w-[180px] font-medium">Content</p>
                            <span class="text-xs text-gray-500 mt-1 block">Date</span>
                        </div>
                        <img src="https://img.icons8.com/doodle/512/square.png" alt="thumb"
                             class="w-12 h-12 rounded-md object-cover">
                    </div>
                </div>
            </div>

            <!-- Other Notes -->
            <div class="p-1 space-y-2 bg-[#141419] border-black"></div>

            <div x-show="open" class="space-y-3 px-2 py-2 bg-[#1e2020]">
                <div
                    class="bg-[#1e2020] rounded-[4px] p-3 flex justify-between items-start transition-all cursor-pointer">
{{--                    <div>--}}
{{--                        <span class="font-medium text-sm">Title</span>--}}
{{--                        <p class="text-xs text-gray-400 mt-1 truncate max-w-[180px] font-medium">Content</p>--}}
{{--                        <span class="text-xs text-gray-500 mt-1 block">Date</span>--}}
{{--                    </div>--}}
                    @foreach($notes->sortByDesc('is_pinned') as $note)
                        <div class="bg-[#2d2e31] rounded p-3 mb-2">
                            <div class="text-sm font-bold text-white flex items-center gap-2">
                                @if($note->is_pinned)
                                    <x-hugeicons-pin class="w-4 h-4 text-[#4889ed]" stroke-width="1"/>
                                @endif
                                {{ $note->title }}
                            </div>
                            <p class="text-xs text-gray-400 mt-1 truncate max-w-[180px]">{!! \Illuminate\Support\Str::limit(strip_tags($note->content), 100) !!}</p>
                            <span class="text-xs text-gray-500 mt-1 block">{{ $note->updated_at->diffForHumans() }}</span>
                        </div>
                    @endforeach

                </div>
            </div>
            <div>
                <hr class="text-[#373741] w-[200px] mx-auto">
            </div>

        </div>
    </div>
</section>

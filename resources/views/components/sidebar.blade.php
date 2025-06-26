<aside
    x-data="{ openNotes: true, openQuick: true, openNotebooks: true, openTags: true, selected: 'uncategorized' }"
    class="min-h-screen w-[198px] bg-[#1e2020] border-r border-[#0f0f14] p-2 overflow-y-auto text-gray-300 space-y-2 select-none text-xs">

    @php
        $total = $notes->count();
        $todo = $notes->where('category', 'todo')->count();
        $uncategorized = $notes->where('category', 'uncategorized')->count();
    @endphp

    {{-- ALL NOTES --}}
    <div class="space-y-1">
        <button @click="openNotes = !openNotes"
                class="flex items-center justify-between w-full hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer">
            <div class="flex items-center gap-1">
                <svg :class="{ 'rotate-90': openNotes }"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="size-4 text-gray-400 hover:text-gray-200 transform transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                </svg>
                <span class="font-bold">All Notes</span>
            </div>
            <span>{{ $total }}</span>
        </button>

        <div x-show="openNotes" x-transition class="ml-8">
            <div @click="selected = 'uncategorized'"
                 :class="selected === 'uncategorized' ? 'bg-[#2d2e31]' : ''"
                 class="flex items-center gap-2 hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-4 text-[#26af68]">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"/>
                </svg>
                <span class="">Uncategorized</span>
                <span>{{ $uncategorized }}</span>
            </div>
            <div @click="selected = 'todo'"
                 :class="selected === 'todo' ? 'bg-[#2d2e31]' : ''"
                 class="flex items-center gap-2 hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer transition">
                <x-antdesign-check-square-o class="h-4 w-4 text-[#cf6a6a]"/>
                <span class="">Todo</span>
                <span>{{ $todo }}</span>
            </div>
            <div @click="selected = 'unsynced'"
                 :class="selected === 'unsynced' ? 'bg-[#2d2e31]' : ''"
                 class="flex items-center gap-2 hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer transition">
                <x-coolicon-cloud-off class="h-4 w-4 text-[#b867a3]"/>
                <span class="">Unsynced</span>
            </div>
        </div>
    </div>

    {{-- QUICK ACCESS --}}
    <div class="space-y-1">
        <button @click="openQuick = !openQuick"
                class="flex items-center justify-between w-full hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer">
            <div class="flex items-center gap-1">
                <svg :class="{ 'rotate-90': openQuick }"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="size-4 text-gray-400 hover:text-gray-200 transform transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-[#4a91fc] font-bold "> Quick Access</span>
            </div>
        </button>
        <div x-show="openQuick" x-transition class="ml-6 space-y-2">
            <div class="text-gray-500 text-xs italic px-2">No quick access items yet.</div>
        </div>
    </div>

    {{-- NOTEBOOKS --}}
    <div class="space-y-1">
        <button @click="openNotebooks = !openNotebooks"
                class="flex items-center justify-between w-full hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer">
            <div class="flex items-center gap-1">
                <svg :class="{ 'rotate-90': openNotebooks }"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="size-4 text-gray-400 hover:text-gray-200 transform transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-[#4a91fc] font-bold">Notebooks</span>
            </div>
            <span class="pb-1 text-[15px] text-[#4a91fc] hover:text-[#2b568f]">+</span>
        </button>
        <div x-show="openNotebooks" x-transition class="ml-6 space-y-2">
            <div class="text-gray-500 text-xs italic px-2">No notebooks yet.</div>
        </div>
    </div>

    {{-- TAGS --}}
    <div class="space-y-1">
        <button @click="openTags = !openTags"
                class="flex items-center justify-between w-full hover:text-white px-2 py-2 rounded hover:bg-[#2d2e31] cursor-pointer">
            <div class="flex items-center gap-1">
                <svg :class="{ 'rotate-90': openTags }"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="size-4 text-gray-400 hover:text-gray-200 transform transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-[#4a91fc] font-bold ">Tags</span>
            </div>
        </button>
        <div x-show="openTags" x-transition class="ml-6 space-y-2">
            <div class="text-gray-500 text-xs italic px-2">No tags yet.</div>
        </div>
    </div>

    {{-- DİĞER KISIMLAR --}}
    <div class="flex items-center justify-between hover:text-white px-2 py-2 rounded cursor-pointer ml-5">
        <div class="flex items-center gap-1">
            <span class="text-[#4a91fc] font-bold ">Templates</span>
        </div>
    </div>

    <div class="flex items-center justify-between hover:text-white px-2 py-1 rounded cursor-pointer ml-5">
        <div class="flex items-center gap-1">
            <span class="text-[#4a91fc] font-bold ">Trash</span>
        </div>
    </div>
</aside>

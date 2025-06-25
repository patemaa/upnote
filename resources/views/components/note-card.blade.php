<div class="bg-gray-800 p-3 rounded relative group hover:bg-gray-700">
    <div class="text-sm font-semibold">{{ $note->title }}</div>
    <div class="text-xs text-gray-400">{{ $note->excerpt }}</div>
    <div class="text-xs text-gray-500 mt-1">{{ $note->created_at->format('M d, h:i A') }}</div>

    <!-- Dropdown Menu -->
    <div class="absolute top-2 right-2">
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="text-gray-400 hover:text-white">
                ⋮
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-1 w-40 bg-gray-800 border border-gray-700 rounded shadow z-10">
                <ul class="text-sm text-white">
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Display</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Sort Notes</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Edit</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">New Tested Notebooks</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700 text-red-400">Delete</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Export</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

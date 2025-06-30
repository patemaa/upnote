@props(['note'])

<div x-show="showHistory" @click.self="showHistory = false"
     class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-[9999]">
    <div class="bg-white p-4 w-[700px] h-[500px] overflow-y-auto rounded shadow dark:bg-[#1e2020]">
        <h2 class="text-lg font-semibold mb-3 dark:text-white">Version History</h2>

        @php
            $versions = $note->versions()->orderByDesc('saved_at')->get();
        @endphp

            <div class="text-sm text-gray-500 dark:text-gray-300">
                Current Version
            </div>
            <div class="border p-2 text-xs bg-gray-100 dark:bg-gray-700 mt-1 dark:text-white">
                {!! $note->content !!}
            </div>
            @foreach($versions as $version)
                <div class="mb-3 mt-4">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $version->saved_at->format('M d, Y - H:i:s') }}
                    </div>
                    <div class="border p-2 text-xs bg-gray-100 dark:bg-gray-700 mt-1 dark:text-white">
                        {!! $version->content !!}
                    </div>
                    <form method="POST" action="{{ route('notes.restoreVersion', [$note, $version]) }}">
                        @csrf
                        <button class="text-blue-600 text-sm hover:underline dark:text-blue-400">Geri Yükle</button>
                    </form>
                </div>
            @endforeach
    </div>
</div>

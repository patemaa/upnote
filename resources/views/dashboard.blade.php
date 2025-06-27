<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $total = $notes->count();
        $todo = $notes->where('category', 'todo')->count();
        $uncategorized = $notes->where('category', 'uncategorized')->count();
    @endphp

    <main>
        <div class="flex">
            @include('components.sidebar', [
                'notes' => $notes,
                'total' => $total,
                'todo' => $todo,
                'uncategorized' => $uncategorized
            ])

            @include('components.center', ['notes' => $notes])
            @if(isset($note) && isset($notebooks))
                @include('components.editor', [
                    'notes' => $notes,
                    'note' => $note,
                    'notebooks' => $notebooks
                ])
            @endif




        </div>
    </main>
</x-app-layout>

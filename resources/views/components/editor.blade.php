<section class="flex-1 overflow-y-auto flex flex-col  dark:bg-[#1e2020]">
    <div class="dark:bg-[#27282b] h-[31.5px] p-1 flex items-center justify-between">
        <div class="flex items-center space-x-5 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="size-4 ml-6 text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 cursor-pointer dark:text-gray-200">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>

            <div class="flex items-center space-x-3" x-data="{ isPinned: false, isStarred: false }">
                <div
                    @click="isPinned = !isPinned"
                    x-bind:class="isPinned ? 'bg-[#e4f2fe] text-[#1182c9] dark:bg-gray-700 dark:text-blue-400' : 'text-gray-500 hover:text-gray-600 dark:hover:text-gray-400'"
                    class="flex items-center px-1 py-1 rounded cursor-pointer transition">
                    <x-hugeicons-pin class="w-4 h-4"
                                     x-bind:class="isPinned ? 'dark:text-blue-400' : 'dark:hover:text-gray-400 dark:text-gray-300'"
                                     stroke-width="2"/>
                </div>

                <div
                    @click="isStarred = !isStarred"
                    x-bind:class="isStarred ? 'bg-[#e4f2fe] text-[#1182c9] dark:bg-gray-700 dark:text-blue-400' : 'text-gray-500 hover:text-gray-600 dark:hover:text-white'"
                    class="flex items-center px-1 py-1 rounded cursor-pointer transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor"
                         class="size-4 transition"
                         x-bind:class="isStarred ? 'dark:text-blue-400' : 'dark:text-gray-300 dark:hover:text-gray-400'">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                    </svg>
                </div>
            </div>

            <x-hugeicons-clock-02
                class="w-4 h-4 dark:hover:text-gray-400 cursor-pointer text-gray-500 hover:text-gray-600 dark:text-gray-300"
                stroke-width="2"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor"
                 class="size-4 text-gray-500 hover:text-gray-600 dark:text-gray-300 dark:hover:text-gray-400 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor"
                 class="size-5 text-gray-500 hover:text-gray-600 dark:text-gray-300 dark:hover:text-gray-400 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
            </svg>
        </div>

        <div class="mr-4 flex items-center space-x-3 ml-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="size-5 text-gray-500 hover:text-gray-600 dark:text-gray-300 dark:hover:text-gray-400 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
            </svg>
        </div>
    </div>


    <div id="editor-wrapper" class="border-t-[1px] dark:border-[#0f0f14] custom-scrollbar">
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

        <style>
            :root {
                --ck-color-base-background: #ffffff;
                --ck-color-base-text: #000000;
                --ck-color-toolbar-background: #f0f0f0;
                --ck-color-button-default-hover-background: #ccc;
            }

            .ck.ck-editor__editable {
                background-color: #fff !important;
                color: #000 !important;
                min-height: 530px;
                max-height: 550px;
                overflow-y: auto;
                overflow-x: auto;
                padding: 1rem !important;
                font-family: system-ui, sans-serif;
                font-size: 0.67em;
                border: 1px solid #ccc;
            }

            /* Dark mode */
            @media (prefers-color-scheme: dark) {
                :root {
                    --ck-color-base-background: #1e1e1e;
                    --ck-color-base-text: #ffffff;
                    --ck-color-toolbar-background: #2a2a2a;
                    --ck-color-button-default-hover-background: #444;
                }

                .ck.ck-editor__editable {
                    background-color: #1e2020 !important;
                    color: white !important;
                    border: 1px solid #0f0f14;
                }
            }


            .ck-content h1 {
                display: block;
                font-size: 2em;
                margin-top: 0.67em;
                margin-bottom: 0.67em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }

            .ck-content h2 {
                display: block;
                font-size: 1.5em;
                margin-top: 0.83em;
                margin-bottom: 0.83em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }

            .ck-content h3 {
                display: block;
                font-size: 1.17em;
                margin-top: 1em;
                margin-bottom: 1em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }

            .ck-content h4 {
                display: block;
                font-size: 1em;
                margin-top: 1.33em;
                margin-bottom: 1.33em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }

            .ck-content h5 {
                display: block;
                font-size: .83em;
                margin-top: 1.67em;
                margin-bottom: 1.67em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }

            .ck-content h6 {
                display: block;
                font-size: .67em;
                margin-top: 2.33em;
                margin-bottom: 2.33em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }

            .ck-content ul,
            .ck-content ol {
                padding-left: 1.5rem;
                margin-left: 0;
                color: white;
            }

            .ck-content li {
                margin-bottom: 0.5rem;
            }

            /* Açık tema */
            .ck.ck-toolbar {
                background-color: #f0f0f0 !important;
                border: 1px solid #ccc !important;
            }

            .ck.ck-button,
            .ck.ck-toolbar__separator {
                filter: none;
            }

            .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
                border: 1px solid #ccc;
            }

            /* Karanlık tema */
            @media (prefers-color-scheme: dark) {
                .ck.ck-toolbar {
                    background-color: #2a2a2a !important;
                    border: none !important;
                }

                .ck.ck-button,
                .ck.ck-toolbar__separator {
                    filter: invert(1);
                }

                .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
                    border: none;
                }
            }

        </style>
    </div>


    <form method="POST"
          action="{{ $note->exists ? route('notes.update', $note) : route('notes.store') }}"
          id="noteForm">
        @csrf
        @if($note->exists)
            @method('PATCH')
        @endif

        <input type="hidden" name="title" id="noteTitle">
        <textarea name="note_content" id="noteContent" hidden></textarea>

        <div id="editor" class="dark:text-white min-h-[600px] px-4 py-2"></div>

        <div x-data="{ open: false }" class="flex justify-center">
            <div class="flex px-4 py-1.5 space-x-2 items-center rounded dark:bg-[#27282b] bg-[#f8f8f8]">
                {{-- WRAP BUTTON + DROPDOWN --}}
                <div class="relative">
                    <button @click="open = !open"
                            type="button"
                            class="flex items-center space-x-2 border bg-[#0078c5] border-[#0078c5] hover:bg-[#0068ac] text-white dark:border-[#4a92fe] dark:bg-[#4a92fe] dark:hover:bg-[#5080d3] dark:text-white text-[12px] px-3 py-1 rounded transition duration-300 mr-2">

                        <x-majestic-book-plus-line class="w-4 h-4"/>
                        <span>Add To Notebooks</span>
                    </button>


                    {{-- DROPDOWN --}}
                    <div x-show="open" @click.outside="open = false"
                         x-transition
                         class="px-2 pt-2 absolute bottom-[calc(100%+8px)] left-0 w-[228px] bg-[#0078c5] dark:bg-[#2c2c2e] text-sm dark:text-white rounded-md shadow-xl border dark:border-[#3a3a3c] z-50">
                        <div
                            class="inline-block border bg-[#0078c5] border-[#0078c5] hover:bg-[#0068ac] text-white dark:border-[#4a92fe] dark:bg-[#4a92fe] dark:hover:bg-[#5080d3] text-[12px] px-3 py-1 rounded transition duration-300 mr-2">
                            Add to notebooks
                        </div>
                        <div
                            class="inline-block text-[15px] rounded text-white ml-7 px-3 py-1 hover:text-gray-300 cursor-pointer">
                            +
                        </div>
                        <div class="px-3 py-2 border-b dark:border-[#3a3a3c]">
                            <input type="text"
                                   placeholder="Search"
                                   class="w-full px-2 py-1 rounded dark:bg-[#3a3a3c] placeholder-gray-400 dark:text-gray-200 text-sm focus:outline-none"/>
                        </div>

                        <div class="max-h-60 overflow-y-auto custom-scrollbar">
                            @foreach($notebooks as $notebook)
                                <div
                                    class="flex items-center justify-between px-3 py-2 dark:hover:bg-[#3a3a3c] cursor-pointer"
                                    @click="assignNotebook({{ $notebook->id }})"
                                >
                                    <div class="flex items-center space-x-2">
                                        <div class="w-4 h-4 bg-purple-600 rounded-sm"></div>
                                        <span class="text-sm">{{ $notebook->name }}</span>
                                    </div>
                                    <span class="text-xs dark:text-gray-400">{{ $notebook->notes_count }}</span>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                {{-- SAVE butonu --}}
                <button type="submit"
                        class="inline-block border bg-[#0078c5] border-[#0078c5] hover:bg-[#0068ac] text-white dark:border-[#4a92fe] dark:bg-[#4a92fe] dark:hover:bg-[#5080d3] dark:text-white text-[12px] px-3 py-1 rounded transition duration-300 mr-2">
                    Save
                </button>
            </div>
        </div>

    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        let editorInstance;

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editorInstance = editor;

                // Form gönderilmeden önce veriyi textarea'ya yaz
                document.getElementById('noteForm').addEventListener('submit', function (e) {
                    const content = editor.getData();
                    const title = content.replace(/<[^>]+>/g, '').split('\n')[0] || 'Untitled';

                    document.getElementById('noteContent').value = content;
                    document.getElementById('noteTitle').value = title;
                });
            })
            .catch(error => {
                console.error('CKEditor hatası:', error);
            });

        function assignNotebook(notebookId) {
            fetch(`/notes/{{ $note->id }}/assign-notebook`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({notebook_id: notebookId})
            })
                .then(res => res.json())
                .then(data => {
                    editorInstance.setData(data.content); // burada data.content tam HTML olmalı
                })
                .then(data => {
                    if (data.success) {
                        alert('Notebook başarıyla atandı.');
                    } else {
                        alert('Bir hata oluştu.');
                    }
                });
        }
    </script>


</section>

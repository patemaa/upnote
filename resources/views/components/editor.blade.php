<section class="flex-1 overflow-y-auto flex flex-col min-h-screen bg-[#1e2020]">
    <div class="bg-[#27282b] h-[31.5px] p-1 flex items-center justify-between">
        <div class="flex items-center space-x-5 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                 stroke="currentColor" class="size-5 ml-6 hover:text-gray-400 cursor-pointer text-gray-200">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>

            <div class="flex items-center space-x-3" x-data="{ isPinned: false, isStarred: false }">
                <div
                    @click="isPinned = !isPinned"
                    x-bind:class="isPinned ? 'bg-gray-700 text-blue-400' : 'hover:text-gray-400'"
                    class="flex items-center px-1 py-1 rounded cursor-pointer transition">
                    <x-hugeicons-pin class="w-4 h-4"
                                     x-bind:class="isPinned ? 'text-blue-400' : 'hover:text-gray-400 text-gray-300'"
                                     stroke-width="2"/>
                </div>

                <div
                    @click="isStarred = !isStarred"
                    x-bind:class="isStarred ? 'bg-gray-700 text-blue-400' : 'hover:text-white'"
                    class="flex items-center px-1 py-1 rounded cursor-pointer transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor"
                         class="size-4 transition"
                         x-bind:class="isStarred ? 'text-blue-400' : 'text-gray-300 hover:text-gray-400'">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                    </svg>
                </div>
            </div>

            <x-hugeicons-clock-02 class="w-4 h-4 hover:text-gray-400 cursor-pointer text-gray-300" stroke-width="2"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor"
                 class="size-4 text-gray-300 hover:text-gray-400 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor"
                 class="size-5 text-gray-300 hover:text-gray-400 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
            </svg>
        </div>

        <div class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-5 text-gray-300 hover:text-gray-400 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
            </svg>
        </div>
    </div>


    <div id="editor-wrapper" class="h-screen w-full overflow-hidden border-t-[1px] border-[#0f0f14]">
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

        <style>
            :root {
                --ck-color-base-background: #1e1e1e;
                --ck-color-base-text: #ffffff;
                --ck-color-toolbar-background: #2a2a2a;
                --ck-color-button-default-hover-background: #444;
            }

            .ck.ck-editor__editable {
                background-color: #1e2020 !important;
                color: white !important;
                min-height: calc(100vh - 50px);
                max-height: calc(100vh - 50px);
                overflow-y: auto;
                padding: 1rem !important;
                font-family: system-ui, sans-serif;
                font-size: .67em;
                border: #0f0f14;

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

            .ck.ck-toolbar {
                background-color: #2a2a2a !important;
                border: none !important;
            }

            .ck.ck-button,
            .ck.ck-toolbar__separator {
                filter: invert(1); /* ikonları açık hale getir */
            }

            .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
                border: none;
            }
        </style>


        <div id="editor"></div>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: [
                        'undo', 'redo', '|',
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'bulletedList', 'numberedList', '|',
                        'blockQuote', 'link', '|',
                        'mediaEmbed'
                    ],
                    heading: {
                        options: [
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
                        ]
                    }
                })
                .then(editor => {
                    const editable = editor.ui.getEditableElement();
                    editable.style.height = 'calc(100vh - 50px)';
                })
                .catch(error => {
                    console.error(error);
                });
            editor.model.document.on('change:data', () => {
                const content = editor.getData();
                console.log("Content changed:", content);
            });

        </script>
    </div>
</section>

<section class="w-64 dark:bg-[#1e2020] border-r dark:border-[#0f0f14] dark:text-gray-200 h-[644px]"
         x-data="notesList()" x-init="initSortable()">

    <div class="container mx-auto flex justify-between items-center mb-3">
        <div class="w-60 dark:bg-[#1e2020] rounded shadow">
            <div
                class="bg-[#f7f7f7] dark:bg-[#27282b] h-8 justify-between border-b dark:border-[#0f0f14] flex items-center gap-2 px-3">
                <div>
                    <span class="text-[15px] text-gray-600">Get Started</span>
                </div>
                <div class="flex items-center space-x-3 pt-1">
                    <div
                        @click="toggleArrange()"
                        :class="arranging ? 'dark:bg-gray-700 dark:text-blue-400' : 'dark:hover:text-gray-400'"
                        class="flex items-center rounded cursor-pointer transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6 px-1 py-1 rounded"
                             :class="arranging ? 'bg-[#e4f2fe] text-[#037ac6] dark:text-blue-400' : 'dark:text-gray-200 dark:hover:text-gray-400'">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"/>
                        </svg>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-5 cursor-pointer dark:hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                    </svg>
                </div>
            </div>

            <div x-data="{ open: true }" class="border-b dark:border-[#0f0f14] dark:bg-[#27282b]">
                <button @click="open = !open"
                        class="flex justify-between items-center w-full px-2 py-1 text-left dark:bg-[#27282b] bg-[#f7f7f7]">
                    <span class="text-[12px] pl-1.5 ">Pinned</span>

                    <svg :class="{ 'rotate-90': open }" class="transform transition-transform size-3.5"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>

                <div x-transition x-show="open" class="space-y-3 px-3 py-3 pl-4 dark:bg-[#1e2020]">
                    <div
                        class="bg-[#e4f2fe] dark:bg-[#2d2e31] rounded-[4px] p-3 flex justify-between items-start transition-all cursor-pointer w-52 border-b border-gray-600/20 dark:border-gray-300/10">
                        <div>
                            <div class="text-sm font-semibold dark:text-white flex items-center gap-1 rounded">
                                <x-hugeicons-pin class="w-4 h-4 text-[#1182c9] dark:text-[#4889ed]" stroke-width="1"/>
                                <span class="font-medium text-[12px]">Title</span>
                            </div>
                            <p class="text-[11px] text-gray-500 mt-1 truncate max-w-[180px] ">Content</p>
                            <span class="text-[10px] text-gray-400 mt-1 block">Date</span>
                        </div>
                        <img src="https://img.icons8.com/doodle/512/square.png" alt="thumb"
                             class="w-12 h-12 rounded-md object-cover">
                    </div>
                </div>
            </div>

            <div class="p-1 space-y-2 bg-[#f7f7f7] dark:bg-[#141419] dark:border-black"></div>

            <div
                x-data="{ selected: null }"
                class="space-y-3 pl-4 py-2 dark:bg-[#1e2020] max-h-[calc(100vh-300px)] min-h-[100vh] overflow-y-auto custom-scrollbar"
                id="notes-list"
                :class="arranging ? 'cursor-move' : ''">


                @foreach($notes->sortBy('order') as $note)
                    @php
                        $title = '';
                        $body = '';
                        $dom = new \DOMDocument();
                        @$dom->loadHTML('<html><body>' . $note->content . '</body></html>');
                        $bodyElement = $dom->getElementsByTagName('body')->item(0);
                        $lines = [];

                        if ($bodyElement) {
                            foreach ($bodyElement->childNodes as $node) {
                                if ($node->nodeType === XML_ELEMENT_NODE || $node->nodeType === XML_TEXT_NODE) {
                                    $text = trim($node->textContent);
                                    if ($text !== '') {
                                        $lines[] = $text;
                                    }
                                }
                            }
                        }

                        $title = $lines[0] ?? '';
                        $body = implode(' ', array_slice($lines, 1));
                    @endphp

                    <div
                        class="rounded p-3 cursor-pointer transition flex items-center justify-between w-52 border-b border-gray-600/20 dark:border-gray-300/10"
                        :class="selected === '{{ $note->id }}' ? 'dark:bg-gray-700 bg-[#e4f2fe]' : 'dark:bg-[#2d2e31] dark:hover:bg-[#35363a]'"
                        data-id="{{ $note->id }}"
                        @click="if (!arranging) { openNote({{ $note->id }}); selected = '{{ $note->id }}' }">
                        <div class="flex-1 min-w-0">
                            <div class="text-[12px] font-medium flex items-center gap-2 truncate">
                                @if($note->is_pinned)
                                    <x-hugeicons-pin
                                        class="w-4 h-4"
                                        :class="selected === '{{ $note->id }}' ? 'dark:text-blue-400 text-[#1182c9]' : 'dark:text-gray-300'"
                                        stroke-width="1"
                                    />
                                @endif
                                <span class="dark:text-white">{{ $title }}</span>
                            </div>
                            <p class="text-[11px] text-gray-500 mt-1 truncate max-w-[180px]">
                                {{ \Illuminate\Support\Str::limit($body, 100, '...') }}
                            </p>
                            <span class="text-[10px] text-gray-400 mt-1 block">
            {{ $note->updated_at->setTimezone('Europe/Istanbul')->format('M j, g:iA') }}
        </span>
                        </div>

                        <template x-if="arranging">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor"
                                 class="w-5 h-5 cursor-move ml-3 select-none dark:hover:text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/>
                            </svg>
                        </template>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    function notesList() {
        return {
            arranging: false,
            sortable: null,
            toggleArrange() {
                this.arranging = !this.arranging;
                if (this.arranging) {
                    this.initSortable();
                } else if (this.sortable) {
                    this.sortable.destroy();
                    this.sortable = null;
                }
            },
            initSortable() {
                if (this.sortable) return;
                this.sortable = Sortable.create(document.getElementById('notes-list'), {
                    animation: 150,
                    handle: 'svg.cursor-move',
                    draggable: '[data-id]',
                    onEnd: (evt) => {
                        const order = [...evt.to.children].map(el => el.getAttribute('data-id'));
                        this.saveOrder(order);
                    }
                });
            },
            saveOrder(order) {
                fetch('/notes/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({order: order})
                }).then(res => {
                    if (!res.ok) throw new Error('Order save failed');
                    return res.json();
                }).then(data => {
                    console.log('Order saved', data);
                }).catch(e => {
                    alert('Sıralama kaydedilirken hata oluştu');
                    console.error(e);
                });
            },
            openNote(id) {
                fetch(`/notes/${id}/content`)
                    .then(res => res.json())
                    .then(data => {
                        if (editorInstance) {
                            editorInstance.setData(data.content);
                        }
                    })
                    .catch(e => {
                        alert("Not içeriği alınamadı.");
                        console.error(e);
                    });
            }
        }
    }
</script>

<section class="w-60 bg-[#1e2020] border-r border-[#0f0f14] overflow-y-auto text-gray-200 min-h-screen"
         x-data="notesList()" x-init="initSortable()">

    <div class="container mx-auto flex justify-between items-center mb-3">
        <div class="w-60 bg-[#1e2020] rounded shadow">
            <div
                class="bg-[#27282b] h-8 p-1 justify-between pl-3 pt-2.5 pb-3 border-b border-[#0f0f14] flex items-center gap-2 px-3">
                <div>
                    <span class="text-[15px]">Get Started</span>
                </div>
                <div class="flex items-center space-x-3 pt-1">
                    <div
                        @click="toggleArrange()"
                        :class="arranging ? 'bg-gray-700 text-blue-400' : 'hover:text-gray-400'"
                        class="flex items-center px-1 py-1 rounded cursor-pointer transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4" :class="arranging ? 'text-blue-400' : 'text-gray-200 hover:text-gray-400'">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"/>
                        </svg>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-5 cursor-pointer hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                    </svg>
                </div>
            </div>

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

                <div x-transition x-show="open" class="space-y-3 px-3 py-3 pl-4 bg-[#1e2020]">
                    <div
                        class="bg-[#2d2e31] rounded-[4px] p-3 flex justify-between items-start transition-all cursor-pointer w-52">
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


            <div class="space-y-3 pl-4 py-2 bg-[#1e2020] max-h-[calc(100vh-300px)] overflow-y-auto custom-scrollbar"
                 id="notes-list" :class="arranging ? 'cursor-move' : ''">

                @foreach($notes->sortBy('order') as $note)
                    @php
                        $title = '';
                        $body = '';

                        $dom = new \DOMDocument();
                        @$dom->loadHTML('<html><body>' . $note->content . '</body></html>');

                        $paragraphs = $dom->getElementsByTagName('p');

                        if ($paragraphs->length > 0) {
                            $title = trim($paragraphs->item(0)->textContent);
                        }

                        if ($paragraphs->length > 1) {
                            $bodyParts = [];
                            for ($i = 1; $i < $paragraphs->length; $i++) {
                                $text = trim($paragraphs->item($i)->textContent);
                                if ($text !== '') {
                                    $bodyParts[] = $text;
                                }
                            }
                            $body = implode(' ', $bodyParts);
                        }
                    @endphp

                    <div class="bg-[#2d2e31] rounded p-3 hover:bg-[#35363a] cursor-pointer transition flex items-center justify-between w-52"
                         :class="arranging ? 'opacity-80' : ''"
                         data-id="{{ $note->id }}"
                         @click="if(!arranging) openNote({{ $note->id }})">
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-bold text-white flex items-center gap-2 truncate">
                                @if($note->is_pinned)
                                    <x-hugeicons-pin class="w-4 h-4 text-[#4889ed]" stroke-width="1"/>
                                @endif
                                {{ $title }}
                            </div>
                            <p class="text-xs text-gray-400 mt-1 truncate max-w-[180px]">
                                {{ \Illuminate\Support\Str::limit($body, 100, '...') }}
                            </p>
                            <span class="text-xs text-gray-500 mt-1 block">
                                {{ $note->updated_at->setTimezone('Europe/Istanbul')->format('M j, g:iA') }}
                            </span>
                        </div>

                        <template x-if="arranging">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" class="w-5 h-5 cursor-move ml-3 select-none hover:text-gray-400">
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
                // Senin openNote fonksiyonun burada çağrılır
                console.log('Note açıldı:', id);
            }
        }
    }
</script>

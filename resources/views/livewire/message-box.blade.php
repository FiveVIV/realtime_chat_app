<div class="size-full flex flex-col justify-between relative" x-data="{ messageOptionsDropdown: $wire.entangle('showMessageOptionsDropdown') }">
    <!-- Messages area with scrolling -->
    <div class="p-4 flex flex-col overflow-y-auto scrollbar-style h-full z-10" id="messageBody">
        @php $previousUserId = null; @endphp
        @foreach($messages as $message)
            @php
                $showName = false;

                $class = 'mb-5'; // Default margin class

                // Check if this is not the first message (to check the previous one)
                if ($loop->index != 0 && $messages[$loop->index - 1]->user->name == $message->user->name) {
                    $class = 'mb-1'; // If the previous message is from the same user
                }

                // Check if this is not the last message (to check the next one)
                if ($loop->remaining > 0 && $messages[$loop->index + 1]->user->name == $message->user->name) {
                    $class = 'mb-1'; // If the next message is from the same user
                }

                if ($message->chat->title) {
                                    // Determine if this is the first message from this user in a sequence
                    $showName = $previousUserId !== $message->user->id;
                    $previousUserId = $message->user->id;
                }

            @endphp
            <div class="break-all group relative max-w-[75%] inline-block p-2 mx-3 rounded-md shadow-md {{ $message->user->id == auth()->id() ? 'ml-auto bg-green-600' : 'mr-auto bg-gray-200' }} {{ $class }}">
                {{-- Show user's name only if it's the first message in a sequence --}}
                @if ($showName && $message->user->id !== auth()->id())
                    <div class="text-sm pb-1 font-thin text-lime-600">{{ $message->user->name }}</div>
                @endif

                <div class="flex justify-between items-end">
                    {{-- Message --}}
                    <span>
                        {{ $message->message }}
                    </span>

                    {{-- Timestamp --}}
                    <span class="text-right flex-shrink-0 ml-2 text-xs text-zinc-900 font-bold">
                        {{ $message->created_at->format('H:i') }}
                    </span>
                </div>

                @if ($message->user == auth()->user())
                    {{-- Message options dropdown --}}
                    <div
                        class="absolute top-1 right-1 text-center rounded-full cursor-pointer z-10 group-hover:block animate-fade-in"
                        @click.outside="messageOptionsDropdown = null"
                        :class="messageOptionsDropdown === {{ $message->id }} ? 'block' : 'hidden group-hover:block'"
                    >
                        <div>
                            <button @click="messageOptionsDropdown = messageOptionsDropdown === {{ $message->id }} ? null : {{ $message->id }}" type="button" class="inline-flex w-full justify-center bg-slate-950 rounded-full text-white" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <svg class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div
                            x-show="messageOptionsDropdown === {{ $message->id }}"
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right bg-slate-950 divide-y divide-gray-100 rounded-md text-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="menu-button"
                            tabindex="-1"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            style="display: none;"
                        >

                            <div class="py-1" role="none">
                                @if(auth()->id() == $message->user->id)
                                    <button wire:click="deleteMessageForSelf({{ $message->id }})" class="text-left block px-4 py-2 text-sm hover:bg-slate-800 w-full" role="menuitem" tabindex="-1">
                                        Delete message for self
                                    </button>
                                    <button wire:click="deleteMessageForAll({{ $message->id }})" class="text-left block px-4 py-2 text-sm hover:bg-slate-800 w-full" role="menuitem" tabindex="-1">
                                        Delete message for all
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Message input field -->
    <div class="w-full px-4 py-2 shadow-md flex align-middle space-x-2">
        <textarea
            id="message-text-box"
            class="w-full border rounded-lg text-3xl h-[52px] resize-none overflow-y-scroll overflow-x-hidden scrollbar-style"
            wire:model="message"
        >
        </textarea>
        <button wire:click="sendMessage" class="flex p-1 hover:bg-slate-950 hover:text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-12">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
            </svg>
        </button>
    </div>
</div>


@script
<script>
    Livewire.on('scroll-bar-update', () => {
        $nextTick(() => {
            let chatHistory = document.getElementById("messageBody");
            chatHistory.scrollTop = chatHistory.scrollHeight;
        });
    });

    window.onload = function () {

        const tx = $("#message-text-box");

        const txHeight = 52; // Capture initial height after the page is loaded
        const maxRows = 2; // Set your maximum number of rows here
        const maxHeight = txHeight * maxRows; // Calculate the maximum height

        for (let i = 0; i < tx.length; i++) {
            // Set the initial height from CSS rather than JavaScript to avoid flickering
            tx[i].style.height = `${txHeight}px`;
            tx[i].style.overflowY = 'hidden';

            // Add event listener for input to adjust height dynamically
            tx[i].addEventListener("input", function () {
                // Reset height so that scrollHeight can adjust correctly
                this.style.height = `${txHeight}px`;

                // Calculate the new height based on the scrollHeight, capped at maxHeight
                let newHeight = Math.min(this.scrollHeight, maxHeight);

                // Only adjust height if scrollHeight exceeds initial height
                if (this.scrollHeight > txHeight) {
                    this.style.height = `${newHeight}px`;
                } else {
                    this.style.height = `${txHeight}px`;
                }

                // Enable scrolling only when content exceeds the maxHeight
                if (this.scrollHeight > maxHeight) {
                    this.style.overflowY = 'scroll';
                } else {
                    this.style.overflowY = 'hidden';
                }
            });
        }

        tx.on('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault(); // Prevent newline on Enter key
                @this.sendMessage(); // Send the message
            }
        });
    }
</script>
@endscript

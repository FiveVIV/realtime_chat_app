<div class="h-screen w-screen overflow-hidden flex bg-blue-500" x-data="{ selectedChat: $wire.entangle('selectedChatId') }">
    <!-- Sidebar with chats -->
    <div class="w-1/4 h-full p-4 overflow-y-auto scrollbar-style border-r-2 relative">
        <ul role="list" class="space-y-3" x-data="{ chatOptionsDropdown: $wire.entangle('showChatOptionsDropdown') }">
            @foreach($chats as $chat)
                <li class="chat-selector px-4 py-4 shadow sm:rounded-md hover:bg-slate-950/75 flex hover:cursor-pointer relative  {{ $selectedChatId === $chat->id ? 'bg-slate-950/75' : 'bg-slate-950' }}">
                    <a href="{{ route('chat', $chat->id) }}" wire:navigate class="flex w-full space-x-4">
                        <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">

                        <div class="flex flex-col justify-between text-gray-100 w-full overflow-hidden">
                            <div class="flex justify-between w-full">
                                <div class="font-bold truncate">
                                    @if($chat->title)
                                        {{ $chat->title }}
                                    @else
                                        {{ $chat->users->firstWhere('id', '!=', auth()->id())->name }}
                                    @endif
                                </div>
                            </div>
                            <div class="flex w-full items-end overflow-hidden">
                                @if($chat->latestMessage)
                                    @if($chat->title !== null)
                                        <div class="mr-1 font-medium text-md flex-shrink-0">
                                            @if($chat->latestMessage->user->id === auth()->id())
                                                You:
                                            @else
                                                {{ $chat->latestMessage->user->name }}:
                                            @endif
                                        </div>
                                    @endif
                                @endif

                                <div class="font-light text-sm text-gray-400 truncate mr-2">
                                    {{ $chat->latestMessage ? $chat->latestMessage->message : "" }}
                                </div>
                                <div class="font-light text-sm pt-0.5 text-gray-400 flex-shrink-0 ml-auto">
                                    @if ($chat->latestMessage)
                                        @if ($chat->latestMessage->created_at->isToday())
                                            {{ $chat->latestMessage->created_at->format("H:i") }}
                                        @else
                                            {{ $chat->latestMessage->created_at->format("d-m") }}
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Chat options dropdown --}}
                    <div class="absolute right-4 top-3 cursor-pointer z-20" @click.outside="chatOptionsDropdown = null" @click.stop>
                        <button @click.stop="chatOptionsDropdown = chatOptionsDropdown === {{ $chat->id }} ? null : {{ $chat->id }}" type="button" class="inline-flex justify-end" aria-expanded="true" aria-haspopup="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </button>

                        <div
                            x-show="chatOptionsDropdown === {{ $chat->id }}"
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none bg-white"
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
                                <button wire:click="leaveChat({{ $chat->id }})" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 w-full" role="menuitem" tabindex="-1" id="menu-item-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>
                                    Leave chat
                                </button>
                            </div>
                        </div>
                    </div>
                </li>



            @endforeach
        </ul>


        <div class="w-full h-20 bg-slate-950 absolute bottom-0 left-0 p-4 flex justify-between align-middle">
            <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">

            <div x-data="{ accountOptionsDropdown: false }" @click.away="accountOptionsDropdown = false">
                <div class="relative inline-block text-left">
                    <div>
                        <button x-ref="button" @click="accountOptionsDropdown = !accountOptionsDropdown" class="size-10 rounded-full my-auto text-gray-400 hover:bg-gray-300 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </button>
                    </div>

                    <!--
                      Dropdown menu, show/hide based on menu state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div x-anchor.offset.10="$refs.button" x-show="accountOptionsDropdown" class="absolute right-0 mb-10 z-10 mt-2 w-56 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         style="display: none;"
                    >
                        <div class="py-1" role="none">
                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                            <x-dropdown-link :href="route('profile')" wire:navigate {{--:active="request()->routeIs('dashboard')"--}}>Profile</x-dropdown-link>
                            <x-dropdown-link :href="route('settings')" wire:navigate {{--:active="request()->routeIs('dashboard')"--}}>Settings</x-dropdown-link>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="w-3/4 h-full">
        {!! $slot !!}
    </div>

</div>



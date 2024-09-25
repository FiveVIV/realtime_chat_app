<x-layouts.friends>
    @if ($friends->isNotEmpty())
    <div class="space-y-3">
        @foreach($friends as $friend)
            <div class="w-full h-16 shadow-md rounded-lg flex align-middle justify-between px-3 bg-gray-50" x-data="{ friendOptionsDropdown: false }">
                <div class="my-auto flex">
                    <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    <div class="ml-4">
                        <div class="text-lg">
                            {{ $friend->name }}
                        </div>
                        <div class="text-sm text-gray-400">
                            {{ $friend->email }}
                        </div>
                    </div>
                </div>
                <div class="my-auto">
                    <button type="button" class="rounded-full bg-white p-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>
                    </button>

                    <div class="relative inline-block text-left">
                        <div>
                            <button x-ref="button" @click="friendOptionsDropdown = !friendOptionsDropdown" type="button" class="rounded-full bg-blue-600 p-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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
                        <div x-anchor="$refs.button" @click.outside="friendOptionsDropdown = false" x-show="friendOptionsDropdown" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none">
                            <div class="py-1" role="none">
                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                <button wire:click="deleteFriend({{ $friend->pivot->friend_id }}, {{ $friend->pivot->sender_id }})" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-0">Delete friend</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <div class="mx-auto max-w-lg">
            <div>
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.713-3.714M14 40v-4c0-1.313.253-2.566.713-3.714m0 0A10.003 10.003 0 0124 26c4.21 0 7.813 2.602 9.288 6.286M30 14a6 6 0 11-12 0 6 6 0 0112 0zm12 6a4 4 0 11-8 0 4 4 0 018 0zm-28 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h2 class="mt-2 text-base font-semibold leading-6 text-gray-900">Add new friends</h2>
                    <p class="mt-1 text-sm text-gray-500">You haven't added any friends yet! find one of your friends or find new friends with the random friend searcher down below!</p>
                </div>
                <div class="mt-6 flex">
                    <label for="email" class="sr-only">Email address</label>
                    <input wire:model="email" type="email" name="email" id="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Enter an email">
                    <button wire:click="sendFriendRequest" type="button" class="ml-4 flex-shrink-0 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Send invite</button>
                </div>
            </div>
            <div class="mt-10">
                <div class="flex justify-between">
                    <h3 class="text-sm font-medium text-gray-500">Random friends</h3>
                    <button wire:click="refreshGetRandomNonFriends()" title="Refresh list">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </button>
                </div>
                <ul role="list" class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
                    @foreach($randomNonFriends as $randomNonFriend)
                        <li class="flex items-center justify-between space-x-3 py-4">
                            <div class="flex min-w-0 flex-1 items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-medium text-gray-900">{{ $randomNonFriend->name }}</p>
                                    <p class="truncate text-sm font-medium text-gray-500">{{ $randomNonFriend->email }}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <button wire:click="sendFriendRequest({{ $randomNonFriend->id }})" type="button" class="inline-flex items-center gap-x-1.5 text-sm font-semibold leading-6 text-gray-900">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    Invite <span class="sr-only">{{ $randomNonFriend->name }}</span>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</x-layouts.friends>

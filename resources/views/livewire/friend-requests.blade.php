<x-layouts.friends>
    <div class="space-y-3">
        @foreach($friendRequests as $friendRequest)
            <div class="w-full h-16 shadow-md rounded-lg flex align-middle justify-between px-3 bg-gray-50">
                <div class="my-auto flex">
                    <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">

                    <div class="ml-4">
                        <div class="text-lg">
                            {{ $friendRequest->name }}
                        </div>
                        <div class="text-sm text-gray-400">
                            {{ $friendRequest->email }}
                        </div>
                    </div>
                </div>

                <div class="my-auto">
                    <button wire:click="acceptFriendRequest({{ $friendRequest->pivot->sender_id }})" type="button" class="rounded-full bg-blue-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </button>
                    <button type="button" class="rounded-full bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>
            </div>

        @endforeach
    </div>



</x-layouts.friends>

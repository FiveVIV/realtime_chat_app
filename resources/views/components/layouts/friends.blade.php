<div class="size-full p-4">
    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow h-full">
        <div class="px-4 pt-5 sm:px-6">
            <div class="border-b border-gray-200 pb-5 sm:pb-0">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Friends</h3>
                <div class="mt-3 sm:mt-4">
                    <!-- Dropdown menu on small screens -->
                    <div class="sm:hidden">
                        <label for="current-tab" class="sr-only">Select a tab</label>
                        <select id="current-tab" name="current-tab" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>Applied</option>
                            <option>Phone Screening</option>
                            <option selected>Interview</option>
                            <option>Offer</option>
                            <option>Hired</option>
                        </select>
                    </div>
                    <!-- Tabs at small breakpoint and up -->
                    <div class="hidden sm:block">
                        <nav class="-mb-px flex space-x-8">
                            <x-card-header-link :href="route('friend.list')" :active="request()->routeIs('friend.list')" wire:navigate>List</x-card-header-link>
                            <x-card-header-link :href="route('friend.requests')" :active="request()->routeIs('friend.requests')" wire:navigate :ping="!\App\Services\FriendService::hasFriendRequests()">Requests</x-card-header-link>
                            <x-card-header-link :href="route('friend.pending')" :active="request()->routeIs('friend.pending')" wire:navigate>Pending</x-card-header-link>

                        </nav>
                    </div>
                </div>
            </div>


        </div>
        <div class="px-4 py-5 sm:p-6 h-full overflow-y-scroll overflow-x-hidden scrollbar-style">
            {{ $slot }}
        </div>
    </div>
</div>

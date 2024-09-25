<div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-50">
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end" id="notification-box">
        @foreach($notifications as $notification)
            @component("components.notifications." . $notification["component"], ["loop" => $loop])
                {{ $notification["message"] }}
                @slot("actionButtons")
                    @foreach($notification["actionButtons"] as $actionButton)
                        {!! $actionButton !!}
                    @endforeach
                @endslot
            @endcomponent
        @endforeach
    </div>
</div>

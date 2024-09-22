<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>
    <body class="font-sans antialiased">

            <livewire:chats slot="{{ $slot }}">


            <style>
                .scrollbar-style::-webkit-scrollbar {
                    width: 16px;

                }

                .scrollbar-style::-webkit-scrollbar-track {
                    background-color: white;
                }

                .scrollbar-style::-webkit-scrollbar-thumb {
                    background-color: #3b82f6;
                    max-height: 30%;
                    border-radius: 10px;
                    border: 2px solid transparent; /* Add "padding" by using a transparent border */
                    background-clip: padding-box; /* Make sure the thumb stays within the scrollbar */
                }
            </style>



    </body>

    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-50">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end" id="notification-box">

        </div>
    </div>


</html>


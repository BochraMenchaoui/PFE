<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Primary Meta Tags -->
        <title>Derja</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @livewireStyles


    </head>

    <body>
        @livewire('chat')

        <script src="{{ asset('/js/app.js') }}"></script>
        @livewireScripts

        <script>
            Echo.private('events')
                .listen('RealTimeMessage', (e) => console.log('RealTimeMessage: ' + e.message));

            Echo.private('events')
                .listenForWhisper('typing', (e) => {
                    console.log(e.name + ' is typing');
                });

            window.addEventListener('typing', event => {
                Echo.private('events')
                    .whisper('typing', {
                        name: event.detail.user
                    });
            });

        </script>
    </body>

    </html>
</div>

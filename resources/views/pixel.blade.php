<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Primary Meta Tags -->
        <title>Derja</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

        <!-- Pixel CSS -->
        <link type="text/css" href="{{ asset('/user/css/pixel.css') }}" rel="stylesheet">

        @livewireStyles


    </head>

    <body>
        <main>
            @yield('content')
        </main>

        <!-- Core -->
        <script src="{{ asset('/admin/@popperjs/core/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/user/js/headroom.js/dist/headroom.min.js') }}"></script>

        <!-- Vendor JS -->
        <script src="{{ asset('/admin/onscreen/dist/on-screen.umd.min.js') }}"></script>
        <script src="{{ asset('/admin/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

        <!-- Pixel JS -->
        <script src="{{ asset('/user/js/pixel.js') }}"></script>
        @livewireScripts

    </body>

    </html>
</div>

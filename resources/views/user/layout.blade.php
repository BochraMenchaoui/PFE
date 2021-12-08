<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Primary Meta Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

        <!-- Pixel CSS -->
        <link type="text/css" href="{{ asset('/user/css/pixel.css') }}" rel="stylesheet">

        {{-- TODO: ken fama haja messed up rajaa el ajax louta fil ekher el page, sinnn wali hez kol js ll page mteeo w nty merte7 --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        @livewire('page-title')

        @livewireStyles

    </head>

    <body>
        <header class="header-global bg-primary">
            <nav id="navbar-main" aria-label="Primary navigation"
                class="navbar navbar-main navbar-expand-lg navbar-theme-primary headroom navbar-dark navbar-theme-primary">
                <div class="container position-relative">
                    <div class="navbar-brand me-lg-5">
                    </div>
                    <div class="navbar-collapse collapse me-auto" id="navbar_global">
                        <div class="navbar-collapse-header">
                            <div class="row">
                                <div class="col-6 collapse-brand">
                                </div>
                                <div class="col-6 collapse-close">
                                    <a href="#navbar_global" class="fas fa-times" data-bs-toggle="collapse"
                                        data-bs-target="#navbar_global" aria-controls="navbar_global"
                                        aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                            <li class="nav-item">
                                <a href="{{ route('search') }}" class="nav-link">
                                    Lawj
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('translate') }}" class="nav-link">
                                    Tarjem
                                </a>
                            </li>
                            @if (Auth::user()->role === 1)
                                @livewire('messages-notification-collab')
                            @endif
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                    id="supportDropdown" aria-expanded="false">
                                    El Kelmet
                                    <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="supportDropdown">
                                    <div class="col-auto px-0">
                                        <div class="list-group list-group-flush">
                                            @if (Auth::user()->role !== 0)
                                                <a href="{{ route('user.suggest.word') }}" target="_blank"
                                                    class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                    <span class="icon icon-sm">
                                                        <span class="fas fa-plus"></span></span>
                                                    <div class="ms-4">
                                                        <span class="d-block font-small fw-bold mb-0">Zid kelma</span>
                                                    </div>
                                                </a>
                                                <a href="{{ route('user.words') }}" target="_blank"
                                                    class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                    <span class="icon icon-sm">
                                                        <span class="fas fa-book"></span>
                                                    </span>
                                                    <div class="ms-4">
                                                        <span
                                                            class="d-block font-small fw-bold mb-0">{{ Auth::user()->role == 1 ? 'El kelmet' : 'Kelmtek' }}</span>
                                                    </div>
                                                </a>
                                            @endif
                                            <a href="{{ route('favourite') }}" target="_blank"
                                                class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                <span class="icon icon-sm">
                                                    <span class="fas fa-star"></span>
                                                </span>
                                                <div class="ms-4">
                                                    <span class="d-block font-small fw-bold mb-0">Favouri</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                    id="supportArDropdown" aria-expanded="false">
                                    Articlouwet
                                    <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="supportArDropdown">
                                    <div class="col-auto px-0">
                                        <div class="list-group list-group-flush">
                                            <a href="{{ route('user.create.post') }}" target="_blank"
                                                class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                <span class="icon icon-sm">
                                                    <span class="fas fa-plus"></span></span>
                                                <div class="ms-4">
                                                    <span class="d-block font-small fw-bold mb-0">Zid article</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('user.owned.posts') }}" target="_blank"
                                                class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                <span class="icon icon-sm">
                                                    <span class="fas fa-file-alt"></span>
                                                </span>
                                                <div class="ms-4">
                                                    <span class="d-block font-small fw-bold mb-0">Articlouwetek</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('user.posts') }}" target="_blank"
                                                class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                <span class="icon icon-sm">
                                                    <span class="fas fa-copy"></span>
                                                </span>
                                                <div class="ms-4">
                                                    <span class="d-block font-small fw-bold mb-0">Articlouwet
                                                        lkol</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @if (Auth::user()->role !== 0)
                                @livewire('user.nav-notification')
                            @endif
                        </ul>
                    </div>
                    <div class="d-flex align-items-center">
                        @if (Auth::user()->role !== 0)
                            <a href="{{ route('profile') }}"
                                class="btn btn-outline-gray-100 d-none d-lg-inline me-md-3">
                                <span class="fas fa-user me-2"></span>
                                Profili
                            </a>
                            <form class="m-0 p-0" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-gray-100 d-lg-inline me-md-3">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Okhrej
                                </button>
                            </form>
                        @else
                            <a href="{{ route('admin.dashboard', ['lang' => 'en']) }}"
                                class="btn btn-outline-gray-100 d-none d-lg-inline me-md-3">
                                <span class="fas fa-chart-pie me-2"></span>
                                Dashboard
                            </a>
                        @endif
                        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <script src="{{ asset('/admin/@popperjs/core/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/user/js/headroom.js/dist/headroom.min.js') }}"></script>

        <!-- Vendor JS -->
        <script src="{{ asset('/admin/onscreen/dist/on-screen.umd.min.js') }}"></script>
        <script src="{{ asset('/admin/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

        <!-- Pixel JS -->
        <script src="{{ asset('/user/js/pixel.js') }}"></script>

        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('/js/user/toast.js') }}"></script>
        @livewireScripts

        {{-- TODO: REVIEW L ASMI LKOL MTE EVENTS --}}
        <script>
            Echo.private('App.Models.User.{{ Auth::id() }}')
                .notification((notification) => {
                    if (notification.message == 'LikedorCommented') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Reactew Al kelma mteik!'
                        });
                        Livewire.emit('notificationAdded');
                    }

                    if (notification.message == 'ReviewWord') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Fama chkoun tlab review.'
                        });
                        Livewire.emit('notificationAdded');
                    }

                    if (notification.message == 'Rejected') {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Kelmtek mat9bltesh.'
                        }); // TODO: badil el message te notification added, w badil listener
                        Livewire.emit('notificationAdded');
                    }

                    if (notification.message == 'Accepted') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Kelmtek t9blet.'
                        });
                        Livewire.emit('wordAccepted');
                    }

                    if (notification.message == 'FavouriteAdded') {
                        Livewire.emit('favouriteAdded')
                    }
                    if (notification.message == 'FavouriteRemoved') {
                        Livewire.emit('favouriteRemoved')
                    }

                    if (notification.message = 'RenderComponent') {
                        Livewire.emit('renderComponent');
                    }

                    if (notification.message = 'CollabOnlineOffline') {
                        Livewire.emit('fetchTeamMembers');
                    }

                    if (notification.message = 'AdminSentMessage') {
                        Livewire.emit('messageNotification');
                    }

                });

            // kif kif nafs el external js file w aaml include
            Echo.private('events')
                .listen('RealTimeMessage', (e) => {
                    Livewire.emit('fetchMessages');
                });

            Echo.private('events')
                .listenForWhisper('typing', (e) => {
                    Livewire.emit('typing', e.name)
                });

            window.addEventListener('typing', event => {
                Echo.private('events')
                    .whisper('typing', {
                        name: event.detail.user
                    });
            });

            $(document).ready(function() {
                window.livewire.on('typing-remove', () => {
                    setTimeout(function() {
                        Livewire.emit('resetTyping');
                    }, 3000);
                });
            });

        </script>
    </body>

    </html>
</div>

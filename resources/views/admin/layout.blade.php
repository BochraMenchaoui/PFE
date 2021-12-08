<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Derja - Admin Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('/admin/css/volt.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    @livewireStyles
</head>

<body>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
        <div class="navbar-brand me-lg-5">
            <!-- Until they send us the SVG version--->
        </div>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-md-block bg-dark text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="user-avatar lg-avatar me-4">
                        <img src="{{ asset('/images/' . Auth::user()->avatar) }}"
                            class="card-img-top rounded-circle border-white">
                    </div>
                    <div class="d-block">
                        <h2 class="h6">Hi, {{ Auth::user()->name }}</h2>
                        <form action="{{ route('admin.logout', ['lang' => app()->getLocale()]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary text-dark btn-xs"><span class="me-2">
                                    <span class="fas fa-sign-out-alt"></span></span>Sign Out
                            </button>
                        </form>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard', ['lang' => app()->getLocale()]) }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span class="sidebar-text">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-users">
                        <span>
                            <span class="sidebar-icon">
                                <span class="fas fa-users"></span>
                            </span>
                            <span class="sidebar-text">{{ __('Users') }}</span>
                        </span>
                        <span class="link-arrow">
                            <span class="fas fa-chevron-right"></span>
                        </span>
                    </span>
                    <div class="multi-level collapse" role="list" id="submenu-users" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.users', ['lang' => app()->getLocale()]) }}"
                                    class="nav-link d-flex justify-content-between">
                                    <span>
                                        <span class="sidebar-icon"><span class="fas fa-list"></span></span>
                                        <span class="sidebar-text">{{ __('List Users') }}</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.user.create', ['lang' => app()->getLocale()]) }}"
                                    class="nav-link d-flex justify-content-between">
                                    <span>
                                        <span class="sidebar-icon"><span class="fas fa-plus-circle"></span></span>
                                        <span class="sidebar-text">{{ __('Create Users') }}</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.user.trashed', ['lang' => app()->getLocale()]) }}"
                                    class="nav-link d-flex justify-content-between">
                                    <span>
                                        <span class="sidebar-icon"><span class="fas fa-trash-alt"></span></span>
                                        <span class="sidebar-text">{{ __('Trashed Users') }}</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-words">
                        <span>
                            <span class="sidebar-icon">
                                <span class="fas fa-book"></span>
                            </span>
                            <span class="sidebar-text">{{ __('Words') }}</span>
                        </span>
                        <span class="link-arrow">
                            <span class="fas fa-chevron-right"></span>
                        </span>
                    </span>
                    <div class="multi-level collapse" role="list" id="submenu-words" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.words', ['lang' => app()->getLocale()]) }}"
                                    class="nav-link d-flex justify-content-between">
                                    <span>
                                        <span class="sidebar-icon"><span class="fas fa-list"></span></span>
                                        <span class="sidebar-text">{{ __('List Words') }}</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.word.create', ['lang' => app()->getLocale()]) }}"
                                    class="nav-link d-flex justify-content-between">
                                    <span>
                                        <span class="sidebar-icon"><span class="fas fa-plus-circle"></span></span>
                                        <span class="sidebar-text">{{ __('Create Words') }}</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.comments', ['lang' => app()->getLocale()]) }}"
                        class="nav-link d-flex justify-content-between">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-comment"></span></span>
                            <span class="sidebar-text">{{ __('Comments') }}</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts', ['lang' => app()->getLocale()]) }}"
                        class="nav-link d-flex justify-content-between">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-file-invoice"></span></span>
                            <span class="sidebar-text">{{ __('Posts') }}</span>
                        </span>
                    </a>
                </li>
                @livewire('messages-notification')
                <li role="separator" class="dropdown-divider mt-4 mb-3 border-black"></li>
                <li class="nav-item">
                    <a href="{{ route('search') }}" target="_blank" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="fas fa-location-arrow"></i>
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">{{ __('Go to site') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">

        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">

                        <h3> {{ __('Welcome Back') }}, {{ Auth::user()->name }}!</h3>
                    </div>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown">
                            @livewire('admin.admin-nav-notification')
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder"
                                        src="{{ asset('images/' . Auth::user()->avatar) }}">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span class="mb-0 font-small fw-bold">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-0">
                                <a class="dropdown-item rounded-top fw-bold"
                                    href="{{ route('admin.profile', ['lang' => app()->getLocale()]) }}">
                                    <span class="far fa-user-circle"></span>
                                    {{ __('My Profile') }}
                                </a>
                                <div role="separator" class="dropdown-divider my-0"></div>
                                <form action="{{ route('admin.logout', ['lang' => app()->getLocale()]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-bottom fw-bold">
                                        <span class="fas fa-sign-out-alt text-danger"></span>{{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            @yield('content')
        </div>
    </main>

    @livewire('lang.language-switcher')

    <!-- Core -->
    <script src="{{ asset('/admin/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('/admin/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('/admin/nouislider/distribute/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('/admin/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('/admin/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('/admin/js/volt.js') }}"></script>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/js/user/toast.js') }}"></script>

    @livewireScripts
    {{-- TODO: REVIEW L ASMI LKOL MTE EVENTS --}}
    <script>
        Echo.private('App.Models.User.{{ Auth::id() }}')
            .notification((notification) => {
                if (notification.message == 'ReviewWord') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Someone asked for a review.'
                    });
                    Livewire.emit('notificationAdded');
                }

                if (notification.message == 'AdminLoggedInLoggedOut') {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Please check your sessions.'
                    });
                    Livewire.emit('notificationAdded');
                    Livewire.emit('renderComponent'); // review this
                }

                if (notification.message == 'MessageSentOrRecieved') {
                    Livewire.emit('messageNotification');
                }
            });

        // hedha maybe 7oto fi external file wala fil messages akhw
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

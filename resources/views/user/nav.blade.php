<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    @livewireStyles
    @livewire('page-title')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('/css/user/nav.css') }}">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-l border-bottom " id="sidebar-wrapper">
            <div class="sidebar-heading ">
                <img src="http://www.bettounsi.com/img/logo_derja.png" alt="Logo Derja" />
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('search') }}" class="list-group-item list-group-item-action">
                    لوج في الديكسيونار
                    <span><i class="fas fa-search"></i> </span></a>
                <a href="#" class="list-group-item list-group-item-action">ترجم الكلمة <span><i
                            class="fas fa-globe"></i>
                    </span></a>
                <a href="#" class="list-group-item list-group-item-action">زيد كلمة <span><i class="fas fa-plus"></i>
                    </span></a>
                <a href="{{ route('favourite') }}" class="list-group-item list-group-item-action">مفضلاتي <span><i
                            class="fas fa-star"></i>
                    </span></a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg border-bottom">
                <button class="btn btn-outline toggleCustom" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span><i class="fas fa-bars toggleCustom"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <div>
                            <style>
                                #notification {
                                    top: 45px;
                                    right: 0px;
                                    left: unset;
                                    width: 450px;
                                    padding-bottom: 0px;
                                    padding: 0px;
                                }

                                #notification:before {
                                    position: absolute;
                                    top: -20px;
                                    right: 12px;
                                    border: 10px solid #343A40;
                                    border-color: transparent transparent #343A40 transparent;
                                }

                                .notification-box {
                                    padding: 5px 0px;
                                }

                                .head {
                                    padding: 5px 15px;
                                    border-radius: 3px 3px 0px 0px;
                                }

                                @media (max-width: 640px) {
                                    .dropdown-menu {
                                        top: 50px;
                                        left: -16px;
                                        width: 290px;
                                    }

                                    .message {
                                        font-size: 13px;
                                    }
                                }

                            </style>
                            @livewire('user.nav-notification')
                        </div>
                        @if (Auth::user()->role !== 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}"> بروفيلي <i
                                            class="fas fa-user" id="bell"></i></a>
                                    <form action="{{ route('logout') }} " method="POST">
                                        @csrf
                                        <button class="dropdown-item" href="#"> أخرج <i class="fas fa-sign-out-alt"
                                                id="bell"></i></button>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard', ['lang' => 'en']) }}" class="nav-link"
                                    id="navbarDropdown">
                                    Dashboard
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>


    <!-- JS includes -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/user/user.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/js/user/toast.js') }}"></script>
    @livewireScripts

    <script>
        Echo.private('App.Models.User.{{ Auth::id() }}')
            .notification((notification) => {
                if (notification.message == 'LikedorCommented') {
                    Toast.fire({
                        icon: 'success',
                        title: 'yhaak machhour!!'
                    });
                    Livewire.emit('notificationAdded');
                }

                if (notification.message == 'Rejected') {
                    Toast.fire({
                        icon: 'warning',
                        title: 'kelmtek mat9bltesh'
                    });
                    Livewire.emit('notificationAdded');
                }

                if (notification.message == 'Accepted') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Mala jaw kelmtek t9blet'
                    });
                    Livewire.emit('notificationAdded');
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
            });

    </script>
</body>

</html>

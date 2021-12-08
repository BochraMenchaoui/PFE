<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Volt - Free Bootstrap 5 Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">
    <meta name="description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="og:title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta property="og:description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="og:image"
        content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="twitter:title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta property="twitter:description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="twitter:image"
        content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">


    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('/admin/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('/admin/css/volt.css') }}" rel="stylesheet">


</head>

<body>




    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
        <a class="navbar-brand me-lg-5" href="../../index.html">
            <img class="navbar-brand-dark"
                src="https://themesberg.com/docs/volt-bootstrap-5-dashboard/assets/brand/light.svg" alt="Volt logo" />
            <img class="navbar-brand-light"
                src="https://themesberg.com/docs/volt-bootstrap-5-dashboard/assets/brand/light.svg" alt="Volt logo" />
        </a>
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
                        <a href="../../pages/examples/sign-in.html" class="btn btn-secondary text-dark btn-xs"><span
                                class="me-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="../../index.html" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="https://themesberg.com/docs/volt-bootstrap-5-dashboard/assets/brand/light.svg"
                                height="20" width="20" alt="Volt Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">Volt Overview</span>
                    </a>
                </li>
                <li class="nav-item  active ">
                    <a href="../../pages/dashboard/dashboard.html" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://demo.themesberg.com/volt-pro/pages/kanban.html" target="_blank"
                        class="nav-link d-flex justify-content-between">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-th"></span></span>
                            <span class="sidebar-text">Kanban </span>
                        </span>
                        <span>
                            <span class="badge badge-md bg-secondary ms-1 text-dark">Pro</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="../../pages/transactions.html" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-hand-holding-usd"></span></span>
                        <span class="sidebar-text">Transactions</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="../../pages/settings.html" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-cog"></span></span>
                        <span class="sidebar-text">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-app">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-table"></span></span>
                            <span class="sidebar-text">Tables</span>
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level collapse " role="list" id="submenu-app" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item ">
                                <a class="nav-link" href="../../pages/tables/bootstrap-tables.html">
                                    <span class="sidebar-text">Bootstrap Tables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-pages">
                        <span>
                            <span class="sidebar-icon"><span class="far fa-file-alt"></span></span>
                            <span class="sidebar-text">Page examples</span>
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level collapse " role="list" id="submenu-pages" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/sign-in.html">
                                    <span class="sidebar-text">Sign In</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/sign-up.html">
                                    <span class="sidebar-text">Sign Up</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/forgot-password.html">
                                    <span class="sidebar-text">Forgot password</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/reset-password.html">
                                    <span class="sidebar-text">Reset password</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/lock.html">
                                    <span class="sidebar-text">Lock</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/404.html">
                                    <span class="sidebar-text">404 Not Found</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/examples/500.html">
                                    <span class="sidebar-text">500 Not Found</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-components">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-box-open"></span></span>
                            <span class="sidebar-text">Components</span>
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level collapse " role="list" id="submenu-components" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item">
                                <a class="nav-link" target="_blank"
                                    href="https://themesberg.com/docs/volt-bootstrap-5-dashboard/components/accordions/">
                                    <span class="sidebar-text">All Components</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../pages/components/buttons.html">
                                    <span class="sidebar-text">Buttons</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../pages/components/notifications.html">
                                    <span class="sidebar-text">Notifications</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../pages/components/forms.html">
                                    <span class="sidebar-text">Forms</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../pages/components/modals.html">
                                    <span class="sidebar-text">Modals</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../pages/components/typography.html">
                                    <span class="sidebar-text">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">

        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        <!-- Search form -->
                        <form class="navbar-search form-inline" id="navbar-search-main">
                            <div class="input-group input-group-merge search-bar">
                                <span class="input-group-text" id="topbar-addon"><span
                                        class="fas fa-search"></span></span>
                                <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                                    aria-label="Search" aria-describedby="topbar-addon">
                            </div>
                        </form>
                    </div>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-dark me-lg-3 icon-notifications dropdown-toggle"
                                data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-bell bell-shake"></span>
                                    <span class="icon-badge rounded-circle unread-notifications"></span>
                                </span>
                            </a>
                            <div
                                class="dropdown-menu dashboard-dropdown dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                                <div class="list-group list-group-flush">
                                    <a href="#"
                                        class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action border-bottom border-light">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder"
                                                    src="{{ asset('images/' . Auth::user()->avatar) }}"
                                                    class="user-avatar lg-avatar rounded-circle">
                                            </div>
                                            <div class="col ps-0 ms-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="h6 mb-0 text-small">Jose Leos</h4>
                                                    </div>
                                                    <div class="text-end">
                                                        <small class="text-danger">a few moments ago</small>
                                                    </div>
                                                </div>
                                                <p class="font-small mt-1 mb-0">Added you to an event "Project stand-up"
                                                    tomorrow at 12:30 AM.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action border-bottom border-light">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder"
                                                    src="../../assets/img/team/profile-picture-2.jpg"
                                                    class="user-avatar lg-avatar rounded-circle">
                                            </div>
                                            <div class="col ps-0 ms-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="h6 mb-0 text-small">Neil Sims</h4>
                                                    </div>
                                                    <div class="text-end">
                                                        <small class="text-danger">2 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="font-small mt-1 mb-0">You've been assigned a task for "Awesome
                                                    new project".</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action border-bottom border-light">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder"
                                                    src="../../assets/img/team/profile-picture-3.jpg"
                                                    class="user-avatar lg-avatar rounded-circle">
                                            </div>
                                            <div class="col ps-0 m-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="h6 mb-0 text-small">Roberta Casas</h4>
                                                    </div>
                                                    <div class="text-end">
                                                        <small>5 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="font-small mt-1 mb-0">Tagged you in a document called "First
                                                    quarter financial plans",
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action border-bottom border-light">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder"
                                                    src="../../assets/img/team/profile-picture-4.jpg"
                                                    class="user-avatar lg-avatar rounded-circle">
                                            </div>
                                            <div class="col ps-0 ms-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="h6 mb-0 text-small">Joseph Garth</h4>
                                                    </div>
                                                    <div class="text-end">
                                                        <small>1 d ago</small>
                                                    </div>
                                                </div>
                                                <p class="font-small mt-1 mb-0">New message: "Hey, what's up? All set
                                                    for the presentation?"</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action border-bottom border-light">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder"
                                                    src="../../assets/img/team/profile-picture-5.jpg"
                                                    class="user-avatar lg-avatar rounded-circle">
                                            </div>
                                            <div class="col ps-0 ms-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="h6 mb-0 text-small">Bonnie Green</h4>
                                                    </div>
                                                    <div class="text-end">
                                                        <small>2 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="font-small mt-1 mb-0">New message: "We need to improve the
                                                    UI/UX for the landing
                                                    page."</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="dropdown-item text-center text-primary fw-bold rounded-bottom py-3">View
                                        all</a>
                                </div>
                            </div>
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
                                <a class="dropdown-item rounded-top fw-bold" href="#"><span
                                        class="far fa-user-circle"></span>My
                                    Profile</a>
                                <a class="dropdown-item fw-bold" href="#"><span class="fas fa-cog"></span>Settings</a>
                                <a class="dropdown-item fw-bold" href="#"><span
                                        class="fas fa-envelope-open-text"></span>Messages</a>
                                <a class="dropdown-item fw-bold" href="#"><span
                                        class="fas fa-user-shield"></span>Support</a>
                                <div role="separator" class="dropdown-divider my-0"></div>
                                <a class="dropdown-item rounded-bottom fw-bold" href="#"><span
                                        class="fas fa-sign-out-alt text-danger"></span>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="btn-toolbar dropdown">
                    <button class="btn btn-dark btn-sm me-2 dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-plus me-2"></span>New Task
                    </button>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-0">
                        <a class="dropdown-item fw-normal rounded-top" href="#"><span class="fas fa-tasks"></span>New
                            Task</a>
                        <a class="dropdown-item fw-normal" href="#"><span class="fas fa-cloud-upload-alt"></span>Upload
                            Files</a>
                        <a class="dropdown-item fw-normal" href="#"><span class="fas fa-user-shield"></span>Preview
                            Security</a>
                        <div role="separator" class="dropdown-divider my-0"></div>
                        <a class="dropdown-item fw-normal rounded-bottom" href="#"><span
                                class="fas fa-rocket text-danger"></span>Upgrade to Pro</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-primary">Export</button>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-12 mb-4">
                    <div class="card rounded-0 bg-secondary-alt shadow-sm">
                        <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                            <div class="d-block mb-3 mb-sm-0">
                                <div class="h5 fw-normal mb-2">Sales Value</div>
                                <h2 class="h3">$10,567</h2>
                                <div class="small mt-2">
                                    <span class="fw-bold me-2">Yesterday</span>
                                    <span class="fas fa-angle-up text-success"></span>
                                    <span class="text-success fw-bold">10.57%</span>
                                </div>
                            </div>
                            <div class="d-flex ms-auto">
                                <a href="#" class="btn btn-secondary text-dark btn-sm me-2">Month</a>
                                <a href="#" class="btn btn-dark btn-sm me-3">Week</a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon icon-shape icon-md icon-shape-primary rounded me-4 me-sm-0"><span
                                            class="fas fa-chart-line"></span></div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Customers</h2>
                                        <h3 class="mb-1">345,678</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Customers</h2>
                                        <h3 class="mb-1">345k</h3>
                                    </div>
                                    <small>Feb 1 - Apr 1, <span class="icon icon-small"><span
                                                class="fas fa-globe-europe"></span></span>
                                        WorldWide</small>
                                    <div class="small mt-2">
                                        <span class="fas fa-angle-up text-success"></span>
                                        <span class="text-success fw-bold">18.2%</span> Since last month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon icon-shape icon-md icon-shape-secondary rounded me-4"><span
                                            class="fas fa-cash-register"></span></div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Revenue</h2>
                                        <h3 class="mb-1">$43,594</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Revenue</h2>
                                        <h3 class="mb-1">$43,594</h3>
                                    </div>
                                    <small>Feb 1 - Apr 1, <span class="icon icon-small"><span
                                                class="fas fa-globe-europe"></span></span>
                                        Worldwide</small>
                                    <div class="small mt-2">
                                        <span class="fas fa-angle-up text-success"></span>
                                        <span class="text-success fw-bold">28.2%</span> Since last month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <h2 class="h5 mb-3">Traffic Share</h2>
                                <h6 class="fw-normal text-gray"><span
                                        class="icon w-20 icon-xs icon-secondary me-1"><span
                                            class="fas fa-desktop"></span></span> Desktop <a href="#" class="h6">60%</a>
                                </h6>
                                <h6 class="fw-normal text-gray"><span class="icon w-20 icon-xs icon-primary me-1"><span
                                            class="fas fa-mobile-alt"></span></span> Mobile Web <a href="#"
                                        class="h6">30%</a></h6>
                                <h6 class="fw-normal text-gray"><span class="icon w-20 icon-xs icon-tertiary me-1"><span
                                            class="fas fa-tablet-alt"></span></span> Tablet Web <a href="#"
                                        class="h6">10%</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8 mb-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="h5">Page visits</h2>
                                    </div>
                                    <div class="col text-right">
                                        <a href="#" class="btn btn-sm btn-secondary">See all</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Page name</th>
                                            <th scope="col">Page Views</th>
                                            <th scope="col">Page Value</th>
                                            <th scope="col">Bounce rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                /demo/admin/index.html
                                            </th>
                                            <td>
                                                3,225
                                            </td>
                                            <td>
                                                $20
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-up text-danger me-3"></span> 42,55%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                /demo/admin/forms.html
                                            </th>
                                            <td>
                                                2,987
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-down text-success me-3"></span> 43,52%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                /demo/admin/util.html
                                            </th>
                                            <td>
                                                2,844
                                            </td>
                                            <td>
                                                294
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-down text-success me-3"></span> 32,35%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                /demo/admin/validation.html
                                            </th>
                                            <td>
                                                2,050
                                            </td>
                                            <td>
                                                $147
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-up text-danger me-3"></span> 50,87%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                /demo/admin/modals.html
                                            </th>
                                            <td>
                                                1,483
                                            </td>
                                            <td>
                                                $19
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-down text-success me-3"></span> 32,24%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header border-bottom border-light d-flex justify-content-between">
                                <h2 class="h5 mb-0">Team members</h2>
                                <a href="#" class="btn btn-sm btn-secondary">See all</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush list my--3">
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="#" class="user-avatar">
                                                    <img class="rounded-circle" alt="Image placeholder"
                                                        src="{{ asset('/images/' . Auth::user()->avatar) }}">
                                                </a>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <a href="#!">Chris Wood</a>
                                                </h4>
                                                <span class="text-success">●</span>
                                                <small>Online</small>
                                            </div>
                                            <div class="col text-right">
                                                <a href="#" class="btn btn-sm btn-tertiary"><i
                                                        class="fas fa-calendar-check me-1"></i>
                                                    Invite</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="#" class="user-avatar">
                                                    <img class="rounded-circle" alt="Image placeholder"
                                                        src="{{ asset('/images/' . Auth::user()->avatar) }}">
                                                </a>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <a href="#!">Jose Leos</a>
                                                </h4>
                                                <span class="text-warning">●</span>
                                                <small>In a meeting</small>
                                            </div>
                                            <div class="col text-right">
                                                <a href="#" class="btn btn-sm btn-tertiary"><i
                                                        class="fas fa-comment me-1"></i> Message</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="#" class="user-avatar">
                                                    <img class="rounded-circle" alt="Image placeholder"
                                                        src="{{ asset('/images/' . Auth::user()->avatar) }}">
                                                </a>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <a href="#!">Bonnie Green</a>
                                                </h4>
                                                <span class="text-danger">●</span>
                                                <small>Offline</small>
                                            </div>
                                            <div class="col text-right">
                                                <a href="#" class="btn btn-sm btn-tertiary"><i
                                                        class="fas fa-calendar-check me-1"></i>
                                                    Invite</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="#" class="user-avatar">
                                                    <img class="rounded-circle" alt="Image placeholder"
                                                        src="{{ asset('/images/' . Auth::user()->avatar) }}">
                                                </a>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <a href="#">Neil Sims</a>
                                                </h4>
                                                <span class="text-success">●</span>
                                                <small>Online</small>
                                            </div>
                                            <div class="col text-right">
                                                <a href="#" class="btn btn-sm btn-tertiary"><i
                                                        class="fas fa-comment me-1"></i> Message</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header border-bottom border-light">
                                <h2 class="h5 mb-0">Progress track</h2>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <span class="icon icon-md text-purple"><span
                                                class="fab fa-bootstrap"></span></span>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Rocket - SaaS Template</div>
                                                <div class="small fw-bold text-dark"><span>34 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-purple" role="progressbar"
                                                    aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 34%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <span class="icon icon-md text-danger"><span
                                                class="fab fa-angular"></span></span>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Pixel - Design System</div>
                                                <div class="small fw-bold text-dark"><span>60 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <span class="icon icon-md text-success"><span
                                                class="fab fa-vuejs"></span></span>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Spaces - Listings Template</div>
                                                <div class="small fw-bold text-dark"><span>45 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-tertiary" role="progressbar"
                                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 45%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <span class="icon icon-md text-info"><span class="fab fa-react"></span></span>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Stellar - Dashboard</div>
                                                <div class="small fw-bold text-dark"><span>35 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="35"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="icon icon-md text-purple"><span
                                                class="fab fa-bootstrap"></span></span>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Volt - Dashboard</div>
                                                <div class="small fw-bold text-dark"><span>34 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-purple" role="progressbar"
                                                    aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 34%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-4">
                <div class="col-12 px-0 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                            <div class="d-block">
                                <div class="h6 fw-normal text-gray mb-2">Total orders</div>
                                <h2 class="h3">452</h2>
                                <div class="small mt-2">
                                    <span class="fas fa-angle-up text-success"></span>
                                    <span class="text-success fw-bold">18.2%</span>
                                </div>
                            </div>
                            <div class="d-block ms-auto">
                                <div class="d-flex align-items-center text-right mb-2">
                                    <span class="shape-xs rounded-circle bg-dark me-2"></span>
                                    <span class="fw-normal small">July</span>
                                </div>
                                <div class="d-flex align-items-center text-right">
                                    <span class="shape-xs rounded-circle bg-secondary me-2"></span>
                                    <span class="fw-normal small">August</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            {!! $bar->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div
                                class="d-flex align-items-center justify-content-between border-bottom border-light pb-3">
                                <div>
                                    <h6 class="mb-0"><span class="icon icon-xs me-3"><span
                                                class="fas fa-globe-europe"></span></span>Global Rank</h6>
                                </div>
                                <div>
                                    <a href="#" class="text-primary fw-bold">#755<span
                                            class="fas fa-chart-line ms-2"></span></a>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between border-bottom border-light py-3">
                                <div>
                                    <h6 class="mb-0"><span class="icon icon-xs me-3"><span
                                                class="fas fa-flag-usa"></span></span>Country
                                        Rank</h6>
                                    <div class="small card-stats">United States<span
                                            class="icon icon-xs text-success ms-2"><span
                                                class="fas fa-angle-up"></span></span></div>
                                </div>
                                <div>
                                    <a href="#" class="text-primary fw-bold">#32<span
                                            class="fas fa-chart-line ms-2"></span></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-3">
                                <div>
                                    <h6 class="mb-0"><span class="icon icon-xs me-3"><span
                                                class="fas fa-folder-open"></span></span>Category Rank</h6>
                                    <a href="#" class="small card-stats">Travel > Accomodation</a>
                                </div>
                                <div>
                                    <a href="#" class="text-primary fw-bold">#16<span
                                            class="fas fa-chart-line ms-2"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <h2 class="h5">Acquisition</h2>
                            <p>Tells you where your visitors originated from, such as search engines, social
                                networks or website
                                referrals.</p>
                            <div class="d-block">
                                <div class="d-flex align-items-center pt-3 me-5">
                                    <div class="icon icon-shape icon-sm icon-shape-danger rounded me-3"><span
                                            class="fas fa-chart-bar"></span></div>
                                    <div class="d-block">
                                        <label class="mb-0">Bounce Rate</label>
                                        <h4 class="mb-0">33.50%</h4>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center pt-3">
                                    <div class="icon icon-shape icon-sm icon-shape-quaternary rounded me-3">
                                        <span class="fas fa-chart-area"></span>
                                    </div>
                                    <div class="d-block">
                                        <label class="mb-0">Sessions</label>
                                        <h4 class="mb-0">9,567</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-settings card pt-2 collapse" id="theme-settings">
            <div class="card-body pt-4">
                <button type="button" class="btn-close theme-settings-close" aria-label="Close"
                    data-bs-toggle="collapse" href="#theme-settings" role="button" aria-expanded="false"
                    aria-controls="theme-settings"></button>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="m-0 mb-1 me-4 fs-7">Open source <span role="img" aria-label="gratitude">💛</span>
                    </p>
                    <a class="github-button" href="https://github.com/themesberg/volt-bootstrap-5-dashboard"
                        data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star"
                        data-size="large" data-show-count="true"
                        aria-label="Star themesberg/volt-bootstrap-5-dashboard on GitHub">Star</a>
                </div>
                <a href="https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard" target="_blank"
                    class="btn btn-primary mb-3 w-100">Download <i class="fas fa-download ms-2"></i></a>
                <p class="fs-7 text-gray-700 text-center">Available in the following technologies:</p>
                <div class="d-flex justify-content-center">
                    <a class="me-3" href="https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard"
                        target="_blank">
                        <img src="../../assets/img/technologies/bootstrap-5-logo.svg" class="image image-xs">
                    </a>
                    <a href="https://demo.themesberg.com/volt-react-dashboard/#/" target="_blank">
                        <img src="../../assets/img/technologies/react-logo.svg" class="image image-xs">
                    </a>
                </div>
            </div>
        </div>

        <div class="card theme-settings theme-settings-expand" id="theme-settings-expand">
            <div class="card-body p-3 py-2">
                <span class="fw-bold h6">
                    <i class="fas fa-cogs me-1 fs-7"></i> Settings
                </span>
            </div>
        </div>

        </div>
    </main>

    <!-- Core -->
    <script src="{{ asset('/admin/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('/admin/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('/admin/nouislider/distribute/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('/admin/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Charts -->
    {{-- <script src=" ../../vendor/chartist/dist/chartist.min.js"></script>
    <script src="../../vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script> --}}

    <!-- Datepicker -->
    <script src="../../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="../../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Simplebar -->
    <script src="../../vendor/simplebar/dist/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="{{ asset('/admin/js/volt.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $chart->script() }}
    {{ $donut->script() }}
    {{ $bar->script() }}


</body>

</html>

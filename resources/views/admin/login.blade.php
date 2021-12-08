<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('/admin/css/volt.css') }}" rel="stylesheet">

    @livewireStyles


</head>

<body>


    <main>

        <!-- Section -->
        <section class="d-flex align-items-center my-5 mt-lg-6 mb-lg-5">
            <div class="container">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">{{ __('Hello!') }} {{ __('Sign In') }}</h1>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{ route('admin.validate', ['lang' => app()->getLocale()]) }}" method="POST"
                                class="mt-4">
                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">{{ __('Your Email') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><span
                                                class="fas fa-envelope"></span></span>
                                        <input type="email" class="form-control" placeholder="example@company.com"
                                            id="email" name="email" autofocus required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">{{ __('Your Password') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2"><span
                                                    class="fas fa-unlock-alt"></span></span>
                                            <input type="password" placeholder="{{ __('Password') }}"
                                                class="form-control" id="password" name="password" required>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <div class="d-flex justify-content-between align-items-top mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember_me"
                                                id="remember">
                                            <label class="form-check-label mb-0" for="remember">
                                                {{ __('Remember me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark">{{ __('Sign in') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @livewire('lang.language-switcher')
    <!-- Core -->
    <script src="{{ asset('/admin/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Vendor JS -->
    <script src="{{ asset('/admin/onscreen/dist/on-screen.umd.min.js') }}"></script>
    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Volt JS -->
    <script src="{{ asset('/admin/js/volt.js') }}"></script>

    @livewireScripts


</body>

</html>

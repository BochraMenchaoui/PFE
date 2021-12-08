<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>2FA Verification</title>
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
        <section class="vh-lg-100 bg-soft d-flex align-items-center my-4">
            <div class="container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft border border-light rounded p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <div class="user-avatar large-avatar mx-auto mb-3 border-dark p-2"><img
                                    class="rounded-circle" alt="Image placeholder"
                                    src="{{ asset('/images/' . Auth::user()->avatar) }}"></div>
                            <h1 class="h3">{{ Auth::user()->name }}</h1>
                            <p class="text-gray">{{ __('Better to be safe than sorry.') }}</p>
                        </div>
                        <form action="{{ route('code.verify') }}" method="POST" class="mt-2">
                            @csrf
                            <x-flash />
                            <div class="mb-4">
                                <label for="exampleInputPasswordCard4">Your Code</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="fas fa-unlock-alt"></span>
                                    </span>
                                    <input type="text" placeholder="Code" name="code"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                        id="exampleInputPasswordCard4">
                                </div>
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-dark">{{ __('Unlock') }}</button>
                            </div>
                            <div class="d-grid mt-3">
                                <a href="{{ route('code.resend') }}" class="btn btn-dark">{{ __('Resend') }}</a>
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

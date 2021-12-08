{{-- TODO: tansesh el name*** fil mahomsh livewire lkol ray el validate tekhdem ken b name --}}

@extends('pixel')
@section('content')
    <section style='background: rgba(0, 0, 0, 0) url("/images/form-image.jpg") repeat scroll 0% 0%;'
        class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark"
        data-background="https://i.ibb.co/VjVTRFv/form-image.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="text-center text-md-center mb-3 mt-md-0 text-white">
                        <h1 class="mb-0 h3">Reset password</h1>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input name="token" type="hidden" name="token" value="{{ $request->route('token') }} ">
                            <div class="form-group mb-4">
                                <label for="validationServerEmail">Your Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    placeholder="example@company.com" id="validationServerEmail" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="validationServerPassword">Your Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="Password" id="validationServerPassword" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="validationServerConf">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    id="validationServerConf" name="password_confirmation">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Reset password</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">Go back
                                to the <a href="{{ route('login') }}" class="fw-bold text-underline">login page</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

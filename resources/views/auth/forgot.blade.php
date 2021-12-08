@extends('pixel')
@section('content')
    <section style='background: rgba(0, 0, 0, 0) url("/images/form-image.jpg") repeat scroll 0% 0%;'
        class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark"
        data-background="https://i.ibb.co/VjVTRFv/form-image.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="text-center text-md-center mb-3 mt-md-0 text-white">
                        <h1 class="mb-0 h3">Nsit Mdpssek?</h1>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="validationServerEmail">El mail</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    placeholder="example@company.com" id="validationServerEmail" name="email">
                            </div>
                            @error('email')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <x-flash />
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Ab3ath mail bsh tbadil mdp
                                </button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">
                                Arja3 lel page mta3
                                <a href="{{ route('login') }}" class="fw-bold text-underline">
                                    connexion
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

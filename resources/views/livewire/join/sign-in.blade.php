<div>
    <section style='background: rgba(0, 0, 0, 0) url("/images/form-image.jpg") repeat scroll 0% 0%;'
        class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Connecti</h1>
                        </div>
                        <form method="POST" action="{{ route('validate') }}" wire:submit.prevent="authUser"
                            class="mt-4">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="validationServerUsername">El Email</label>
                                <input wire:model="email" type="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : ($email ? 'is-valid' : '') }}"
                                    id="validationServerUsername" placeholder="example@company.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="validationServerUsername">El Pass</label>
                                    <input wire:model="password" type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : ($password ? 'is-valid' : '') }}"
                                        id="validationServerUsername" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" wire:model="remember_me" type="checkbox"
                                            value="true" id="remember">
                                        <label class="form-check-label mb-0" for="remember">
                                            Tfakrni
                                        </label>
                                    </div>
                                    <div>
                                        <a href="{{ route('password.request') }}" class="small text-right">
                                            Nsit mdpssek?
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <x-flash />
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Connecti</button>
                            </div>
                        </form>
                        <div class="mt-3 mb-4 text-center">
                            <span class="fw-normal">Walla connecti b</span>
                        </div>
                        <div class="btn-wrapper my-4 text-center">
                            <a href="{{ route('social', ['provider' => 'google']) }}"
                                class="btn btn-icon-only btn-pill btn-outline-gray-300 text-google me-2"
                                aria-label="google button" title="google button">
                                <span aria-hidden="true" class="fab fa-google"></span>
                            </a>
                            <a href="{{ route('social', ['provider' => 'github']) }}"
                                class="btn btn-icon-only btn-pill btn-outline-gray-300 text-facebook"
                                aria-label="github button" title="github button">
                                <span aria-hidden="true" class="fab fa-github"></span>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">
                                Mksh m9ayed?
                                <a href="{{ route('sign-up') }}" class="fw-bold text-underline">A3mel cmpt</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

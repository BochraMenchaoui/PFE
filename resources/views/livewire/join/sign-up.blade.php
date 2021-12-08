<div>
    <!-- TODO: zid background (done, 7otha fi storage wakhw) hne w fi login bsh tbenesh fergha w tji azyen, sinn shouf ma bou kifeh tkoun azyen heya deja fi form 9dim kent fergha--->
    <section style='background: rgba(0, 0, 0, 0) url("/images/form-image.jpg") repeat scroll 0% 0%;'
        class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">9ayed Rohek M3ana</h1>
                        </div>
                        <form method="POST" action="{{ route('r_validate') }}" wire:submit.prevent="saveUser">
                            <!-- Form -->
                            <div class="form-group mb-2">
                                <label for="validationServerUsername">Ismk</label>
                                <input wire:model="name" type="text"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : ($name ? 'is-valid' : '') }}"
                                    id="validationServerUsername" placeholder="Mohamed Salah">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-2">
                                    <label for="validationServerEmail">El mail</label>
                                    <input wire:model="email" type="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : ($email ? 'is-valid' : '') }}"
                                        id="validationServerEmail" placeholder="example@company.com">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- End of Form -->
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="validationServerPassword">El mdp</label>
                                    <input wire:model="password" type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : ($password ? 'is-valid' : '') }}"
                                        id="validationServerPassword" placeholder="Mdp">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- End of Form -->
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sajel</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">
                                Andek cmpt déja?
                                <a href="{{ route('login') }}" class="fw-bold text-underline">Connecti</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

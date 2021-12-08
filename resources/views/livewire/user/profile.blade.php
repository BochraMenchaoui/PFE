<div>
    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                <div class="col-12 col-lg-5 mb-3 mb-lg-0">
                    <div class="card border-gray-300 p-2 mb-4">
                        <div
                            class="card-header bg-white border-0 text-center d-flex flex-row flex-lg-column align-items-center justify-content-center px-1 px-lg-4">
                            <div class="profile-thumbnail dashboard-avatar d-none d-lg-inline mx-lg-auto me-3">
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}"
                                        class="card-img-top rounded-circle border-white"
                                        style="width: 230px; height: 160px">
                                @else
                                    <img src="{{ asset('/images/' . Auth::user()->avatar) }}"
                                        class="card-img-top rounded-circle border-white"
                                        style="width: 230px; height: 160px">
                                @endif
                            </div>
                            <span class="h5 my-0 my-lg-3 me-3 me-lg-0">Aselma, {{ $user->name }}!</span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-gray-300 btn-xs mx-2 mb-2">
                                    <span class="me-2">
                                        <span class="fas fa-sign-out-alt"></span>
                                    </span>
                                    Okhrej
                                </button>
                                <a wire:click="deleteUser" class="btn btn-danger btn-xs mb-2">
                                    <span class="me-2">
                                        <span class="fas fa-user-times"></span>
                                    </span>
                                    Faskh
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="card card-body bg-white border-gray-300 mb-4">
                        <form wire:submit.prevent="updateUserAvatar">
                            <h2 class="h5 mb-4">Badel photo de profil</h2>
                            <div class="row align-items-center">
                                <div class="col-2 col-lg-2 mb-2 mb-lg-0">
                                    <div class="avatar-lg">
                                        @if ($photo)
                                            <img style="width: 50px; height: 50px" class="rounded-circle"
                                                src="{{ $photo->temporaryUrl() }}">
                                        @else
                                            <img style="width: 50px; height: 50px" class="rounded-circle"
                                                src="{{ asset('/images/' . Auth::user()->avatar) }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-10 col-lg-10">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">A5tar taswira</label>
                                        <input wire:model="photo" class="form-control form-control-sm" type="file"
                                            id="formFile">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <button class="btn btn-sm w-100 btn-primary" type="submit">Sajel</button>
                                </div>
                                @error('photo')
                                    <small class="text-center text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-body bg-white border-gray-300 mb-4">
                                <h2 class="h5 mb-4">Ma3loumet 3ama</h2>
                                <form wire:submit.prevent="updateGeneralInfo">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="mb-3">
                                                <label for="first_name">Esmek</label>
                                                <div class="input-group">
                                                    <input wire:model="name"
                                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : ($name ? 'is-valid' : '') }}"
                                                        id="first_name" type="text" placeholder="Ekteb esmek houni"
                                                        {{ $nameToggled ? 'disabled' : '' }}>
                                                    <span wire:click="toggleDisable('name')"
                                                        class="input-group-text lockUserCreate">
                                                        <span
                                                            class="fas {{ $nameToggled ? 'fa-comment' : 'fa-comment-slash' }} }}"></span>
                                                    </span>
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback-general">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="mb-3">
                                                <label for="email">El mail</label>
                                                <div class="input-group">
                                                    <input wire:model="email"
                                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : ($email ? 'is-valid' : '') }}"
                                                        id="email" type="email" placeholder="EKteb el mail houni"
                                                        {{ $emailToggled ? 'disabled' : '' }}>
                                                    <span wire:click="toggleDisable('email')"
                                                        class="input-group-text lockUserCreate">
                                                        <span
                                                            class="fas {{ $emailToggled ? 'fa-comment' : 'fa-comment-slash' }} }}"></span>
                                                    </span>
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback-general">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if (!($emailToggled && $nameToggled))
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary">Sajel</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                            <div class="card card-body bg-white border-gray-300 mb-4">
                                <h2 class="h5 mb-4">Sécurité</h2>
                                <form wire:submit.prevent="updateUserPassword">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="mb-3">
                                                <label for="password">Mdp le9dim</label>
                                                <input wire:model="current_password"
                                                    class="form-control {{ $errors->has('current_password') ? 'is-invalid' : ($current_password ? 'is-valid' : '') }}"
                                                    id="password" type="password" placeholder="Ekteb el mdp el le9dim"
                                                    {{ Auth::user()->provider ? 'disabled' : '' }}>
                                                @error('current_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="mb-3">
                                                <label for="new_password">Mdp jdid</label>
                                                <input wire:model="password"
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : ($password ? 'is-valid' : '') }}"
                                                    id="new_password" type="password" placeholder="Ekteb el mdp el jdid"
                                                    {{ Auth::user()->provider ? 'disabled' : '' }}>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="mb-3">
                                                <label for="con_new_password">Confirmi mdp jdid</label>
                                                <input wire:model="password_confirmation"
                                                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ($password_confirmation ? 'is-valid' : '') }}"
                                                    id="con_new_password" type="password"
                                                    placeholder="Confirmi el mdp el jdid"
                                                    {{ Auth::user()->provider ? 'disabled' : '' }}>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if (!Auth::user()->provider)
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary">Sajel</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/adminProfile.js') }}"></script>
    <script src="{{ asset('/js/user/profile.js') }}"></script>
</div>

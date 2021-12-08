<div>
    <link rel="stylesheet" href="{{ asset('/admin/css/profile.css') }}">
    <div class="row mt-5">
        <div class="col-12 col-sm-12 col-xl-7">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card card-body shadow-sm mb-4">
                        <h2 class="h5 mb-4">{{ __('General informations') }}</h2>
                        <form wire:submit.prevent="updateGeneralInfo">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div>
                                        <label for="first_name">{{ __('Name') }}</label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            wire:model.defer="name" id="first_name" type="text"
                                            placeholder="{{ __('Enter your first name') }}">
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="email" wire:model.defer="email" type="email"
                                            placeholder="name@domain.com">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-dark">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-xl-12">
                    <div class="card card-body shadow-sm mb-4">
                        <h2 class="h5 mb-2">{{ __('Security') }}</h2>
                        <small class="form-text text-muted mb-2">
                            {{ __('Please consider that updating your password will logout all your connected devices.') }}
                        </small>
                        <form wire:submit.prevent="updateAdminPassword">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="address">{{ __('Current Password') }}</label>
                                        <input wire:model.defer="current_password"
                                            class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                            id="address" type="password"
                                            placeholder="{{ __('Enter your password') }}">
                                    </div>
                                    @error('current_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="address">{{ __('New Password') }}</label>
                                        <input wire:model.defer="password"
                                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="address" type="password"
                                            placeholder="{{ __('Enter your password') }}">
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="address">{{ __('Repeat Password') }}</label>
                                        <input wire:model.defer="password_confirmation"
                                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                            id="address" type="password"
                                            placeholder="{{ __('Enter your password') }}">
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-dark">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-xl-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header border-bottom border-gray-300">
                            <div class="row d-block d-md-flex align-items-center">
                                <div class="col">
                                    <h3 class="h5">{{ __('Your Sessions') }}</h3>
                                    <p class="small">
                                        {{ __('You may logout of all connected sessions, however if you feel your account has been compromised, you must update your password.') }}
                                    </p>
                                </div>
                                @if ($devices && count($devices) > 1)
                                    <div class="col-auto">
                                        <button wire:click="requestPassword({{ 0 }})"
                                            class="btn btn-sm btn-dark">
                                            {{ __('Log out all') }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($devices)
                                @foreach ($devices as $device)
                                    <div
                                        class="row align-items-center {{ !$loop->last ? 'border-bottom' : '' }} border-gray-300 pb-2 mb-2">
                                        <div class="col-auto">
                                            <span
                                                class="fab fa-3x fa-{{ Str::lower($device['platform']) }} {{ Str::lower($device['platform']) }}"></span>
                                        </div>
                                        <div class="col">
                                            <h3 class="h5">
                                                {{ $device['platform'] }} - {{ $device['browser'] }}
                                            </h3>
                                            <span class="small fw-bold">
                                                {{ __($device['connected_at']->diffForHumans()) }},
                                                {{ $device['ip'] }},
                                                @if ($current === $device['id'])
                                                    <span class="text-success">
                                                        {{ __('This device') }}
                                                    </span>
                                                @else
                                                    <span>
                                                        @if (!empty($device['country']))
                                                            {{ $device['country'] }}, {{ $device['city'] }}
                                                        @else
                                                            <em>{{ __('Somewhere near you.') }}</em>
                                                        @endif
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12 col-sm-12 col-xl-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow-sm text-center p-0">
                        <div class="profile-cover rounded-top bg-dark"></div>
                        <div class="card-body pb-5">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}"
                                    class="user-avatar large-avatar rounded-circle mx-auto mt-n7 mb-4"
                                    alt="Neil Portrait">
                            @else
                                <img src="{{ asset('/images/' . Auth::user()->avatar) }}"
                                    class="user-avatar large-avatar rounded-circle mx-auto mt-n7 mb-4"
                                    alt="Neil Portrait">
                            @endif
                            <h4 class="h3">{{ Auth::user()->name }}</h4>
                            <h5 class="fw-normal">{{ Auth::user()->email }}</h5>
                            <p class="text-gray mb-4">{{ __('Tunisia') }}, Tunis</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-body shadow-sm mb-4">
                        <h2 class="h5 mb-4">{{ __('Select A New Photo') }}</h2>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <!-- Avatar -->
                                @if ($photo)
                                    <div class="user-avatar xl-avatar">
                                        <img class="rounded" src="{{ $photo->temporaryUrl() }}" alt="change avatar">
                                    </div>
                                @else
                                    <div class="user-avatar xl-avatar">
                                        <img class="rounded" src="{{ asset('/images/' . Auth::user()->avatar) }}"
                                            alt="change avatar">
                                    </div>
                                @endif
                            </div>
                            <div class="file-field">
                                <div class="d-flex justify-content-xl-center ms-xl-3">
                                    <div class="d-flex">
                                        <span class="icon icon-md"><span class="fas fa-paperclip me-3"></span></span>
                                        <input wire:model="photo" type="file">
                                        <div class="d-md-block text-left">
                                            <div class="fw-normal text-dark mb-1">{{ __('Choose Image') }}</div>
                                            <div class="text-gray small">
                                                {{ __('JPG, GIF or PNG. Max size of 1024k') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <button wire:click="updateAdminAvatar" class="btn btn-dark">{{ __('Save') }}</button>
                        </div>
                        @error('photo')
                            <small class="text-center text-danger mt-2">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                @livewire('admin.two-factor-security')
            </div>
        </div>
    </div>

</div>

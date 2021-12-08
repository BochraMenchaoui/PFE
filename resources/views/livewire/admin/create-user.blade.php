<div class="row">
    <div class="col-12 col-md-7 mb-4 mt-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="mb-4">
                                <label for="first">{{ __('Name') }}</label>
                                <input wire:model="name" type="text"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    placeholder="John Doe" id="first">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input wire:model="email" type="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                                    aria-describedby="emailHelp" placeholder="name@company.com">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">
                                    {{ __('A confirmation email will be sent to the user.') }}
                                </small>
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputIconPassword">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input wire:model="password" type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        id="exampleInputIconPassword" placeholder="{{ __('Password') }}"
                                        aria-label="Password">
                                    <span data-toggle="tooltip" data-placement="top" title="Use default password."
                                        id="lockUserCreate" wire:click="setDefaultPassword" class="input-group-text"
                                        id="basic-addon3">
                                        <span class="fas {{ $passwordSet ? 'fa-lock' : 'fa-unlock-alt' }}"></span>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="passwordHelp" class="form-text text-muted">
                                    {{ __('We recommend not using the default password.') }}
                                </small>
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputIconPassword">{{ __('Repeat Password') }}</label>
                                <div class="input-group">
                                    <input wire:model="password_confirmation" type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        id="exampleInputIconPassword" placeholder="{{ __('Repeat Password') }}"
                                        aria-label="Password">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="my-1 me-2" for="role">{{ __('Role') }}</label>
                                <select wire:model="role" class="form-select" id="role">
                                    <option value="2">{{ __('User') }}</option>
                                    <option value="0">{{ __('Admin') }}</option>
                                    <option value="1">{{ __('Collaborator') }}</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-dark">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5 mb-4 mt-4">
        <div class="card text-center p-0 mb-4">
            <div class="profile-cover rounded-top bg-dark">
            </div>
            <div class="card-body pb-5">
                <img src="{{ asset('/images/default.png') }}"
                    class="user-avatar large-avatar rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                <h4 class="h3">
                    {{ $name ? $name : 'Name' }}
                    <span id="badge" class="badge bg-success"><small id="badgeRole">{{ __('User') }}</small></span>
                </h4>
                <h5 class="fw-normal">{{ $email ? $email : 'name@company.com' }} <span
                        class="badge bg-info">{{ __('Manual') }}</span>
                </h5>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <p class="text-gray text-left">{{ __('Created At') }}</p>
                        <p class="text-gray text-left">{{ __('Email Verified At') }}</p>
                        <p class="text-gray text-left">{{ __('Last Login') }}</p>
                    </div>
                    <div class="col-md-5">
                        <p class="text-gray text-left">{{ \Carbon\Carbon::now()->diffForHumans() }}
                        </p>
                        <p class="text-gray text-left">
                            {{ __('Not Yet') }}
                        </p>
                        <p class="text-gray text-left">
                            {{ __('Not Yet') }}
                        </p>
                    </div>
                </div>
                @if ($createdUserId)
                    <a href="{{ route('admin.users.detail', ['id' => $createdUserId, 'lang' => app()->getLocale()]) }}"
                        target="_blank" data-toggle="tooltip" data-placement="top" title="Go to user"
                        class="btn btn-block btn-warning me-2">
                        <span class="fas fa-location-arrow me-1"></span>{{ __('Go To') }}
                    </a>
                @else
                    <button data-toggle="tooltip" data-placement="top" title="Remind the user to log in"
                        class="btn btn-sm btn-secondary me-2">
                        <span class="fas fa-bell me-1"></span>{{ __('Remind') }}
                    </button>
                    <button data-toggle="tooltip" data-placement="top" title="Delete user"
                        class="btn btn-sm btn-danger me-2">
                        <span class="fas fa-trash-alt me-1"></span>{{ __('Delete') }}
                    </button>
                    <button data-toggle="tooltip" data-placement="top" title="Reset user password"
                        class="btn btn-sm btn-info me-2">
                        <span class="fas fa-retweet me-1"></span>{{ __('Reset') }}
                    </button>
                @endif
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('/admin/js/createUser.js') }}"></script>
</div>

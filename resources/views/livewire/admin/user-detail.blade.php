<div>
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-xl-10 mb-4">
            <div class="card shadow-sm text-center p-0">
                <div class="profile-cover rounded-top bg-dark"></div>
                <div class="card-body pb-5">
                    <img src="{{ asset('/images/' . $user->avatar) }}"
                        class="user-avatar large-avatar rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                    <h4 class="h3">{{ $user->name }} <span
                            class="badge bg-{{ $user->role === 0 ? 'danger' : ($user->role === 2 ? 'success' : 'warning') }}">{{ $user->role === 0 ? __('Admin') : ($user->role === 1 ? __('Collaborator') : __('User')) }}</span>
                    </h4>
                    <h5 class="fw-normal">{{ $user->email }} <span
                            class="badge bg-{{ $user->provider ? 'gray' : 'info' }}">{{ $user->provider ? $user->provider : __('Manual') }}</span>
                    </h5>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <p class="text-gray text-left">{{ __('Created At') }}</p>
                            <p class="text-gray text-left">{{ __('Email Verified At') }}</p>
                            <p class="text-gray text-left">{{ __('Last Login') }}</p>
                        </div>

                        <div class="col-md-3">
                            <p class="text-gray">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                            </p>
                            <p class="text-gray">
                                {{ $user->email_verified_at ? \Carbon\Carbon::parse($user->email_verified_at)->diffForHumans() : 'Not Yet' }}
                            </p>
                            <p class="text-gray">
                                {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->diffForHumans() : 'Not Yet' }}
                            </p>
                        </div>
                    </div>
                    @if (Auth::user()->id !== $user->id)
                        <button wire:click="remind" data-toggle="tooltip" data-placement="top"
                            title="Remind the user to log in" class="btn btn-sm btn-secondary me-2">
                            <span class="fas fa-bell me-1"></span>
                            {{ __('Remind') }}
                        </button>
                        <button wire:click="deleteConfirmation" data-toggle="tooltip" data-placement="top"
                            title="Delete user" class="btn btn-sm btn-danger me-2">
                            <span class="fas fa-trash-alt me-1"></span>
                            {{ __('Delete') }}
                        </button>
                        @if (!$user->provider)
                            <button wire:click="resetPassword" data-toggle="tooltip" data-placement="top"
                                title="Reset user password" class="btn btn-sm btn-info me-2">
                                <span class="fas fa-retweet me-1"></span>
                                {{ __('Reset') }}
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @if (Auth::user()->id !== $user->id)
            <div class="col-12 col-xl-10">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">General informations</h2>
                    <form wire:submit.prevent="updateUserInfo">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mb-3">
                                <div>
                                    <label for="name">{{ __('Name') }}</label>
                                    <input wire:model="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                        type="text" placeholder="Enter your first name">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="role">{{ __('Role') }}</label>
                                    <select wire:model.defer="role" class="form-select" id="role">
                                        <option value="2" selected>{{ __('User') }}</option>
                                        <option value="0">{{ __('Admin') }}</option>
                                        <option value="1">{{ __('Collaborator') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mt-3">
                                <button type="submit" class="btn w-100 btn-dark">{{ __('Save') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        @endif

        <div class="col-12 col-xl-10 mb-4" wire:ignore>
            <div class="card shadow-sm">
                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                    <div class="w-100 d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="fw-normal text-gray mb-2">{{ __('User Activity') }}</h3>
                        </div>
                        <div class="d-xl-flex flex-wrap justify-content-end">
                            <div class="d-flex align-items-center mb-2 me-3 lh-130"><span
                                    class="shape-xs rounded-circle bg-dark me-2"></span> <span
                                    class="fw-normal small">{{ __('Words') }}</span> <span
                                    class="small fw-bold text-dark ms-1">{{ $wordsCount }}</span></div>
                            <div class="d-flex align-items-center mb-2 me-3 lh-130"><span
                                    class="shape-xs rounded-circle bg-warning me-2"></span> <span
                                    class="fw-normal small">{{ __('Comments') }}</span> <span
                                    class="small fw-bold text-dark ms-1">{{ $commentsCount }}</span></div>
                            <div class="d-flex align-items-center mb-2 me-3 lh-130"><span
                                    class="shape-xs rounded-circle bg-tertiary me-2"></span> <span
                                    class="fw-normal small">{{ __('Likes') }}</span> <span
                                    class="small fw-bold text-dark ms-1">{{ $likesCount }}</span></div>
                            <div class="d-flex align-items-center mb-2 me-3 lh-130"><span
                                    class="shape-xs rounded-circle bg-indigo me-2"></span> <span
                                    class="fw-normal small">{{ __('Dislikes') }}</span> <span
                                    class="small fw-bold text-dark ms-1">{{ $dislikesCount }}</span></div>
                            <div class="d-flex align-items-center mb-2 me-3 lh-130"><span
                                    class="shape-xs rounded-circle bg-pink me-2"></span> <span
                                    class="fw-normal small">{{ __('Posts') }}</span> <span
                                    class="small fw-bold text-dark ms-1">{{ $postsCount }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2 pb-4">
                    <div class="ct-chart-volumes ct-major-tenth ct-series-a">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('/admin/js/userDetail.js') }}"></script>
    <script src="{{ asset('/admin/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script>
        var chart = new Chartist.Line('.ct-chart-volumes', {
            labels: ['{{ __('Jan') }}', '{{ __('Feb') }}', '{{ __('Mar') }}',
                '{{ __('Apr') }}',
                '{{ __('May') }}', '{{ __('Jun') }}',
                '{{ __('Jul') }}', '{{ __('Aug') }}', '{{ __('Sept') }}',
                '{{ __('Oct') }}',
                '{{ __('Nov') }}', '{{ __('Dec') }}'
            ],
            series: [
                [{{ $wordsPerYear[0] }}, {{ $wordsPerYear[1] }}, {{ $wordsPerYear[2] }},
                    {{ $wordsPerYear[3] }}, {{ $wordsPerYear[4] }}, {{ $wordsPerYear[5] }},
                    {{ $wordsPerYear[6] }}, {{ $wordsPerYear[7] }}, {{ $wordsPerYear[8] }},
                    {{ $wordsPerYear[9] }}, {{ $wordsPerYear[10] }}, {{ $wordsPerYear[11] }}
                ],
                [{{ $commentsPerYear[0] }}, {{ $commentsPerYear[1] }}, {{ $commentsPerYear[2] }},
                    {{ $commentsPerYear[3] }}, {{ $commentsPerYear[4] }},
                    {{ $commentsPerYear[5] }},
                    {{ $commentsPerYear[6] }}, {{ $commentsPerYear[7] }},
                    {{ $commentsPerYear[8] }},
                    {{ $commentsPerYear[9] }}, {{ $commentsPerYear[10] }},
                    {{ $commentsPerYear[11] }}
                ],
                [{{ $likesPerYear[0] }}, {{ $likesPerYear[1] }}, {{ $likesPerYear[2] }},
                    {{ $likesPerYear[3] }}, {{ $likesPerYear[4] }}, {{ $likesPerYear[5] }},
                    {{ $likesPerYear[6] }}, {{ $likesPerYear[7] }}, {{ $likesPerYear[8] }},
                    {{ $likesPerYear[9] }}, {{ $likesPerYear[10] }}, {{ $likesPerYear[11] }}
                ],
                [{{ $dislikesPerYear[0] }}, {{ $dislikesPerYear[1] }}, {{ $dislikesPerYear[2] }},
                    {{ $dislikesPerYear[3] }}, {{ $dislikesPerYear[4] }},
                    {{ $dislikesPerYear[5] }},
                    {{ $dislikesPerYear[6] }}, {{ $dislikesPerYear[7] }},
                    {{ $dislikesPerYear[8] }},
                    {{ $dislikesPerYear[9] }}, {{ $dislikesPerYear[10] }},
                    {{ $dislikesPerYear[11] }}
                ],
                [{{ $postsPerYear[0] }}, {{ $postsPerYear[1] }}, {{ $postsPerYear[2] }},
                    {{ $postsPerYear[3] }}, {{ $postsPerYear[4] }},
                    {{ $postsPerYear[5] }},
                    {{ $postsPerYear[6] }}, {{ $postsPerYear[7] }},
                    {{ $postsPerYear[8] }},
                    {{ $postsPerYear[9] }}, {{ $postsPerYear[10] }},
                    {{ $postsPerYear[11] }}
                ],

            ]
        }, {
            // Remove this configuration to see that chart rendered with cardinal spline interpolation
            // Sometimes, on large jumps in data values, it's better to use simple smoothing.
            lineSmooth: Chartist.Interpolation.simple({
                divisor: 2
            }),
            plugins: [
                Chartist.plugins.tooltip()
            ],
            fullWidth: true,
            chartPadding: {
                right: 20
            },
            low: 0
        });

    </script>

</div>

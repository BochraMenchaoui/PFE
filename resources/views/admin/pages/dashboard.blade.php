@extends('admin.layout')
@section('content')
    <div class="row justify-content-md-center mt-5">
        <div class="col-12 mb-4">
            <div class="card rounded-0 bg-secondary-alt shadow-sm">
                <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                    <div class="d-block mb-3 mb-sm-0">
                        <h2 class="h3">{{ __('Users') }}/{{ __('Words') }} {{ __('Growth Per Year') }}</h2>
                    </div>
                    @livewire('current-time')
                </div>
                <div class="card-body p-2">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-primary rounded me-4 me-sm-0"><span
                                    class="fas fa-users"></span></div>
                            <div class="d-sm-none">
                                <h2 class="h5">{{ __('Users') }}</h2>
                                <h3 class="mb-1">{{ $data['usersCount'] }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">{{ __('Users') }}</h2>
                                <h3 class="mb-1">{{ $data['usersCount'] }}</h3>
                            </div>
                            <small>{{ Carbon\Carbon::now()->subDays(30)->format('M') }} -
                                {{ Carbon\Carbon::now()->format('M') }}
                            </small>
                            <div class="small mt-2">
                                <span
                                    class="fas fa-angle-{{ $usersGrowth >= 0 ? 'up' : 'down' }} text-{{ $usersGrowth >= 0 ? 'success' : 'danger' }}"></span>
                                <span
                                    class="text-{{ $usersGrowth > 0 ? 'success' : 'danger' }} fw-bold">{{ $usersGrowth }}%</span>
                                {{ __('Since last month') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-secondary rounded me-4"><span
                                    class="fas fa-book"></span></div>
                            <div class="d-sm-none">
                                <h2 class="h5">{{ __('Words') }}</h2>
                                <h3 class="mb-1">{{ $data['wordsCount'] }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">{{ __('Words') }}</h2>
                                <h3 class="mb-1">{{ $data['wordsCount'] }}</h3>
                            </div>
                            <small>{{ Carbon\Carbon::now()->subDays(30)->format('M') }} -
                                {{ Carbon\Carbon::now()->format('M') }}
                            </small>
                            <div class="small mt-2">
                                <span
                                    class="fas fa-angle-{{ $wordsGrowth >= 0 ? 'up' : 'down' }} text-{{ $wordsGrowth >= 0 ? 'success' : 'danger' }}"></span>
                                <span
                                    class="text-{{ $wordsGrowth >= 0 ? 'success' : 'danger' }} fw-bold">{{ $wordsGrowth }}%</span>
                                {{ __('Since last month') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-info rounded me-4"><span
                                    class="fas fa-user-tie"></span></div>
                            <div class="d-sm-none">
                                <h2 class="h5">{{ __('Collaborators') }}</h2>
                                <h3 class="mb-1">{{ $data['collabCount'] }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">{{ __('Collaborators') }}</h2>
                                <h3 class="mb-1">{{ $data['collabCount'] }}</h3>
                            </div>
                            <small>{{ Carbon\Carbon::now()->subDays(30)->format('M') }} -
                                {{ Carbon\Carbon::now()->format('M') }}
                            </small>
                            <div class="small mt-2">
                                <span
                                    class="fas fa-angle-{{ $collabsGrowth >= 0 ? 'up' : 'down' }} text-{{ $collabsGrowth >= 0 ? 'success' : 'danger' }}"></span>
                                <span
                                    class="text-{{ $collabsGrowth >= 0 ? 'success' : 'danger' }} fw-bold">{{ $collabsGrowth }}%</span>
                                {{ __('Since last month') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                    <div class="d-block">
                        <div class="h6 fw-normal text-gray mb-2">{{ __('Global Stats') }}</div>
                        <h2 class="h3">Count</h2>
                    </div>
                    <div class="d-block ms-auto">
                        <div class="d-flex align-items-center text-right mb-2">
                            <span class="shape-xs rounded-circle bg-dark me-2"></span>
                            <span class="fw-normal small">
                                {{ __('This Month') }}
                            </span>
                        </div>
                        <div class="d-flex align-items-center text-right">
                            <span class="shape-xs rounded-circle bg-secondary me-2"></span>
                            <span class="fw-normal small">
                                {{ __('Last Month') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-golden-section bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                    <div class="d-block">
                        <div class="h6 fw-normal text-gray mb-2">{{ __('Users Stats') }}</div>
                        <h2 class="h4">{{ __('Activity') }}</h2>
                    </div>
                    <div class="d-block ms-auto">
                        <div class="d-flex align-items-center text-right mb-2"><span
                                class="shape-xs rounded-circle bg-dark me-2"></span> <span
                                class="fw-normal small">{{ __('Inactive') }}</span></div>
                        <div class="d-flex align-items-center text-right mb-2"><span
                                class="shape-xs rounded-circle bg-secondary me-2"></span> <span
                                class="fw-normal small">{{ __('Active') }}</span></div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-golden-section pie-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-8 mb-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="h5">{{ __('Top Users') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('User Name') }}</th>
                                        <th scope="col">{{ __('Total Words') }}</th>
                                        <th scope="col">{{ __('Total Likes') }}</th>
                                        <th scope="col">{{ __('Total Dislikes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['topUsers'] as $user)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('admin.users.detail', ['id' => $user->id, 'lang' => app()->getLocale()]) }}"
                                                    target="_blank">{{ $user->name }}</a>

                                                @if ($loop->index < 3)
                                                    <span
                                                        class="badge bg-{{ $loop->index == 0 ? 'warning' : ($loop->index == 1 ? 'success' : 'danger') }}">{{ $loop->index + 1 }}</span>
                                                @endif
                                            </th>
                                            <td>
                                                {{ $user->words_count }}
                                            </td>
                                            <td>
                                                {{ $user->likes->count() }}
                                            </td>
                                            <td>
                                                {{ $user->dislikes->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-header border-bottom border-light">
                    <h2 class="h5 mb-0">{{ __('Top Region') }}</h2>
                </div>
                <div class="card-body">
                    @foreach ($data['region'] as $region)
                        <div
                            class="row align-items-center {{ $loop->index !== count($data['region']) - 1 ? 'mb-4' : '' }}">
                            <div class="col-auto">
                                @if ($loop->index < 2)
                                    <span class="icon icon-md text-{{ $loop->index == 0 ? 'warning' : 'success' }}"><span
                                            class="fas fa-{{ ($loop->index == 0 ? 'trophy' : $loop->index == 1) ? 'medal' : 'award' }}"></span></span>
                                @endif
                            </div>
                            <div class="col">
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="h6 mb-0">{{ $region->region }} ({{ $region->words_count }})</div>
                                        <div class="small fw-bold text-dark">
                                            <span>{{ round(($region->words_count / $data['wordsCount']) * 100, 2) }}
                                                %</span>
                                        </div>
                                    </div>
                                    <div class="progress mb-0">
                                        <div class="progress-bar bg-{{ $loop->index == 0 ? 'secondary' : ($loop->index == 1 ? 'success' : 'dark') }}"
                                            role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ ($region->words_count / $data['wordsCount']) * 100 }}%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Charts -->
    <script src="{{ asset('/admin/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('/admin/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script>
        var data = {
            series: [
                {{ count($data['inactive']) }},
                {{ $data['usersCount'] - count($data['inactive']) }}
            ]
        };

        var sum = function(a, b) {
            return a + b
        };

        new Chartist.Pie('.pie-chart', data, {
            labelInterpolationFnc: function(value) {
                return Math.round(value / data.series.reduce(sum) * 100) + '%';
            },
            low: 0,
            high: 8,
            fullWidth: false,
            plugins: [
                Chartist.plugins.tooltip()
            ],
        });

        new Chartist.Bar('.bar-chart', {
            labels: ['{{ __('Words') }}', '{{ __('Users') }}', '{{ __('Comments') }}'],
            series: [
                [{{ $data['wordsLastMonth'] }}, {{ $data['usersLastMonth'] }},
                    {{ $data['commentsLastMonth'] }}
                ],
                [{{ $data['wordsThisMonth'] }}, {{ $data['usersThisMonth'] }},
                    {{ $data['commentsThisMonth'] }}
                ],
            ]
        }, {
            low: 0,
            showArea: true,
            plugins: [
                Chartist.plugins.tooltip()
            ],
            axisX: {
                // On the x-axis start means top and end means bottom
                position: 'end'
            },
            axisY: {
                // On the y-axis start means left and end means right
                showGrid: false,
                showLabel: false,
                offset: 0
            }
        });

    </script>

    <!-- Larapex -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $chart->script() }}
@endsection

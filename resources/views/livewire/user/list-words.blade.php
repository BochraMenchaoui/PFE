<div>
    <style>
        td {
            cursor: pointer;
        }

    </style>
    <div class="row mt-6 px-5 py-4">
        @if (Auth::user()->role === 1)
            <div
                class="d-flex col-md-8 col-sm-12 mb-2 justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <div class="d-block mb-4 mb-md-0">
                    <button id="uploadFile" class="btn btn-sm btn-dark p-r-2">
                        <div wire:loading wire:target="document">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </div>
                        <span class="fas fa-upload me-2">
                        </span>
                        Importi
                    </button>
                    <input wire:model="document" type="file" id="importUsers" hidden>
                    @error('document') <span class="text-danger">{{ $message }}</span> @enderror
                    @if (session()->has('message'))
                        <span class="text-danger">
                            {{ session('message') }}
                        </span>
                    @endif
                </div>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group ms-2 ms-lg-3">
                        <a wire:click="exportWordsCSV" class="btn btn-sm btn-outline-primary">CSV</a>
                        <a wire:click="exportWordsPDF" class="btn btn-sm btn-outline-primary">PDF</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-8 col-sm-12 mb-2">
            <div class="card card-body shadow-sm table-wrapper table-responsive mb-4">
                <div class="d-flex mb-3">
                    <select wire:model.defer="selected" class="form-select fmxw-200">
                        <option value="2">Kelmet el kol</option>
                        <option value="1">Kelmt publié</option>
                        <option value="0">Kelmt msh publié</option>
                    </select>
                    <button wire:click="sortBy" class="btn btn-sm px-3 btn-secondary ms-3">Appliqi</button>
                </div>
                <table class="table user-table table-hover align-items-center">
                    <thead>
                        <tr>
                            <th class="border-bottom">El kelma</th>
                            <th class="border-bottom">El Date</th>
                            @if (Auth::user()->role == 2)
                                <th class="border-bottom">El Review</th>
                            @endif
                            <th class="border-bottom">{{ Auth::user()->role == 1 ? 'Action' : 'Win weslt' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <style>
                            .link5 a {
                                color: black;
                                background-image: linear-gradient(to bottom, transparent 65%, #DDE1ED 0);
                                background-size: 0% 100%;
                                background-repeat: no-repeat;
                                text-decoration: none;
                                transition: background-size .4s ease;
                            }

                            .link5 a:hover {
                                background-size: 100% 100%;
                                cursor: pointer;
                            }

                        </style>
                        @forelse ($words as $word)
                            <tr wire:click="moreDetail({{ $word->id }})">
                                <td>
                                    {{ $word->word_lt }}
                                </td>
                                <td>
                                    <span class="fw-normal">
                                        {{ $word->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                @if (Auth::user()->role == 2)
                                    <td>
                                        @if ($word->published === 1)
                                            <span class="badge bg-tertiary mx-3 p-2">
                                                <i class="far fa-thumbs-up"></i>
                                            </span>
                                        @else
                                            @if ($word->created_at <= now()->subDays(7))
                                                <p class="link5">
                                                    <a wire:click="askForWordReview({{ $word->id }})">
                                                        <em>Otleb review</em>
                                                    </a>
                                                </p>
                                            @else
                                                <p>
                                                    <a>
                                                        <em>Osber chwya</em>
                                                    </a>
                                                </p>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    @if ($word->published === 1)
                                        <span class="text-success">Publié</span>
                                    @else
                                        @if (Auth::user()->role === 2)
                                            <div class="progress progress-lg">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark"
                                                    role="progressbar" style="width: 50%;" aria-valuenow="50"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @else
                                            <a data-toggle="tooltip" data-placement="top" title="Reject"
                                                wire:click="deleteConfirmation({{ $word->id }})">
                                                <span class="far fa-2x fa-times-circle text-danger"></span>
                                            </a>
                                            <a data-toggle="tooltip" data-placement="top" title="Accept"
                                                wire:click="publish({{ $word->id }})">
                                                <span class="far fa-2x fa-check-circle text-success"></span>
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-dark text-center">{{ __('No ') }}<em>{{ __('Words') }}</em>
                                        {{ __('Found') }}.
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                    {{ $words->links('admin.pages.pagination') }}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card shadow bg-white border-gray-300 flex-lg-row align-items-center g-0 p-2">
                <div class="card-body d-flex flex-column justify-content-between col-auto py-3 p-0 p-lg-3 p-xl-3">
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-6">
                            <h3 class="h3 text-center mb-3">
                                {{ $detailled_word->word_lt ?? 'Derja' }}
                            </h3>
                        </div>
                        <div class="col-6 col-md-6 col-sm-6">
                            <h3 class="h3 text-center mb-3">
                                {{ $detailled_word->word_ar ?? 'Arbi' }}
                            </h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center mt-2">
                        <div class="col-4 text-center">
                            <p>{{ $detailled_word->fr ?? 'francais' }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p>{{ $detailled_word->ar ?? 'aarbi' }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p>{{ $detailled_word->en ?? 'anglais' }}</p>
                        </div>
                    </div>
                    <hr>
                    @if ($detailled_word?->description)
                        <p>{{ $detailled_word->description }}</p>
                    @else
                        <p>
                            Vel qui et debitis soluta. Voluptatem dolorem dolorem accusamus nemo. Voluptas qui
                            sapiente
                            dolorem perferendis ea doloribus exercitationem.
                        </p>
                    @endif
                    <hr>
                    <div class="row justify-content-center mt-2">
                        <div class="col-6 text-center">
                            <p>{{ $detailled_word->origin ?? 'origin' }}</p>
                        </div>
                        <div class="col-6 text-center">
                            <p>{{ $detailled_word->region ?? 'region' }}</p>
                        </div>
                    </div>

                    <style>
                        .link3 a {
                            color: #343139;
                            text-decoration: none;
                            border-bottom: .125em solid #DDE1ED;
                            box-shadow: inset 0 -0.125em 0 #DDE1ED;
                            transition: box-shadow 270ms cubic-bezier(0.77, 0, 0.175, 1), color 270ms cubic-bezier(0.77, 0, 0.175, 1);
                        }

                        .link3 a:hover {
                            box-shadow: inset 0 -1.125em 0 #DDE1ED;
                            color: #000;
                        }

                        .link3 a:focus {
                            background: #fff;
                            outline: none;
                            background: #DDE1ED;
                            color: #fff;
                            box-shadow: 8px 8px 24px rgba(0, 0, 0, 0.2);
                        }

                    </style>
                    @if ($detailled_word?->published == 1)
                        <hr>
                        <p class="link3 h3 mt-2 text-center">
                            <em><a href="{{ route('details', ['id' => $detailled_word->id]) }}" class="text-center">
                                    Chouf {{ Auth::user()->role == 2 ? 'kelmtek' : 'el kelma' }}</a></em>
                        </p>
                    @else
                        <div class="d-flex align-items-center mt-3">
                            <div class="col justify-content-center d-flex ps-0">
                                <span class="text-muted font-small me-3">
                                    <span class="fas fa-eye me-2">
                                    </span>
                                    0
                                </span>
                                <span class="text-muted font-small me-3">
                                    <span class="far fa-thumbs-up me-2">
                                    </span>
                                    0
                                </span>
                                <span class="text-muted font-small me-3">
                                    <span class="far fa-thumbs-down me-2">
                                    </span>
                                    0
                                </span>
                                <span class="text-muted font-small me-3">
                                    <span class="far fa-comments me-2">
                                    </span>
                                    0
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row card shadow bg-white border-gray-300 justify-content-center flex-lg-row g-0 p-2 mt-3 mb-4">
                <div class="col-12">
                    <h3 class="h3 text-center mb-3">
                        Action
                    </h3>
                </div>
                <div
                    class="col-12 col-md-12 col-lg-{{ is_null($detailled_word) ? '6' : ($detailled_word->published === 0 ? ($detailled_word?->published === 0 && Auth::user()->role === 2 ? '4' : '6') : '4') }} px-2 mb-2">
                    <a href="{{ route('user.suggest.word') }}" target="_blank" class="btn w-100 btn-outline-dark"
                        type="button">
                        <i class="fas fa-plus-circle"></i>
                        Zid
                    </a>
                </div>
                @if (($detailled_word?->published === 0 && Auth::user()->role === 2) || ($detailled_word?->published === 1 && Auth::user()->role === 1))
                    <div class="col-12 col-md-12 col-lg-4 px-2 mb-2">
                        <button wire:click="deleteConfirmation({{ $detailled_word?->id }})"
                            class="btn w-100 btn-outline-danger" type="button">
                            <i class="fas fa-trash-alt"></i>
                            faskh
                        </button>
                    </div>
                @endif
                @if (($detailled_word?->published === 0 && Auth::user()->role === 2) || Auth::user()->role === 1)
                    <div
                        class="col-12 col-md-12 col-lg-{{ is_null($detailled_word) ? '6' : ($detailled_word->published === 0 ? ($detailled_word?->published === 0 && Auth::user()->role === 2 ? '4' : '6') : '4') }} px-2 mb-2">
                        <a href="{{ route('user.edit.word', ['id' => $detailled_word->id ?? '-1']) }}"
                            target="_blank" class="btn w-100 btn-outline-tertiary" type="button">
                            <i class="fas fa-edit"></i>
                            Modifi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('/admin/js/deleteAlert.js') }}"></script>
    <script src="{{ asset('admin/js/adminProfile.js') }}"></script>
    <script src="{{ asset('/admin/js/fileUploadHandler.js') }}"></script>
</div>

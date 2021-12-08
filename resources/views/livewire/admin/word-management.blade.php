<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <button id="uploadFile" class="btn btn-sm btn-dark p-r-2">
                <div wire:loading wire:target="document">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
                <span class="fas fa-upload me-2">
                </span>
                Import
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
            <a href="{{ route('admin.word.create', ['lang' => app()->getLocale()]) }}"
                class="btn btn-sm btn-dark"><span class="fas fa-plus me-2">
                </span> New Word
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <a wire:click="exportWordsCSV" class="btn btn-sm btn-outline-primary">CSV</a>
                <a wire:click="exportWordsPDF" class="btn btn-sm btn-outline-primary">PDF</a>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-6 d-flex">
                <div class="input-group me-2 me-lg-3">
                    <span class="input-group-text">
                        <span class="fas fa-search">
                        </span>
                    </span>
                    <input wire:model="searchQuery" type="text" class="form-control"
                        placeholder="Search by word, its content or its owner...">
                </div>
            </div>
            <div class="col-3 col-lg-6 text-right">
                <div class="btn-group">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-sm icon-gray pt-1">
                            <span class="fas fa-cog"></span>
                        </span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0" style="">
                        <span class="small ps-3 fw-bold text-dark">Show
                        </span>
                        <a wire:click="updatePaginationCount(10)" class="dropdown-item d-flex fw-bold">10
                            @if ($paginationCount === 10)
                                <span class="icon icon-small ms-auto"><span class="fas fa-check"></span></span>
                            @endif
                        </a>
                        <a wire:click="updatePaginationCount(20)" class="dropdown-item d-flex fw-bold">20
                            @if ($paginationCount === 20)
                                <span class="icon icon-small ms-auto"><span class="fas fa-check"></span></span>
                            @endif
                        </a>
                        <a wire:click="updatePaginationCount(30)" class="dropdown-item d-flex fw-bold rounded-bottom">30
                            @if ($paginationCount === 30)
                                <span class="icon icon-small ms-auto"><span class="fas fa-check"></span></span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body shadow-sm table-wrapper table-responsive mt-4 mb-4">
        <div class="d-flex mb-3">
            <select wire:model.defer="selected" class="form-select fmxw-200">
                <option value="2">Show All</option>
                <option value="1">Show Published</option>
                <option value="0">Show Unpublished</option>
            </select>
            <button wire:click="sortBy" class="btn btn-sm px-3 btn-secondary ms-3">Apply</button>
        </div>
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                    <th class="border-bottom">ID</th>
                    <th class="border-bottom">{{ __('Word') }}</th>
                    <th class="border-bottom">{{ __('Author') }}</th>
                    <th class="border-bottom">{{ __('Created At') }} </th>
                    <th class="border-bottom">{{ __('Publish') }}</th>
                    <th class="border-bottom">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($words as $word)
                    <tr>
                        <td>
                            {{ $word->id }}
                        </td>
                        <td>
                            {{ $word->word_lt }}
                        </td>
                        <td>
                            {{ $word->user?->name ?? 'Deleted User' }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($word->created_at)->format('d M y') }}
                        </td>
                        <td>
                            @if ($word->published === 1)
                                <span class="fw-normal text-success">Published</span>
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
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon icon-sm pt-1">
                                        <span class="fas fa-ellipsis-h icon-dark">
                                        </span>
                                    </span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu py-0">
                                    <a class="dropdown-item" href="{{ route('details', ['id' => $word->id]) }}">
                                        <span class="fas fa-eye me-2"></span>
                                        {{ __('View Details') }}
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.word.edit', ['id' => $word->id]) }}">
                                        <span class="fas fa-edit me-2"></span>
                                        {{ __('Edit') }}
                                    </a>
                                    @if ($word->published === 1)
                                        <a wire:click="deleteConfirmation({{ $word->id }})"
                                            class="dropdown-item text-danger rounded-bottom">
                                            <span class="fas fa-trash-alt me-2"></span>
                                            {{ __('Delete') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <h3 class="text-dark text-center">No <em>Words</em> Found.</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div
            class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            {{ $words->links('admin.pages.pagination') }}
            <div class="fw-normal small mt-4 mt-lg-0">A total of <b>{{ App\Models\Word::count() }}</b>
                entries
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/deleteAlert.js') }}"></script>
    <script src="{{ asset('/admin/js/fileUploadHandler.js') }}"></script>
</div>

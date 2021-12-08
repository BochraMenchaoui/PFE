<div class="mt-4">
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-4 d-flex">
                <div class="input-group me-2 me-lg-3">
                    <span class="input-group-text">
                        <span class="fas fa-search">
                        </span>
                    </span>
                    <input wire:model="searchQuery" type="text" class="form-control"
                        placeholder="{{ __('Search by name') }}">
                </div>
            </div>
            <div class="col-3 col-lg-8 text-right">
                <div class="btn-group">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-sm icon-gray pt-1">
                            <span class="fas fa-cog"></span>
                        </span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0" style="">
                        <span class="small ps-3 fw-bold text-dark">{{ __('Show') }}
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
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                    <th class="border-bottom">ID</th>
                    <th class="border-bottom">{{ __('User') }}</th>
                    <th class="border-bottom">{{ __('Deleted At') }}</th>
                    <th class="border-bottom">{{ __('Role') }}</th>
                    <th class="border-bottom">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trashedUsers as $trashedUser)
                    <tr>
                        <td>
                            {{ $trashedUser->id }}
                        </td>
                        <td>
                            <a class="d-flex align-items-center">
                                <img src="{{ asset('/images/' . $trashedUser->avatar) }}"
                                    class="user-avatar rounded-circle me-3" alt="Avatar">
                                <div class="d-block">
                                    <span class="fw-bold">{{ $trashedUser->name }}</span>
                                    <div class="small text-gray">{{ $trashedUser->email }}</div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span
                                class="fw-normal text-danger">{{ $trashedUser->deleted_at->format('d M y') }}</span>
                        </td>
                        <td>
                            {{ $trashedUser->role === 0 ? 'Admin' : ($trashedUser->role === 1 ? 'Collaborator' : 'User') }}
                        </td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Restore User"
                                wire:click="restore({{ $trashedUser->id }})"><span
                                    class="fas fa-2x fa-trash-restore text-success px-3"></span></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <h3 class="text-dark text-center">{{ __('No ') }}<em>
                                    {{ __('Trashed Users ') }}</em>{{ __('Found') }}.
                            </h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div
            class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            {{ $trashedUsers->links('admin.pages.pagination') }}
            <div class="fw-normal small mt-4 mt-lg-0">{{ __('A total of') }}
                <b>{{ App\Models\User::onlyTrashed()->count() }}</b>
                {{ __('entries') }}
            </div>
        </div>
    </div>
</div>

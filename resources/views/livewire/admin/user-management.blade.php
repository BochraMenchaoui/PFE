<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            {{-- <h2 class="h4">Users List</h2>
            <p class="mb-0">All about your users!</p> --}}

            <button id="uploadFile" class="btn btn-sm btn-dark p-r-2">
                <div wire:loading wire:target="document">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
                <span class="fas fa-upload me-2">
                </span>
                {{ __('Import') }}
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
            <a href="{{ route('admin.user.create', ['lang' => app()->getLocale()]) }}"
                class="btn btn-sm btn-dark"><span class="fas fa-plus me-2">
                </span> {{ __('New User') }}
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <a wire:click="exportUsersCSV" class="btn btn-sm btn-outline-primary">CSV</a>
                <a wire:click="exportUsersPDF" class="btn btn-sm btn-outline-primary">PDF</a>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-4 d-flex">
                <div class="input-group me-2 me-lg-3">
                    <span class="input-group-text">
                        <span class="fas fa-search">
                        </span>
                    </span>
                    <input wire:model="searchQuery" type="text" class="form-control"
                        placeholder="{{ __('Search by name') }}...">
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
    <div class="card card-body shadow-sm table-wrapper table-responsive mb-4">
        <div class="d-flex mb-3">
            <select wire:model.defer="selected" class="form-select fmxw-150">
                <option value="id" selected="selected">{{ __('Sort By ID') }}</option>
                <option value="name">{{ __('Sort By Name') }}</option>
                <option value="role">{{ __('Sort By Role') }}</option>
            </select>
            <button wire:click="sortBy" class="btn btn-sm px-3 btn-secondary ms-3">{{ __('Apply') }}</button>
        </div>
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                    <th class="border-bottom">ID</th>
                    <th class="border-bottom">{{ __('Name') }}</th>
                    <th class="border-bottom">{{ __('Created At') }}</th>
                    <th class="border-bottom">{{ __('Verified') }}</th>
                    <th class="border-bottom">{{ __('Role') }}</th>
                    <th class="border-bottom">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/' . $user->avatar) }}"
                                    class="user-avatar rounded-circle me-3" alt="Avatar">
                                <div class="d-block"><span class="fw-bold">{{ $user->name }}</span>
                                    <div class="small text-gray">
                                        <span class="text-{{ $user->isOnline() ? 'success' : 'danger' }}">●</span>
                                        <small>{{ $user->isOnline() ? 'Online' : 'Offline' }}</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-normal">{{ __($user->created_at->format('d M y')) }}</span>
                        </td>
                        <td>
                            <span class="fw-normal"><span
                                    class="fas fa-{{ $user->email_verified_at ? 'check-circle text-success' : 'clock text-info' }} me-2"></span>Email</span>
                        </td>
                        <td><span
                                class="fw-normal text-dark">{{ $user->role === 0 ? 'Admin' : ($user->role === 1 ? __('Collaborator') : __('User')) }}</span>
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
                                    <a class="dropdown-item"
                                        href="{{ route('admin.users.detail', ['id' => $user->id, 'lang' => app()->getLocale()]) }}">
                                        <span class="fas fa-eye me-2"></span>
                                        {{ __('View Details') }}
                                    </a>
                                    @if ($user->id !== Auth::user()->id)
                                        <a wire:click="deleteConfirmation({{ $user->id }})"
                                            class="dropdown-item text-danger rounded-bottom">
                                            <span class="fas fa-user-times me-2"></span>
                                            {{ __('Delete') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <h3 class="text-dark text-center">{{ __('No ') }}<em>{{ __('Users') }}</em>
                                {{ __('Found') }}.</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div
            class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            {{ $users->links('admin.pages.pagination') }}
            <div class="fw-normal small mt-4 mt-lg-0">{{ __('A total of') }} <b>{{ App\Models\User::count() }}</b>
                {{ __('entries') }}
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/deleteAlert.js') }}"></script>
    <script src="{{ asset('/admin/js/fileUploadHandler.js') }}"></script>
</div>

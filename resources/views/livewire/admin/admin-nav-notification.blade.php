<div>
    <a class="nav-link text-dark me-lg-3 icon-notifications dropdown-toggle" data-unread-notifications="true" href="#"
        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="icon icon-sm">
            <span class="fas fa-bell bell-shake"></span>
            @if ($count > 0)
                <span class="icon-badge rounded-circle unread-notifications"></span>
            @endif
        </span>
    </a>
    <div class="mr-5 dropdown-menu dashboard-dropdown dropdown-menu-lg dropdown-menu-center mt-2 py-0">
        <div class="list-group list-group-flush">
            <a class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>
            @if ($notifications)
                @foreach ($notifications as $notification)
                    <a href="{{ route('admin.words') }}" target="_blank"
                        class="list-group-item list-group-item-action border-bottom border-light">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <!-- Avatar -->
                                <img alt="Image placeholder"
                                    src="{{ asset('/images/' . $notification['data']['avatar']) }}"
                                    class="user-avatar lg-avatar rounded-circle">
                            </div>
                            <div class="col ps-0 ms-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="h6 mb-0 text-small">{{ $notification['data']['name'] }}</h4>
                                    </div>
                                    <div class="text-end">
                                        <small
                                            class="text-danger">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="font-small mt-1 mb-0">
                                    {{ $notification['data']['body'] }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <a class="list-group-item list-group-item-action border-bottom border-light">
                    <div class="row align-items-center">
                        <div class="col ps-0 ms-2">
                            <p class="font-small mt-1 mb-0 text-center">
                                <em>No Notifications!</em>
                            </p>
                        </div>
                    </div>
                </a>
            @endif
            <a wire:click="markAsRead" class="dropdown-item text-center text-primary fw-bold rounded-bottom py-3">
                {{ __('Mark as read') }}
            </a>
        </div>
    </div>
</div>

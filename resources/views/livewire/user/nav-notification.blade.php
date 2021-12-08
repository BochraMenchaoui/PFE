<div>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="supportNotifications"
            aria-expanded="false">
            Notifications
            @if ($count > 0)
                <span class="badge badge-md bg-danger badge-pill notification-count">{{ $count }}</span>
            @endif
            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-xl" aria-labelledby="supportNotifications">
            <div class="col-auto px-0">
                <div class="list-group list-group-flush">
                    <a class="text-center text-primary fw-bold border-bottom border-light py-3">
                        Notifications
                    </a>
                    @if ($notifications)
                        @foreach ($notifications as $notification)
                            <a class="list-group-item list-group-item-action border-bottom border-light">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <!-- Avatar -->
                                        <img alt="Image placeholder"
                                            src="{{ asset('/images/' . $notification['data']['avatar']) }}"
                                            class="user-avatar lg-avatar rounded-circle">
                                    </div>
                                    <div class="col ps-0 ms-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="h6 mb-0 text-small">{{ $notification['data']['name'] }}
                                                </h4>
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
                            <div class="row justify-content-center">
                                <div class="col ps-0 ms-2">
                                    <p class="text-center mt-1 mb-0">
                                        No Notifications
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endif
                    <a wire:click="markAsRead" class="text-center text-primary fw-bold rounded-bottom py-3">
                        Mark as read
                    </a>
                </div>
            </div>
        </div>
    </li>
</div>

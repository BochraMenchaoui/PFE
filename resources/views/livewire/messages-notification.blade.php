<div>
    <li class="nav-item">
        <a wire:click="redirectToMessages" class="nav-link d-flex align-items-center justify-content-between">
            <span>
                <span class="sidebar-icon">
                    <span class="fas fa-inbox"></span>
                </span>
                <span class="sidebar-text">{{ __('Messages') }}</span>
            </span>
            @if ($count > 0)
                <span class="badge badge-md bg-danger badge-pill notification-count">{{ $count }}</span>
            @endif
        </a>
    </li>
</div>

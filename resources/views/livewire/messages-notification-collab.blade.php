<div>
    <li class="nav-item">
        <a href="{{ route('messages') }}" class="nav-link">
            Messaget
            @if ($count > 0)
                <span class="badge bg-tertiary">{{ $count }}</span>
            @endif
        </a>
    </li>
</div>

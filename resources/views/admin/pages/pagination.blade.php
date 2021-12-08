@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination mb-0">
            <!-- Previous -->
            @if ($paginator->onFirstPage())
                <li class="page-item"><a class="page-link" wire:click="previousPage">{{ __('Previous') }}</a></li>
            @else
                <li class="page-item"><a class="page-link" wire:click="previousPage">{{ __('Previous') }}</a>
                </li>
            @endif
            <!-- In Between -->
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item">
                        <a class="page-link" wire:click="gotoPage({{ $element }})">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach
            <!-- Next -->
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" wire:click="nextPage">{{ __('Next') }}</a></li>
            @else
                <li class="page-item"><a class="page-link">{{ __('Next') }}</a></li>
            @endif
        </ul>
    </nav>
@endif

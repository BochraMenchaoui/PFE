<div class="col-5">
    <div class="btn-group float-end">
        <!-- Previous -->
        @if ($paginator->onFirstPage())
            <a wire:click="previousPage" class="btn btn-gray-200 disabled">
                <span class="fas fa-chevron-left"></span>
            </a>
        @else
            <a wire:click="previousPage" class="btn btn-secondary">
                <span class="fas fa-chevron-left"></span>
            </a>
        @endif

        <!-- Next -->
        @if ($paginator->hasMorePages())
            <a wire:click="nextPage" class="btn btn-secondary">
                <span class="fas fa-chevron-right"> </span>
            </a>
        @else
            <a wire:click="nextPage" class="btn btn-gray-200 disabled">
                <span class="fas fa-chevron-right"> </span>
            </a>
        @endif
    </div>
</div>

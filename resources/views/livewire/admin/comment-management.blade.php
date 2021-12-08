<div>
    <div class="d-lg-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="col-auto d-flex justify-content-between ps-0 mb-4 mb-lg-0">
            <div class="btn-group">
                <button wire:click="selectAll" class="btn btn-dark text-white">
                    {{ __('Select All') }}
                </button>
                <button wire:click="deleteConfirmation" class="btn btn-dark text-white"><span
                        class="fas fa-trash-alt"></span>
                </button>
            </div>
        </div>
        <div class="col-12 col-lg-6 px-0">
            <div class="mb-0">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">
                        <span class="fas fa-search"></span>
                    </span>
                    <input wire:model="searchQuery" type="text" class="form-control" id="exampleInputIconLeft"
                        placeholder="{{ __('Search Comments by user or content') }}..." aria-label="Search"
                        aria-describedby="basic-addon3">
                </div>
            </div>
        </div>
    </div>

    <div class="task-wrapper border bg-white shadow-sm rounded mb-5">
        @forelse ($comments as $comment)
            @if ($comment->user)
                <div
                    class="card hover-state border-bottom rounded-0 {{ $loop->index === 0 ? 'rounded-top' : '' }} py-3">
                    <div class="card-body d-sm-flex align-items-center flex-wrap flex-lg-nowrap py-0">
                        <div class="col-1 text-left text-sm-center mb-2 mb-sm-0">
                            <div class="form-check check-lg inbox-check me-sm-2">
                                <input wire:model="selectedComments" class="form-check-input" type="checkbox"
                                    value="{{ $comment->id }}" id="mailCheck1">
                                <label class="form-check-label" for="mailCheck1"></label>
                            </div>
                        </div>
                        <div class="col-11 col-lg-8 px-0 mb-4 mb-md-0">
                            <div class="mb-2">
                                <h3 class="h5" id="header-{{ $comment->id }}">{{ $comment->user->name }}</h3>
                                <div class="d-block d-sm-flex">
                                    <div>
                                        <h4 class="h6 fw-normal text-gray mb-3 mb-sm-0">
                                            <span class="fas fa-clock me-2"></span>
                                            {{ $comment->created_at->format('h:i') }}
                                        </h4>
                                    </div>
                                    <div class="ms-sm-3">
                                        <span
                                            class="badge super-badge badge-lg bg-{{ $comment->user->role === 0 ? 'danger' : ($comment->user->role === 2 ? 'success' : 'warning') }}">{{ $comment->user->role === 0 ? __('Admin') : ($comment->user->role === 1 ? __('Collaborator') : __('User')) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('details', ['id' => $comment->word->id]) }}" target="_blank"
                                    class="fw-bold text-dark">
                                    <span class="fw-normal text-gray" id="body-{{ $comment->id }}">
                                        {{ Str::substr($comment->body, 0, 130) }}...
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <h3 class="text-dark text-center mt-4">{{ __('No ') }}<em>{{ __('Comments') }}</em>
                {{ __('Found') }}.</h3>
        @endforelse
        <div class="row p-4">
            <div class="col-7 mt-1">{{ __('A total of') }} <b>{{ App\Models\Comment::count() }}</b>
                {{ __('comments') }}.
            </div>
            {{ $comments->links('admin.pages.comment-post-pagination') }}
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/deleteAlert.js') }}"></script>
    <script>
        window.addEventListener('selected-comment', event => {
            $(document).ready(function() {
                event.detail.id.forEach(element => {
                    $('#header-' + element).addClass("line-through");
                    $('#body-' + element).addClass("line-through");
                });
            });
        })

    </script>
</div>

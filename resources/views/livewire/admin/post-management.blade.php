<div>
    <div class="d-lg-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4 px-0">
        <div class="col-lg-5 d-flex  ps-0 mb-4 mb-lg-0">
            <div class="btn-group">
                <button wire:click="selectAll" class="btn btn-dark text-white">
                    {{ __('Select All') }}
                </button>
                <button wire:click="deleteConfirmation" class="btn btn-dark text-white"><span
                        class="fas fa-trash-alt"></span>
                </button>
            </div>
        </div>

        <div class="col-10 col-lg-6 px-0 float-right">
            <div class="mb-0">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">
                        <span class="fas fa-search"></span>
                    </span>
                    <input wire:model="searchQuery" type="text" class="form-control" id="exampleInputIconLeft"
                        placeholder="{{ __('Search Posts by author, content or title') }}..." aria-label="Search"
                        aria-describedby="basic-addon3">
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block justify-content-center p-0 m-0">
            <div class="btn-group">
                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="icon icon-sm icon-gray pt-1"><span class="fas fa-sliders-h"></span>
                    </span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pb-0" style="">
                    <span class="small ps-3 fw-bold text-dark">Show
                    </span>
                    <a wire:click="orderPosts(0)" class="dropdown-item d-flex fw-bold">All
                        @if ($postOrder === 0)
                            <span class="icon icon-small ms-auto"><span class="fas fa-check"></span></span>
                        @endif
                    </a>
                    <a wire:click="orderPosts(1)" class="dropdown-item d-flex fw-bold rounded-bottom">Owned
                        @if ($postOrder === 1)
                            <span class="icon icon-small ms-auto"><span class="fas fa-check"></span></span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="task-wrapper border bg-white shadow-sm rounded mb-5">
        @forelse ($posts as $post)
            @if ($post->user)
                <div
                    class="card hover-state border-bottom rounded-0 {{ $loop->index === 0 ? 'rounded-top' : '' }} py-3">
                    <div class="card-body d-sm-flex align-items-center flex-wrap flex-lg-nowrap py-0">
                        <div class="col-1 text-left text-sm-center mb-2 mb-sm-0">
                            <div class="form-check check-lg inbox-check me-sm-2">
                                <input wire:model="selectedPosts" class="form-check-input" type="checkbox"
                                    value="{{ $post->id }}" id="mailCheck1">
                                <label class="form-check-label" for="mailCheck1"></label>
                            </div>
                        </div>
                        <div class="col-10 col-lg-8 px-0 mb-4 mb-md-0">
                            <div class="mb-2">
                                <h3 class="h5" id="header-{{ $post->id }}">{{ $post->title }}</h3>
                                <div class="d-block d-sm-flex">
                                    <div>
                                        <h4 class="h6 fw-normal text-gray mb-3 mb-sm-0">
                                            <span class="fas fa-clock me-2"></span>
                                            {{ $post->created_at->format('h:i') }}
                                        </h4>
                                    </div>
                                    <div class="ms-sm-3">
                                        <span
                                            class="badge super-badge badge-lg bg-{{ $post->user->role === 0 ? 'danger' : ($post->user->role === 2 ? 'success' : 'warning') }}">
                                            {{ $post->user?->name ?? __('Deleted User') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('article.details', ['id' => $post->id]) }}" target="_blank"
                                    class="fw-bold text-dark">
                                    <span class="fw-normal text-gray" id="body-{{ $post->id }}">
                                        {{ Str::substr(strip_tags($post->body), 0, 130) }}...
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div
                            class="col-lg-2 col-md-2 d-none d-lg-block d-xl-inline-flex align-items-center ms-lg-auto text-right justify-content-end px-md-0">
                            <div class="btn-group ms-md-3">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon icon-sm">
                                        <span class="fas fa-ellipsis-h icon-dark"></span>
                                    </span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-0">
                                    <a class="dropdown-item"
                                        href="{{ route('article.details', ['id' => $post->id]) }}" target="_blank">
                                        <span class="far fa-eye"></span>
                                        {{ __('View') }}
                                    </a>
                                    @if (Auth::user()->ownsArticle($post->id))
                                        <a class="dropdown-item rounded-top"
                                            href="{{ route('user.edit.post', ['id' => $post->id]) }}"
                                            target="_blank">
                                            <span class="fas fa-edit"></span>
                                            {{ __('Edit') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <h3 class="text-dark text-center mt-4">{{ __('No ') }}<em>{{ __('Posts') }}</em>
                {{ __('Found') }}.</h3>
        @endforelse
        <div class="row p-4">
            <div class="col-7 mt-1">{{ __('A total of') }} <b>{{ App\Models\Post::count() }}</b>
                {{ __('posts') }}.
            </div>
            {{ $posts->links('admin.pages.comment-post-pagination') }}
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/deleteAlert.js') }}"></script>
    <script>
        window.addEventListener('selected-post', event => {
            $(document).ready(function() {
                event.detail.id.forEach(element => {
                    $('#header-' + element).addClass("line-through");
                    $('#body-' + element).addClass("line-through");
                });
            });
        })

    </script>
</div>

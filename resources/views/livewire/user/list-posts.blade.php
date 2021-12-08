<div>
    <section class="section-header bg-primary text-white pb-10 pb-sm-8 pb-lg-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h1 class="display-2 mb-4">L Articoulwet</h1>
                    <p class="lead">Les articles mte twensa lkol! wnty zeda tnajm tpartagi maana hkeytek</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg line-bottom-light">
        <div class="container mt-n10 mt-lg-n12 z-2">
            <div class="row">
                @foreach ($posts as $post)
                    @if ($loop->index === 0)
                        <div class="col-lg-12 mb-5">
                            <div class="card shadow bg-white border-gray-300 flex-lg-row align-items-center g-0 p-4">
                                <div class="col-12 col-lg-6">
                                    <img src="{{ asset('thumbnails/' . $post->thumbnail) }}" alt="themesberg office"
                                        class="card-img-top rounded">
                                </div>
                                <div
                                    class="card-body d-flex flex-column justify-content-between col-auto py-4 p-0 p-lg-3 p-xl-5">
                                    <a href="{{ route('article.details', ['id' => $post->id]) }}" target="_blank">
                                        <h2>{{ $post->title }}</h2>
                                    </a>
                                    <p> {{ Str::substr(strip_tags($post->body), 0, 350) }}...</p>
                                    <div class="d-flex align-items-center mt-3">
                                        <img class="avatar avatar-sm rounded-circle"
                                            src="{{ asset('/images/' . ($post->user?->avatar ?? 'default.png')) }}">
                                        <h3 class="h6 small ms-2 mb-0">{{ $post->user?->name ?? 'Deleted User' }}
                                        </h3>
                                        <span class="h6 text-muted small fw-normal mb-0 ms-auto">
                                            <time>{{ $post->created_at->format('d-m-y H:i') }}</time>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-5">
                            <div class="card shadow bg-white border-gray-300 p-4 rounded h-100">
                                <img src="{{ asset('thumbnails/' . $post->thumbnail) }}" class="card-img-top rounded">
                                <div class="card-body p-0 pt-4">
                                    <a href="{{ route('article.details', ['id' => $post->id]) }}" target="_blank"
                                        class="h4">{{ $post->title }}
                                    </a>
                                    <div class="d-flex align-items-center my-3">
                                        <img class="avatar avatar-sm rounded-circle"
                                            src="{{ asset('/images/' . $post->user->avatar) }}" alt="Neil avatar">
                                        <h3 class="h6 small ms-2 mb-0">{{ $post->user->name }}</h3>
                                    </div>
                                    <p class="mb-0"> {{ Str::substr(strip_tags($post->body), 0, 200) }}...</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @if ($amount < App\Models\Post::count())
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-4">
                        <button wire:click="loadMore" type="button" class="btn w-100 btn-primary">
                            zid ahbet
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>

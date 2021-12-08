<div>
    <section
        style="background: url({{ asset('thumbnails/' . $post->thumbnail) }}) rgb(0, 0, 0.5); background-repeat: no-repeat; background-size: cover"
        id="blogSection" class="section-header bg-primary text-white pb-9 pb-lg-12 mb-4 mb-lg-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <div class="mb-4">
                        @if ($post->tags != '')
                            @foreach (explode(',', $post->tags) as $tag)
                                <span
                                    class="badge badge-lg bg-{{ $color[random_int(0, 5)] }} text-uppercase me-2 px-3">
                                    <option>{{ $tag }}</option>
                                </span>
                            @endforeach
                        @endif
                    </div>
                    <h1 style="mix-blend-mode: difference;" class="display-2 mb-3">{{ $post->title }}</h1>
                    <div class="post-meta">
                        <span class="badge badge-lg bg-primary me-3">{{ $post->user?->name ?? 'Deleted User' }}</span>
                        <span class="badge badge-lg bg-primary post-date me-3">
                            {{ $post->created_at->format('d-m-y') }}
                        </span>
                        <span class="badge badge-lg bg-primary fw-bold">
                            {{ Str::readDuration(strip_tags($this->post->body)) }} min bch ta9rah
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg pt-0">
        <div class="container mt-n8 mt-lg-n12 z-2">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card shadow border-gray-300 p-4 p-lg-5">
                        <div class="lead">
                            {!! $post->body !!}
                        </div>
                        <div class="text-center border-top border-gray-300 my-2 my-lg-2 py-5 py-lg-1">
                            <h4 class="h4 mb-lg-2 py-3">
                                <span class="me-1">
                                    <i class="far fa-newspaper"></i>
                                </span>
                                Ken aajbek l'article partagih!
                            </h4>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route($currentRouteName, $currentParams) }}"
                                target="_blank" class="btn btn-icon-only btn-facebook animate-up-2" type="button"
                                aria-label="facebook button" title="facebook button">
                                <span aria-hidden="true" class="fab fa-facebook"></span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ route($currentRouteName, $currentParams) }}"
                                target="_blank" class="btn btn-icon-only btn-twitter text-white animate-up-2"
                                type="button" aria-label="pinterest button" title="twitter button">
                                <span aria-hidden="true" class="fab fa-twitter"></span>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?mini=true&url={{ route($currentRouteName, $currentParams) }}"
                                target="_blank" class="btn btn-icon-only btn-github animate-up-2" type="button"
                                aria-label="youtube button" title="linkedin button">
                                <span aria-hidden="true" class="fab fa-linkedin"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $("p").addClass("lead");
            $("blockquote").addClass("text-center");
        });

    </script>

</div>

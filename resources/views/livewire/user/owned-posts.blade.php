<div>
    <div class="section-header pb-6 bg-primary-app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <h3 class="display-3 fw-normal my-4 text-center">L'articlouwet mta3 <span
                            class="text-through fw-bold">ness
                        </span> mte3ek elkol</h3>
                </div>
                <div class="col-md-10 p-2 m-2">
                    @foreach ($posts as $post)
                        <div class="timeline-item rounded border border-gray-300 p-4 mb-4 bg-white">
                            <div class="post-meta mb-3">
                                <div class="fw-bold me-3" href="#">
                                    <span class="far fa-clock me-1">
                                    </span>
                                    {{ $post->created_at->format('d-m-y H:i') }}
                                </div>
                            </div>
                            <h2 class="h4 mb-4">{{ $post->title }}</h2>
                            <p>{{ Str::substr(strip_tags($post->body), 0, 200) }}...
                            </p>
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-md-4 col-sm-8 col-8 m-1">
                                    <a href="{{ route('article.details', ['id' => $post->id]) }}" target="_blank"
                                        class="btn btn-primary btn-sm btn-icon animate-up-1 w-100">Chouf
                                        detail</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-8 col-8 m-1">
                                    <a href="{{ route('user.edit.post', ['id' => $post->id]) }}"
                                        class="btn btn-primary btn-sm btn-icon animate-up-1 w-100">Badel</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-8 col-8 m-1">
                                    <a wire:click="deleteConfirmation({{ $post?->id }})"
                                        class="btn btn-primary btn-sm btn-icon animate-up-1 w-100">Fasakh</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if ($amount <= count($posts))
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <button wire:click="loadMore" class="btn btn-outline-primary btn-lg btn-block mt-4 mb-4 w-100">
                            Zid ahbet</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('/admin/js/deleteAlert.js') }}"></script>
    <script src="{{ asset('admin/js/adminProfile.js') }}"></script>
</div>

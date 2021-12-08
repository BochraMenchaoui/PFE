<div>
    <section class="section section-header pb-8 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 text-center">
                    <form>
                        <div class="form-group bg-white shadow-soft rounded-pill mb-4 px-3 py-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="input-group input-group-merge shadow-none">
                                        <div class="input-group-text bg-transparent border-0">
                                            <span class="fas fa-search"></span>
                                        </div>
                                        <input wire:model="searchTerm" type="text"
                                            class="form-control border-0 form-control-flush shadow-none pb-2"
                                            placeholder="Lawej 3ala kelmaa...">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-block btn-primary rounded-pill">Lawej</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg  bg-gray-200 line-bottom-light">
        <div class="container mt-n10 mt-lg-n13 z-2">
            <div class="row">
                @forelse ($words as $word)
                    <div class="col-lg-12 mb-5">
                        <div class="card shadow bg-white border-gray-300 flex-lg-row align-items-center g-0 p-2">
                            <div
                                class="card-body d-flex flex-column justify-content-between col-auto py-3 p-0 p-lg-3 p-xl-3">
                                <a data-toggle="tooltip" data-placement="bottom" title="Chouf akther detail"
                                    href="{{ route('details', ['id' => $word->id]) }}" target="_blank">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="h3 text-center  mb-3">
                                                {{ $word->word_ar }}</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="h3 text-center  mb-3">
                                                {{ $word->word_lt }}</h3>
                                        </div>
                                    </div>
                                </a>
                                <p>{{ $word->description }}</p>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="col d-flex ps-0">
                                        <span class="text-muted font-small me-3">
                                            <span class="fas fa-eye me-2">
                                            </span>
                                            {{ $word->views_count }}
                                        </span>
                                        <span class="text-muted font-small me-3">
                                            <span class="far fa-thumbs-up me-2">
                                            </span>
                                            {{ $word->likedBy()->count() }}
                                        </span>
                                        <span class="text-muted font-small me-3">
                                            <span class="far fa-thumbs-down me-2">
                                            </span>
                                            {{ $word->dislikedBy()->count() }}
                                        </span>
                                        <span class="text-muted font-small me-3">
                                            <span class="far fa-comment me-2">
                                            </span>
                                            {{ $word->comments->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
                {{-- <div class="mt-3 text-center">
                    @if ($amount <= count($words))
                        <button wire:click="loadMore" class="btn btn-primary btn-loading-overlay me-2 mb-2">
                            <span class="spinner">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
                                </span>
                            </span>
                            <span class="ms-1 btn-inner-text">
                                Load more comments
                            </span>
                        </button>
                    @else
                        <p id="allLoadedText">That's all, Sparky!</p>
                    @endif
                </div> --}}
            </div>
        </div>
    </section>
</div>
